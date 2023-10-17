<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Illuminate\Http\Request;

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
        $propertyType = PropertyType::latest()->get();
        $amenities = Amenity::latest()->get();
        $activeAgent = User::where('status','active')->where('role','agent')->latest()->get();
        return view('backend.admin.property.create', compact('propertyType','amenities','activeAgent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ptype_id' => 'required',
            'amenities_id' => 'required',
            'property_name' => 'required',
            'property_slug' => 'required',
            'property_code' => 'required',
            'property_status' => 'required',
            'lowest_price' => 'required',
            'maximum_price' => 'required',
            'property_thumbnail' => 'required',
            'short_description' => 'required',
            'long_description' => 'required',
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
            'featured' => 'required',
            'hot' => 'required',
            'agent_id' => 'required',
            'status' => 'required',
        ]);
        return $request->all();
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
