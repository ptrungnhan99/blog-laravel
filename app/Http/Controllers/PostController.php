<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(8);
        return view('admin.posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        //dd($categories);
        return view('admin.posts.create', [
            'categories' => $categories
        ]);
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|max:300',
            'category_id' => 'required|numeric',
            'content' => 'required',
        ]);

        $data = $request->only(['title', 'slug', 'description', 'content', 'category_id', 'seo_title', 'seo_canonical', 'seo_keyword', 'seo_desc', 'post_type', 'meta_robot']);
        $nameThumbnail = '';

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            if ($file->isValid()) {
                $nameThumbnail = $file->getClientOriginalName();
                $file->move('uploads/post', $nameThumbnail);
            }
        }

        $data['thumbnail'] = $nameThumbnail;
        $data['highlight'] = isset($request->highlight) ? true : false;
        $data['user_id'] =  Auth::id();
        // dd($data);

        Post::create($data); // Create and save the model with the data array.

        return redirect()->route('posts.index');
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
        $post = Post::find($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.posts.edit',  [
            'categories' => $categories,
            'post' => $post
        ]);
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|max:300',
            'category_id' => 'required|numeric',
            'content' => 'required',
        ]);

        $data = $request->only(['title', 'slug', 'description', 'content', 'category_id', 'seo_title', 'seo_canonical', 'seo_keyword', 'seo_desc', 'post_type', 'meta_robot']);
        $post = Post::find($id);
        if ($request->hasFile('thumbnail')) {
            if (File::exists('uploads/post/' . $post->thumbnail)) {
                File::delete('uploads/post/' . $post->thumbnail);
            }
            $file = $request->file('thumbnail');
            if ($file->isValid()) {
                $nameThumbnail = $file->getClientOriginalName();
                $file->move('uploads/post', $nameThumbnail);
            }
        } else {
            $nameThumbnail = $post->thumbnail;
        }
        $data['thumbnail'] = $nameThumbnail;
        $data['highlight'] = isset($request->highlight) ? true : false;
        $data['approved'] = isset($request->approved) ? true : false;
        $data['user_id'] =  Auth::id();
        $post->update($data);
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $post = Post::find($id);
        $post->delete();
        return redirect()->back()->with('success', 'Delete Success!!');
    }

    // Hàm tạo slug tự động
    public function to_slug(Request $request)
    {
        $str = $request->title;
        $data['success'] = 1;
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        $data['message'] =  $str;
        return response()->json($data);
    }

    public function uploadImages(Request $request)
    {
        $images = $request->file('images');
        $uploadedImages = [];

        foreach ($images as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/post'), $imageName);
            $uploadedImages[] = '/uploads/post/' . $imageName; // Adjust the path as needed
        }

        return response()->json([
            'imageUrls' => $uploadedImages,
        ]);
    }
}
