<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Type;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $types = Type::latest()->limit(5)->get();
        $properties = Property::where('status', '1')->where('featured','1')->latest()->limit(3)->get();
        return view('frontend.index', compact('types','properties'));
    }

    public function propertyDetails($id, $slug)
    {
        $property = Property::findOrFail($id);
        $multiImage = MultiImage::where('property_id',$id)->get();

        $amenities = $property->amenities_id;
        $prop_amenities = explode(',',$amenities);
        // dd($prop_amenities);
        $amenityNames = Amenity::whereIn('id', $prop_amenities)->pluck('amenity_name'); // fetch amenity names from DB

        $typeId = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id',$typeId)->where('id','!=', $id)->limit(3)->get();
        // dd($relatedProperty);

        return view('frontend.property.property_details', compact('property','multiImage','amenityNames','relatedProperty'));
    }
}
