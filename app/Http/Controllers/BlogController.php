<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::query()->paginate(10);

        return view('blogs.index',compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        Blog::create($request->all());

        return redirect()->route('blogs.index')->with('success','Created successfully.');
    }


    public function show(Blog $blog)
    {
        return view('blogs.show',compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit',compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $blog->update($request->all());

        return redirect()->route('blogs.index')->with('success','Updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success','Deleted successfully');
    }
}
