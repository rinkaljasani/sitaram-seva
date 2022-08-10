<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddressRequest;
use App\Models\Address;
use App\Models\City;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.address.index')->with(['custom_title' => 'Addresses']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.pages.address.create',compact('cities'))->with(['custom_title' => 'Address']);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $request['custom_id']   =   getUniqueString('addresses');
        $address = Address::create($request->all());
        // dd($request->all());
        $path = NULL;
        if ($request->has('image')) {
            $path = $request->file('image')->store('address/image');
        }
        $address->image = $path;
        $address->save();
        if ($address) {
            flash('address created successfully!')->success();
        } else {
            flash('Unable to save address. Please try again later.')->error();
        }
        return redirect(route('admin.addresses.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        $cities = City::all();
        return view('admin.pages.address.edit', compact('cities','address'))->with(['custom_title' => 'Address']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, Address $address)
    {
        if (!empty($request->action) && $request->action == 'change_status') {
            $content = ['status' => 204, 'message' => "something went wrong"];
            if ($address) {
                $address->is_active = $request->value;
                if ($address->save()) {
                    $content['status'] = 200;
                    $content['message'] = "Status updated successfully.";
                }
            }
            return response()->json($content);
        } else {
            $address->fill($request->all());
            if ($address->save()) {
                flash('User details updated successfully!')->success();
            } else {
                flash('Unable to update user. Try again later')->error();
            }
            return redirect(route('admin.addresses.index'));
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
        if (!empty($request->action) && $request->action == 'delete_all') {
            $content = ['status' => 204, 'message' => "something went wrong"];
            City::whereIn('custom_id', explode(',', $request->ids))->delete();
            $content['status'] = 200;
            $content['message'] = "city deleted successfully.";
            $content['count'] = City::all()->count();
            return response()->json($content);
        } else {
            $city = City::where('custom_id', $custom_id)->firstOrFail();
            $city->delete();
            if (request()->ajax()) {
                $content = array('status' => 200, 'message' => "city deleted successfully.", 'count' => City::all()->count());
                return response()->json($content);
            } else {
                flash('city deleted successfully.')->success();
                return redirect()->route('admin.cities.index');
            }
        }
    }

    public function listing(Request $request)
    {
        extract($this->DTFilters($request->all()));
        $records = [];
        $addresses = Address::with('city')->orderBy($sort_column, $sort_order);

        if ($search != '') {
            $addresses->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('manager_name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('contact_no', 'like', "%{$search}%")
                    ->orWhere('alternative_contact_no', 'like', "%{$search}%")
                    ->orWhereHas('city',function($q) use ($search){
                        $q->where('name', 'like', "%{$search}%");
                    });
                });
        }

        $count = $addresses->count();
        $records['recordsTotal'] = $count;
        $records['recordsFiltered'] = $count;
        $records['data'] = [];

        $addresses = $addresses->offset($offset)->limit($limit)->orderBy($sort_column, $sort_order);
        $addresses = $addresses->get();
        foreach ($addresses as $address) {
            $params = [
                'checked'   =>  ($address->is_active == 'y' ? 'checked' : ''),
                'getaction' =>  $address->is_active,
                'class'     =>  '',
                'id'        =>  $address->custom_id,
            ];

            $records['data'][] = [
                'id'            =>  $address->custom_id,
                'title'          =>  $address->title,
                'manager_name'          =>  $address->manager_name,
                'address'          =>  $address->address.' ,'.$address->city->name.' ,'.$address->city->state->name.' ,'.$address->city->state->country->name,
                'contact_no'          =>  $address->contact_no,
                'alternative_contact_no'          =>  $address->alternative_contact_no,
                'city_name'  =>  $address->city->name,
                'active'        =>  view('admin.layouts.includes.switch', compact('params'))->render(),
                'action'        =>  view('admin.layouts.includes.actions')->with(['custom_title' => 'Cities', 'id' => $address->custom_id], $address)->render(),
                'checkbox'      =>  view('admin.layouts.includes.checkbox')->with('id', $address->custom_id)->render(),
            ];
        }
    
        return $records;
    }
}

