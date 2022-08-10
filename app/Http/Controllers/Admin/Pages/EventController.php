<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Event;
use App\Models\EventGallery;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.event.index')->with(['custom_title' => 'Event']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereIsActive('y')->get();
        return view('admin.pages.event.create',compact('categories'))->with(['custom_title' => 'Event']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request['custom_id']   =   getUniqueString('events');
        $event = Event::create($request->all());
        $event->benifical = $request->benifical;
        if ($request->has('image')) {
            $path = $request->file('image')->store('Event');
        }
        $event->image = $path;
        foreach ($request->event_image as $image) {
            $path = $image->store('Event_image');
            $event_gallery = EventGallery::create([
                'custom_id' => getUniqueString('event_galleries'),
                'image' => $path,
                'event_id' => $event->id,
            ]);
            $extension = $image->extension();
            
            $type ='video';
            if($extension != 'mp4'){
                $type = 'image';
            }
            $event_gallery->type = $type;
            $event_gallery->save();
        }
        if ($event->save()) {
            flash('Event Add successfully!')->success();
        } else {
            flash('Unable to save avatar. Please try again later.')->error();
        }
        return redirect(route('admin.events.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('admin.pages.event.view', compact('event'))->with(['custom_title' => 'Event']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.pages.event.edit', compact('event'))->with(['custom_title' => 'Event']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        try {
            if (!empty($request->action) && $request->action == 'change_status') {
                $content = ['status' => 204, 'message' => "something went wrong"];
                if ($event) {
                    $event->is_active = $request->value;
                    if ($event->save()) {
                        $content['status'] = 200;
                        $content['message'] = "Status updated successfully.";
                    }
                }
                return response()->json($content);
            } else {
                $path = $event->image;
                
                //request has remove_profie_photo then delete user image
                if ($request->has('remove_profie_photo')) {
                    if ($event->image) {
                        Storage::delete($event->image);
                    }
                    $path = null;
                }

                if ($request->hasFile('image')) {
                    if ($event->image) {
                        Storage::delete($event->image);
                    }
                    $path = $request->image->store('Event/image');
                }
                $event->fill($request->all());
                $event->benifical = $request->benifical;
                $event->image = $path;
                if ($event->save()) {
                    flash('Event updated successfully!')->success();
                } else {
                    flash('Unable to update user. Try again later')->error();
                }
                return redirect(route('admin.events.index'));
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

            $image = Event::whereIn('custom_id', explode(',', $request->ids))->pluck('image')->toArray();
            foreach ($image as $image) {
                if (!empty($image)) {
                    Storage::delete($image);
                }
            }
            Event::whereIn('custom_id', explode(',', $request->ids))->delete();
            $content['status'] = 200;
            $content['message'] = "Event deleted successfully.";
            $content['count'] = Event::all()->count();
            return response()->json($content);
        } else {
            $event = Event::where('custom_id', $id)->firstOrFail();
            if ($event->profile_photo) {
                Storage::delete($event->profile_photo);
            }
            $event->delete();
            if (request()->ajax()) {
                $content = array('status' => 200, 'message' => "Event deleted successfully.", 'count' => Event::all()->count());
                return response()->json($content);
            } else {
                flash('Event deleted successfully.')->success();
                return redirect()->route('admin.events.index');
            }
        }
    }

    public function listing(Request $request)
    {
        
        extract($this->DTFilters($request->all()));
        $records = [];
        $events = Event::orderBy($sort_column, $sort_order);

        if ($search != '') {
            $events->where(function ($query) use ($search) {
                $query
                ->where('image', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $count = $events->count();

        $records['recordsTotal'] = $count;
        $records['recordsFiltered'] = $count;
        $records['data'] = [];

        $events = $events->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);

        $events = $events->get();
        foreach ($events as $index => $event) {

            $params = [
                'checked' => ($event->is_active == 'y' ? 'checked' : ''),
                'getaction' => $event->is_active,
                'class' => '',
                'id' => $event->custom_id,
            ];

            $records['data'][] = [
                'id' => $event->id,
                'name' => $event->name,
                // 'description' => Str::substr($event->description,50).'...',
                'description' => $event->description,
                'benifical' => $event->benifical,
                'number' => $index + 1,
                'image' => '<img src="'.generateUrl($event->image).'" class="table-img-content" alt="icon" height = "50px" width="80px">',
                'event_at' => $event->event_at,
                'active' => view('admin.layouts.includes.switch', compact('params'))->render(),
                'action' => view('admin.layouts.includes.actions')->with(['custom_title' => 'Event', 'id' => $event->custom_id], $event)->render(),
                'checkbox' => view('admin.layouts.includes.checkbox')->with('id', $event->custom_id)->render(),
            ];
        }
        // dd($records);
        return $records;
    }
}