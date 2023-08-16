<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\menu;
use App\Models\menuitem;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function __construct()
    {
        $topNav = menu::where('location', 1)->first();
        $topNavItems = json_decode($topNav->content);
        $topNavItems = $topNavItems[0];
        foreach ($topNavItems as $menu) {
            $menu->title = menuitem::where('id', $menu->id)->value('title');
            $menu->name = menuitem::where('id', $menu->id)->value('name');
            $menu->slug = menuitem::where('id', $menu->id)->value('slug');
            $menu->target = menuitem::where('id', $menu->id)->value('target');
            $menu->type = menuitem::where('id', $menu->id)->value('type');
            if (!empty($menu->children[0])) {
                foreach ($menu->children[0] as $child) {
                    $child->title = menuitem::where('id', $child->id)->value('title');
                    $child->name = menuitem::where('id', $child->id)->value('name');
                    $child->slug = menuitem::where('id', $child->id)->value('slug');
                    $child->target = menuitem::where('id', $child->id)->value('target');
                    $child->type = menuitem::where('id', $child->id)->value('type');
                }
            }
        }
        view()->share([
            'topNavItems' => $topNavItems,
        ]);
    }
    public function index()
    {
        $highlights = Post::where('highlight', 1)->where('approved', 1)->latest()->take(3)->get();
        $list_id = [];
        foreach ($highlights as $value) {
            $list_id[] = $value->id;
        }
        $posts = Post::where('approved', 1)->whereNotIn('id', $list_id)->latest()->take(10)->get();
        //dd($posts);
        return view('client.home', [
            'posts' => $posts,
            'highlights' => $highlights
        ]);
    }
    public function single(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->first();
        $related = Post::where('category_id', '=', $post->category->id)
            ->where('id', '!=', $post->id)->inRandomOrder()->limit(2)->get();
        //dd($related);
        if (!Auth::check()) { //guest user identified by ip
            $cookie_name = (Str::replace('.', '', ($request->ip())) . '-' . $post->id);
        } else {
            $cookie_name = (Auth::user()->id . '-' . $post->id); //logged in user
        }
        if (Cookie::get($cookie_name) == '') { //check if cookie is set
            $cookie = cookie($cookie_name, '1', 60); //set the cookie
            $post->update([
                'view_counts' => $post->view_counts + 1
            ]);
            return response()
                ->view('client.single', [
                    'post' => $post,
                    'related' => $related
                ])
                ->withCookie($cookie); //store the cookie
        } else {
            return view('client.single', [
                'post' => $post,
                'related' => $related
            ]);
        }
    }
    public function category($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = Post::where('category_id', $category->id)->where('approved', 1)->latest()->paginate(10);
        return view('client.category', [
            'category' => $category,
            'posts' => $posts
        ]);
    }
}
