<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Amenity;
use App\Models\Property;
use Illuminate\Support\Str;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Property::latest()->get();
        return view('backend.admin.property.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $propertyType = Type::latest()->get();
        $amenities = Amenity::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.admin.property.create', compact('propertyType','amenities','activeAgent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'ptype_id' => 'required',
            'amenities_id' => 'required',
            'property_name' => 'required',
            'property_status' => 'required',
            'lowest_price' => 'required',
            'maximum_price' => 'required',
            'property_thumbnail' => 'required',
            'short_description' => 'required',
            // 'long_description' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'garage' => 'required',
            'garage_size' => 'required',
            'property_size' => 'required',
            'property_video' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'neighborhood' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'agent_id' => 'required',
        ]);

        $amenitiesArray = $request->amenities_id;
        $amenitiesToString = implode(",", $amenitiesArray);
        // dd($amenities);

        $slug = Str::of($request->property_name)->slug('-');

        $image = $request->file('property_thumbnail');
        $imagName = $slug.'-'.date('dmY').'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/images/property/thumbnail/'.$imagName);

        $propertyInsert = Property::create([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenitiesToString,
            'property_name' => $request->property_name,
            'property_slug' => $slug,
            'property_code' => 'PC-'.Str::random(5),
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'maximum_price' => $request->maximum_price,
            'property_thumbnail' => $imagName,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => $request->agent_id,
            'status' => 1,
        ]);

        //Multiple Image Upload
        $image = $request->file('multi_img');
        foreach ($image as $img) {
            $imageName = Str::random(5).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(770,520)->save('upload/images/property/multiple/'.$imageName);
            $storeImg = $imageName;

            MultiImage::create([
                'property_id' => $propertyInsert->id,
                'photo_name' => $storeImg,
            ]);
        }

        //Faciltities Add / Add More
        $facilities = Count($request->facility_name);

        if ($facilities != NULL) {
            for ($i=0; $i < $facilities; $i++) {
                $data = new Facility();
                $data->property_id = $propertyInsert->id;
                $data->facility_name = $request->facility_name[$i];
                $data->distance = $request->distance[$i];
                $data->save();
            }
        }

        $notification = array(
            'message' => "Property Created Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->route('property.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Property::find($id);

        $amenitiesString = $data->amenities_id;
        $amenitiesArray = explode(',',$amenitiesString);

        $amenities = Amenity::latest()->get();

        return view('backend.admin.property.show', compact('data','amenities','amenitiesArray'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
