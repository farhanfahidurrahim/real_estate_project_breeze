<?php

namespace App\Http\Controllers\Agent;

use App\Models\Type;
use App\Models\User;
use App\Models\Amenity;
use App\Models\Facility;
use App\Models\Property;
use App\Models\MultiImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AgentPropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data = Property::where('agent_id', $id)->latest()->get();
        return view('backend.agent.property.index', compact('data',));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::latest()->get();
        $amenities = Amenity::latest()->get();

        $id = Auth::user()->id;
        $creditFind = User::where('role','agent')->where('id',$id)->first();
        $creditValue = $creditFind->credit;
        // dd($creditValue);
        if ($creditValue == 1 || $creditValue == 7) {
            return redirect()->route('agent.buy.package');
        } else{
            return view('backend.agent.property.create', compact('types', 'amenities'));
        }
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
            'multi_img' => 'required',
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
            'facility_name' => 'required',
            'distance' => 'required',
        ]);

        $slug = Str::of($request->property_name)->slug('-');

        $amenitiesArray = $request->amenities_id;
        $amenitiesToString = implode(',', $amenitiesArray);

        $image = $request->file('property_thumbnail');
        $imgName = $slug . '-' . date('dmY') . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 250)->save('upload/images/property/thumbnail/' . $imgName);

        $propertyInsert = Property::create([
            'property_name' => $request->property_name,
            'property_slug' => $slug,
            'property_code' => 'PC-' . Str::random(5),
            'property_status' => $request->property_status,
            'lowest_price' => $request->lowest_price,
            'maximum_price' => $request->maximum_price,
            'property_thumbnail' => $imgName,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenitiesToString,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'long_description' => $request->long_description,
            'agent_id' => Auth::user()->id,
            'status' => 1,
        ]);

        //Miltiple Image Upload
        $image = $request->file('multi_img');
        foreach ($image as $img) {
            $imageName = Str::random(5) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('upload/images/property/multiple/' . $imageName);

            MultiImage::create([
                'property_id' => $propertyInsert->id,
                'photo_name' => $imageName,
            ]);
        }

        //Faciltities Add / Add More
        $facilities = Count($request->facility_name);
        if ($facilities != NULL) {
            for ($i = 0; $i < $facilities; $i++) {
                $data = new Facility();
                $data->property_id = $propertyInsert->id;
                $data->facility_name = $request->facility_name[$i];
                $data->distance = $request->distance[$i];
                $data->save();
            }
        }

        //Update User Table 'Credit'
        $id = Auth::user()->id;
        $userId = User::findOrFail($id);
        $accessCredit = $userId->credit;

        User::where('id', $id)->update([
            'credit' => DB::raw('1 + '.$accessCredit),
        ]);

        $notification = array(
            'message' => "Property Created Succesfully!",
            'alert-type' => 'success',
        );

        return redirect()->route('agent.property.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
