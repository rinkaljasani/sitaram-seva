<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.gallery.index')->with(['custom_title' => 'Galleries']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.gallery.create')->with(['custom_title' => 'Galleries']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path ="";
        $request['custom_id']   =   getUniqueString('galleries');
        $gallery = Gallery::create($request->all());
        if ($request->has('image')) {
            $path = $request->file('image')->store('galleries');
            $extension = $request->file('image')->extension();
            
            $request['type']='video';
            if($extension != 'mp4'){
                $request['type'] = 'image';
            }
        }
        $gallery->image = $path;
        $gallery->type = $request['type'];
        if ($gallery->save()) {
            flash('Image Add successfully!')->success();
        } else {
            flash('Unable to save avatar. Please try again later.')->error();
        }
        return redirect(route('admin.gallery.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return view('admin.pages.gallery.view', compact('gallery'))->with(['custom_title' => 'Users']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.pages.gallery.edit', compact('gallery'))->with(['custom_title' => 'Gallery']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        try {
            if (!empty($request->action) && $request->action == 'change_status') {
                $content = ['status' => 204, 'message' => "something went wrong"];
                if ($gallery) {
                    $gallery->is_active = $request->value;
                    if ($gallery->save()) {
                        $content['status'] = 200;
                        $content['message'] = "Status updated successfully.";
                    }
                }
                return response()->json($content);
            } else {
                $path = $gallery->image;
                
                //request has remove_profie_photo then delete user image
                if ($request->has('remove_profie_photo')) {
                    if ($gallery->image) {
                        Storage::delete($gallery->image);
                    }
                    $path = null;
                }

                if ($request->hasFile('image')) {
                    if ($gallery->image) {
                        Storage::delete($gallery->image);
                    }
                    $path = $request->image->store('galleries/image');
                }
                $gallery->fill($request->all());
                $gallery->image = $path;
                if ($gallery->save()) {
                    flash('Gallery image updated successfully!')->success();
                } else {
                    flash('Unable to update user. Try again later')->error();
                }
                return redirect(route('admin.gallery.index'));
            }
        } catch (QueryException $e) {
            return redirect()->back()->flash('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        if (!empty($request->action) && $request->action == 'delete_all') {
            $content = ['status' => 204, 'message' => "something went wrong"];

            $image = Gallery::whereIn('custom_id', explode(',', $request->ids))->pluck('image')->toArray();
            foreach ($image as $image) {
                if (!empty($image)) {
                    Storage::delete($image);
                }
            }
            Gallery::whereIn('custom_id', explode(',', $request->ids))->delete();
            $content['status'] = 200;
            $content['message'] = "Gallery Image deleted successfully.";
            $content['count'] = Gallery::all()->count();
            return response()->json($content);
        } else {
            $gallery = Gallery::where('custom_id', $id)->firstOrFail();
            if ($gallery->profile_photo) {
                Storage::delete($gallery->profile_photo);
            }
            $gallery->delete();
            if (request()->ajax()) {
                $content = array('status' => 200, 'message' => "Gallery Image deleted successfully.", 'count' => Gallery::all()->count());
                return response()->json($content);
            } else {
                flash('Gallery Image deleted successfully.')->success();
                return redirect()->route('admin.gallery.index');
            }
        }
    }

    public function listing(Request $request)
    {

        extract($this->DTFilters($request->all()));
        $records = [];
        $galleries = Gallery::orderBy($sort_column, $sort_order);
        if($request->type != null){
            $galleries->where('type',$request->type);
        }
        if ($search != '') {
            $galleries->where(function ($query) use ($search) {
                $query->where('image', 'like', "%{$search}%");
            });
        }

        $count = $galleries->count();

        $records['recordsTotal'] = $count;
        $records['recordsFiltered'] = $count;
        $records['data'] = [];

        $galleries = $galleries->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);

        $galleries = $galleries->get();
        foreach ($galleries as $index => $gallery) {

            $params = [
                'checked' => ($gallery->is_active == 'y' ? 'checked' : ''),
                'getaction' => $gallery->is_active,
                'class' => '',
                'id' => $gallery->custom_id,
            ];
            if($gallery->type == 'image'){
                $records['data'][] = [
                    'id' => $gallery->id,
                    'number' => $index + 1,
                    'image' => '<img src="'.generateUrl($gallery->image).'" class="table-img-content" alt="icon" height = "50px" width="80px">',
                    'created_at' => $gallery->created_at,
                    'active' => view('admin.layouts.includes.switch', compact('params'))->render(),
                    'action' => view('admin.layouts.includes.actions')->with(['custom_title' => 'gallery', 'id' => $gallery->custom_id], $gallery)->render(),
                    'checkbox' => view('admin.layouts.includes.checkbox')->with('id', $gallery->custom_id)->render(),
                ];
            }else{
                $records['data'][] = [
                    'id' => $gallery->id,
                    'number' => $index + 1,
                    'image' => '<video width="320" height="240" controls><source src="'.generateURL($gallery->image).'" type="video/mp4"></video>',
                    'created_at' => $gallery->created_at,
                    'active' => view('admin.layouts.includes.switch', compact('params'))->render(),
                    'action' => view('admin.layouts.includes.actions')->with(['custom_title' => 'gallery', 'id' => $gallery->custom_id], $gallery)->render(),
                    'checkbox' => view('admin.layouts.includes.checkbox')->with('id', $gallery->custom_id)->render(),
                ];
            }
            
        }
        return $records;
    }
}
