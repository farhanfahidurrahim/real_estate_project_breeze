<?php

namespace App\Http\Controllers\Admin;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
     * ..........Blog Post............................
    */

    public function indexBlogPost()
    {
        $data = BlogPost::latest()->get();
        return view('backend.admin.blog.all_post', compact('data'));
    }

    public function createBlogPost()
    {
        $categories = BlogCategory::orderBy('id','desc')->get();
        return view('backend.admin.blog.add_post', compact('categories'));
    }

    public function storeBlogPost(Request $request)
    {
        //return $request->all();
        $request->validate([
            'post_title' => 'required',
            'blog_cat_id' => 'required',
            'short_desc' => 'required',
            'long_desc' => 'required',
            'post_tag' => 'required',
            'post_image' => 'required',
        ]);

        $slug = Str::of($request->post_title)->slug('-');

        //Blog Post Image Upload
        $image = $request->file('post_image');
        $imageName = $slug.'-'.date('mdY').'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,250)->save('upload/images/blog-post/'.$imageName);

        BlogPost::create([
            'blog_cat_id' => $request->blog_cat_id,
            'user_id' => Auth::user()->id,
            'post_title' => $request->post_title,
            'post_slug' => $slug,
            'short_desc' => $request->short_desc,
            'long_desc' => $request->long_desc,
            'post_tag' => $request->post_tag,
            'post_image' => $imageName,
        ]);

        $notification = array(
            'message' => "Blog Post Created!",
            'alert-type' => 'success',
        );

        return redirect()->route('blog.post.index')->with($notification);
    }
}
