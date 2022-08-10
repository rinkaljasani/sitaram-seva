<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DonationRequest;
use App\Models\Category;
use App\Models\Donation;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.donations.index')->with(['custom_title' => 'Donation']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_active','y')->get();
        return view('admin.pages.donations.create',compact('categories'))->with(['custom_title' => 'Donation']);
    }

    public function show(Donation $donation){
        return view('admin.pages.donations.view', compact('dealer'))->with(['custom_title' => 'Donation']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRequest $request)
    {
        
        $request['custom_id']   =   getUniqueString('donations');
        
        $path = NULL;
        if( $request->has('donar_image') ) {
            $path = $request->file('donar_image')->store('doners');
        }
        $donation = Donation::create($request->all());
        $donation->donar_image = $path;
        
        if( $donation->save() ) {
            flash('Donation Add Successfully!')->success();
        } else {
            flash('Unable to save avatar. Please try again later.')->error();
        }
        return redirect(route('admin.donations.index'));
    }

    public function edit(Donation $donation)
    {
        $categories = Category::where('is_active','y')->get();
        return view('admin.pages.donations.edit', compact('donation','categories'))->with(['custom_title' => 'Donation']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DonationRequest $request, Donation $donation)
    {   
        try{
            DB::beginTransaction();
            if(!empty($request->action) && $request->action == 'change_status') {
                $content = ['status'=>204, 'message'=>"something went wrong"];
                if($donation) {
                    $donation->is_active = $request->value;
                    if($donation->save()) {
                        DB::commit();
                        $content['status']=200;
                        $content['message'] = "Status updated successfully.";
                        // flash('Dealer updated successfully!')->success();
                    }
                }
                return response()->json($content);
            } else {
                $path = $donation->donar_image;
                if( $request->hasFile('donar_image') ) {
                    if( $donation->donar_image){
                        Storage::delete($donation->donar_image);
                    }
                    $path = $request->donar_image->store('Donation/donar_image');
                }
                $donation->fill($request->all());
                $donation->donar_image = $path;
                if( $donation->save() ) {
                    DB::commit();
                    flash('donar details updated successfully!')->success();
                } else {
                    flash('Unable to update donar. Try again later')->error();
                }
                return redirect(route('admin.donations.index'));
            }
        }catch(QueryException $e){
            DB::rollback();
            return redirect()->back()->flash('error',$e->getMessage());
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if(!empty($request->action) && $request->action == 'delete_all'){
            $content = ['status'=>204, 'message'=>"something went wrong"];
            $donations_profile_photos = Donation::whereIn('custom_id', explode(',', $request->ids))->pluck('donar_image')->toArray();
            foreach ($donations_profile_photos as $image) {
                if(!empty($image)){
                  Storage::delete($image);
                }
            }
            $donation = Donation::whereIn('custom_id',explode(',',$request->ids))->delete();
            $content['status']=200;
            $content['message'] = "Donation deleted successfully.";
            $content['count'] = Donation::all()->count();
            return response()->json($content);
        }else{
            $donation = Donation::where('custom_id', $id)->firstOrFail();
            if( $donation->profile_photo ){
                Storage::delete($donation->donar_image);
            }
            $donation->delete();
            if(request()->ajax()){
                $content = array('status'=>200, 'message'=>"Dealer deleted successfully.", 'count' => Donation::all()->count());
                return response()->json($content);
            }else{
                flash('dealer deleted successfully.')->success();
                return redirect()->route('admin.donations.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));
        if($sort_column == 'checkbox'){
            $sort_column = 'created_at';
        }
        
        $records = [];
        $donations = Donation::orderBy($sort_column, $sort_order);
        if($request->type != null){
            $donations->where('status',$request->type);
        }
        if ($search != '') {
            $donations->where(function ($query) use ($search) {
                $query->where('donar_name', 'like', "%{$search}%")
                    ->orWhere('amount', 'like', "%{$search}%")
                    ->orWhere('donar_email', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orwhereHas('category',function($q1) use ($search){
                        $q1->where('name', '==', "%{$search}%");
                    });
            });
        }

        $count = $donations->count();

        $records['recordsTotal'] = $count;
        $records['recordsFiltered'] = $count;
        $records['data'] = [];

        $donations = $donations->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);

        $donations = $donations->get();
        foreach ($donations as $donation) {
            
            $params = [
                'checked' => ($donation->is_active == 'y' ? 'checked' : ''),
                'getaction' => $donation->is_active,
                'class' => '',
                'id' => $donation->custom_id,
            ];

            $records['data'][] = [
                'id' => $donation->id,
                'donar_name' => $donation->donar_name,
                'amount' => $donation->amount,
                'status' => $donation->status,
                'donar_email' => $donation->donar_email,
                'message' => $donation->message,
                'category'  => $donation->category->name,
                'donar_image' => '<img src="'.generateUrl($donation->donar_image).'" class="table-img-content" alt="icon" height = "50px" width="80px">',
                'active' => view('admin.layouts.includes.switch', compact('params'))->render(),
                'action' => view('admin.layouts.includes.actions')->with(['custom_title' => 'Donation', 'id' => $donation->custom_id], $donation)->render(),
                'checkbox' => view('admin.layouts.includes.checkbox')->with('id', $donation->custom_id)->render(),
            ];
        }
        // dd($records);
        return $records;
    }
}
