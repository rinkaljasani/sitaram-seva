<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\VolunteerRequest;
use App\Models\Volunteer;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.volunteers.index')->with(['custom_title' => 'Volunteers']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.volunteers.create')->with(['custom_title' => 'Team']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VolunteerRequest $request)
    {
        $request['custom_id']   =   getUniqueString('volunteers');
        $request['status'] = 'approved';
        $path = NULL;
        if ($request->has('image')) {
            $path = $request->file('image')->store('volurteer/image');
        }
        $volunteer = Volunteer::create($request->all());
        $volunteer->image = $path;
        if ($volunteer->save()) {
            flash('Volunteer account created successfully!')->success();
        } else {
            flash('Unable to save avatar. Please try again later.')->error();
        }
        return redirect(route('admin.volunteers.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        return view('admin.pages.volunteers.view', compact('volunteer'))->with(['custom_title' => 'Team']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        return view('admin.pages.volunteers.edit',compact('volunteer'))->with(['custom_title' => 'Team']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VolunteerRequest $request, Volunteer $volunteer)
    {
        try{
            DB::beginTransaction();
            if(!empty($request->action) && $request->action == 'change_status') {
                $content = ['status'=>204, 'message'=>"something went wrong"];
                if($volunteer) {
                    $volunteer->is_active = $request->value;
                    if($volunteer->save()) {
                        DB::commit();
                        $content['status']=200;
                        $content['message'] = "Status updated successfully.";
                        // flash('Dealer updated successfully!')->success();
                    }
                }
                return response()->json($content);
            } else {
                $path = $volunteer->image;
                if( $request->hasFile('image') ) {
                    if( $volunteer->image){
                        Storage::delete($volunteer->image);
                    }
                    $path = $request->image->store('volunteer/image');
                }
                $volunteer->fill($request->all());
                $volunteer->image = $path;
                if( $volunteer->save() ) {
                    DB::commit();
                    flash('volunteer details updated successfully!')->success();
                } else {
                    flash('Unable to update volunteer. Try again later')->error();
                }
                return redirect(route('admin.volunteers.index'));
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
    public function destroy($id)
    {
        //
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));
        if($sort_column == 'checkbox'){
            $sort_column = 'created_at';
        }
        
        $records = [];
        $donations = Volunteer::orderBy($sort_column, $sort_order);
        if($request->type != null){
            $donations->where('status',$request->type);
        }
        if ($search != '') {
            $donations->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('contact_no', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('image', 'like', "%{$search}%");
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
                'name' => $donation->name,
                'email' => $donation->email,
                'contact_no' => $donation->contact_no,
                'address' => $donation->address,
                'image' => '<img src="'.generateUrl($donation->image).'" class="table-img-content" alt="icon" height = "50px" width="80px">',
                'status' => $donation->status,
                'active' => view('admin.layouts.includes.switch', compact('params'))->render(),
                'action' => view('admin.layouts.includes.actions')->with(['custom_title' => 'Donation', 'id' => $donation->custom_id], $donation)->render(),
                'checkbox' => view('admin.layouts.includes.checkbox')->with('id', $donation->custom_id)->render(),
            ];
        }
        // dd($records);
        return $records;
    }
}
