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
use App\Http\Requests\Admin\PropertyRequest;
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
        // dd($amenitiesToString);

        $slug = Str::of($request->property_name)->slug('-');

        $image = $request->file('property_thumbnail');
        $imgName = $slug.'-'.date('dmY').'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/images/property/thumbnail/'.$imgName);

        $propertyInsert = Property::create([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenitiesToString,
            'property_name' => $request->property_name,
            'property_slug' => $slug,
            'property_code' => 'PC-'.Str::random(5),
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'maximum_price' => $request->maximum_price,
            'property_thumbnail' => $imgName,
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
        $data = Property::findOrFail($id);

        $amenitiesString = $data->amenities_id;
        $amenitiesArray = explode(',',$amenitiesString);

        $propertyType = Type::latest()->get();
        $amenities = Amenity::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->get();
        $multiImage = MultiImage::where('property_id',$id)->get();

        return view('backend.admin.property.edit', compact('data','propertyType', 'amenities','amenitiesArray','activeAgent', 'multiImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // return $request->all();

        $id = $request->id;

        $amenitiesArray = $request->amenities_id;
        $amenitiesToString = implode(',',$amenitiesArray);

        $slug = Str::of($request->property_name)->slug('-');

        Property::findOrFail($id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenitiesToString,
            'property_name' => $request->property_name,
            'property_slug' => $slug,
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'maximum_price' => $request->maximum_price,
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
        ]);

        $notification = array(
            'message' => "Property Updated Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->route('property.index')->with($notification);
    }

    public function updateThumbnail(Request $request)
    {
        $id = $request->id;
        $oldThumbnail = $request->old_thumbnail;

        //Image Part
        $image = $request->file('property_thumbnail');
        $imgName = hexdec(uniqid()).'.'.$image->getClientOriginalName();
        Image::make($image)->resize(370,250)->save('upload/images/property/thumbnail/'.$imgName);

        $imgPath = public_path('upload/images/property/thumbnail/'.$oldThumbnail);
        if (file_exists($imgPath)) {
            unlink($imgPath);
        }

        Property::findOrFail($id)->update([
            'property_thumbnail' => $imgName,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Property Thumbnail Image Updated Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->route('property.index')->with($notification);
    }

    public function updateMultiImage(Request $request)
    {
        $images = $request->multi_img;
        foreach ($images as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            $imgPath = public_path('upload/images/property/multiple/'.$imgDel->photo_name);
            unlink($imgPath);

            $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalName();
            Image::make($img)->resize(770,520)->save('upload/images/property/multiple/'.$imgName);

            MultiImage::where('id',$id)->update([
                'photo_name' => $imgName,
                'updated_at'=> Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => "Multiple Image Updated Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function deleteMultiImage(Request $request, $id)
    {
        $oldImage = MultiImage::findOrFail($id);
        $imgPath = public_path('upload/images/property/thumbnail/'.$oldImage->photo_name);
        unlink($imgPath);

        MultiImage::findOrFail($id)->delete();
        $notification = array(
            'message' => "Multiple Image Delete Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function addMultiImage(Request $request)
    {
        $pid = $request->propertyId;
        $img = $request->file('multi_img');

        $imgName = hexdec(uniqid()).'.'.$img->getClientOriginalName();
        Image::make($img)->resize(770,520)->save('upload/images/property/multiple/'.$imgName);

        MultiImage::insert([
            'property_id' => $pid,
            'photo_name' => $imgName,
            'created_at'=> Carbon::now(),
        ]);

        $notification = array(
            'message' => "Image Added Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
