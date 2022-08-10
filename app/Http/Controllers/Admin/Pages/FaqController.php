<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.faqs.index')->with(['custom_title' => 'Faqs']); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.faqs.create')->with(['custom_title' => 'Faq']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
        $request['custom_id'] = getUniqueString('faqs');
        $faq = Faq::create($request->all());

        if( $faq->save() ) {
            flash('Faq added successfully!')->success();
        } else {
            flash('Unable to save faq details. Please try again later.')->error();
        }
        return redirect(route('admin.faqs.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        return view('admin.pages.faqs.view', compact('faq'))->with(['custom_title' => 'Faq']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        return view('admin.pages.faqs.edit', compact('faq'))->with(['custom_title' => 'Faq']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request, Faq $faq)
    {
        if(!empty($request->action) && $request->action == 'change_status') {
            $content = ['status'=>204, 'message'=>"something went wrong"];
            if($faq->question) {
                $faq->is_active = $request->value;
                if($faq->save()) {
                    $content['status']=200;
                    $content['message'] = "Status updated successfully.";
                }
            }
            return response()->json($content);
        } else {
            $faq->fill($request->all());
            if( $faq->save() ) {
                flash('Faq details updated successfully!')->success();
            } else {
                flash('Unable to update faq. Try again later')->error();
            }
            return redirect(route('admin.faqs.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $custom_id)
    {
        if(!empty($request->action) && $request->action == 'delete_all'){
            $content = ['status'=>204, 'message'=>"something went wrong"];
            Faq::whereIn('custom_id',explode(',',$request->ids))->delete();
            $content['status']=200;
            $content['message'] = "Faq deleted successfully.";
            $content['count'] = Faq::all()->count();
            return response()->json($content);
        }else{
            $faq = Faq::where('custom_id', $custom_id)->firstOrFail();
            $faq->delete();
            if(request()->ajax()){
                $content = array('status'=>200, 'message'=>"Faq deleted successfully.", 'count' => Faq::all()->count());
                return response()->json($content);
            }else{
                flash('Faq deleted successfully.')->success();
                return redirect()->route('admin.faqs.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));
        $records = [];
        $faqs = Faq::orderBy($sort_column, $sort_order);

        if ($search != '') {
            $faqs->where(function ($query) use ($search) {
                $query->where('question', 'like', "%{$search}%")
                    ->OrWhere('answer', 'like', "%{$search}%");
            });
        }
        $count = $faqs->count();
        $records['recordsTotal'] = $count;
        $records['recordsFiltered'] = $count;
        $records['data'] = [];

        $faqs = $faqs->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        $faqs = $faqs->get();
        foreach ($faqs as $faq) {
            
            $params = [
                'checked'   =>  ($faq->is_active == 'y' ? 'checked' : ''),
                'getaction' =>  $faq->is_active,
                'class'     =>  '',
                'id'        =>  $faq->custom_id,
            ];

            $records['data'][] = [
                'id'                        =>  $faq->custom_id,
                'question'                  =>  $faq->question,
                'active'                    =>  view('admin.layouts.includes.switch', compact('params'))->render(),
                'action'                    =>  view('admin.layouts.includes.actions')->with(['custom_title' => 'faq', 'id' => $faq->custom_id], $faq)->render(),
                'checkbox'                  =>  view('admin.layouts.includes.checkbox')->with('id', $faq->custom_id)->render(),
            ];
        }
        return $records;
    }
}
