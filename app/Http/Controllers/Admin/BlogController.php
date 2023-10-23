<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function indexBlogCategory()
    {
        $data = BlogCategory::latest()->get();
        return view('backend.admin.blog.all_category', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createBlogCategory()
    {
        return view('backend.admin.blog.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeBlogCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        BlogCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::of($request->category_name)->slug('-'),
        ]);

        $notification = array(
            'message' => "Blog Category Created!",
            'alert-type' => 'success',
        );

        return redirect()->route('blog.category.index')->with($notification);
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
