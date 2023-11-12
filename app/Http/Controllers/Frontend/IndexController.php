<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Property;

class IndexController extends Controller
{
    public function index()
    {
        $types = Type::latest()->limit(5)->get();
        $properties = Property::where('status', '1')->where('featured','1')->latest()->limit(3)->get();
        return view('frontend.index', compact('types','properties'));
    }
}
