<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.category.index')->with(['custom_title' => 'Category']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.category.create')->with(['custom_title' => 'categories']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['custom_id']   =   getUniqueString('categories');
        $category = Category::create($request->all());
        if ($request->has('image')) {
            $path = $request->file('image')->store('category');
        }
        $category->image = $path;
        if ($category->save()) {
            flash('Category Add successfully!')->success();
        } else {
            flash('Unable to save avatar. Please try again later.')->error();
        }
        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('admin.pages.category.view', compact('category'))->with(['custom_title' => 'Category']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.pages.category.edit', compact('category'))->with(['custom_title' => 'Category']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            if (!empty($request->action) && $request->action == 'change_status') {
                $content = ['status' => 204, 'message' => "something went wrong"];
                if ($category) {
                    $category->is_active = $request->value;
                    if ($category->save()) {
                        $content['status'] = 200;
                        $content['message'] = "Status updated successfully.";
                    }
                }
                return response()->json($content);
            } else {
                $path = $category->image;
                
                //request has remove_profie_photo then delete user image
                if ($request->has('remove_profie_photo')) {
                    if ($category->image) {
                        Storage::delete($category->image);
                    }
                    $path = null;
                }

                if ($request->hasFile('image')) {
                    if ($category->image) {
                        Storage::delete($category->image);
                    }
                    $path = $request->image->store('categories/image');
                }
                $category->fill($request->all());
                $category->image = $path;
                if ($category->save()) {
                    flash('category image updated successfully!')->success();
                } else {
                    flash('Unable to update user. Try again later')->error();
                }
                return redirect(route('admin.categories.index'));
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

            $image = Category::whereIn('custom_id', explode(',', $request->ids))->pluck('image')->toArray();
            foreach ($image as $image) {
                if (!empty($image)) {
                    Storage::delete($image);
                }
            }
            Category::whereIn('custom_id', explode(',', $request->ids))->delete();
            $content['status'] = 200;
            $content['message'] = "Category deleted successfully.";
            $content['count'] = Category::all()->count();
            return response()->json($content);
        } else {
            $category = Category::where('custom_id', $id)->firstOrFail();
            if ($category->profile_photo) {
                Storage::delete($category->profile_photo);
            }
            $category->delete();
            if (request()->ajax()) {
                $content = array('status' => 200, 'message' => "Category deleted successfully.", 'count' => category::all()->count());
                return response()->json($content);
            } else {
                flash('Category deleted successfully.')->success();
                return redirect()->route('admin.categories.index');
            }
        }
    }

    public function listing(Request $request)
    {
        
        extract($this->DTFilters($request->all()));
        $records = [];
        $categories = Category::orderBy($sort_column, $sort_order);

        if ($search != '') {
            $categories->where(function ($query) use ($search) {
                $query
                ->where('image', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $count = $categories->count();

        $records['recordsTotal'] = $count;
        $records['recordsFiltered'] = $count;
        $records['data'] = [];

        $categories = $categories->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);

        $categories = $categories->get();
        foreach ($categories as $index => $category) {

            $params = [
                'checked' => ($category->is_active == 'y' ? 'checked' : ''),
                'getaction' => $category->is_active,
                'class' => '',
                'id' => $category->custom_id,
            ];

            $records['data'][] = [
                'id' => $category->id,
                'name' => $category->name,
                // 'description' => Str::substr($category->description,50).'...',
                'description' => $category->description,
                'number' => $index + 1,
                'image' => '<img src="'.generateUrl($category->image).'" class="table-img-content" alt="icon" height = "50px" width="80px">',
                'created_at' => $category->created_at,
                'active' => view('admin.layouts.includes.switch', compact('params'))->render(),
                'action' => view('admin.layouts.includes.actions')->with(['custom_title' => 'category', 'id' => $category->custom_id], $category)->render(),
                'checkbox' => view('admin.layouts.includes.checkbox')->with('id', $category->custom_id)->render(),
            ];
        }
        // dd($records);
        return $records;
    }
}

