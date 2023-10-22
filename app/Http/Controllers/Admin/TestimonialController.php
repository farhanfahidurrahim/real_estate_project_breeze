<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Testimonial::latest()->get();
        return view('backend.admin.testimonial.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'message' => 'required',
            'image' => 'required',
        ]);

        $slug = Str::of($request->name)->slug('-');

        //Image Upload
        if ($request->file('image')) {
            $file = $request->image;
            $filename = $slug.'-'.Str::random(3).'.'.$file->getClientOriginalExtension();
            Image::make($file)->resize(100,100)->save('upload/images/testimonial/'.$filename);
        }

        Testimonial::create([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $filename,
        ]);

        $notification = array(
            'message' => "Testimonial Create!",
            'alert-type' => 'success',
        );

        return redirect()->route('testimonial.index')->with($notification);
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
