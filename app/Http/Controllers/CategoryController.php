<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only(['name', 'slug', 'parent_id']);
        $nameThumbnail = '';

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            if ($file->isValid()) {
                $nameThumbnail = $file->getClientOriginalName();
                $file->move('uploads/category', $nameThumbnail);
            }
        }
        $data['thumbnail'] = $nameThumbnail; // Add the thumbnail name to the data array.

        Category::create($data); // Create and save the model with the data array.

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);
        $data = $request->only(['name', 'slug', 'parent_id']);
        $category = Category::find($id);
        if ($request->hasFile('thumbnail')) {
            if (File::exists('uploads/category/' . $category->thumbnail)) {
                File::delete('uploads/category/' . $category->thumbnail);
            }
            $file = $request->file('thumbnail');
            if ($file->isValid()) {
                $nameThumbnail = $file->getClientOriginalName();
                $file->move('uploads/category', $nameThumbnail);
            }
        }
        $data['thumbnail'] = $nameThumbnail;
        $category->update($data);
        return redirect()->route('categories.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::find($id);
        if (count($cat->children) > 0) {
            return redirect()->back()->with('alert', 'Please delete all sub category!!');
        }
        if (File::exists('uploads/category/' . $cat->thumbnail)) {
            File::delete('uploads/category/' . $cat->thumbnail);
        }
        $cat->delete();
        return redirect()->back()->with('success', 'Delete Success!!');
    }
}
