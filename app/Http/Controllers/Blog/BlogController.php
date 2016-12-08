<?php

namespace App\Http\Controllers\Blog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog\Post;

//use Illuminate\Http\Request;

class BlogController extends Controller
{

    /**
     * Show the list for posts
     *
     * @return \Illuminate\Http\Response
     */
    public function lista(Request $request)
    {
        $posts = Post::where(['ativo'=>1])->get();
        return view('blog.public.lista', ['posts' => $posts]);
    }

    public function viewPost($key)
    {
        $post = Post::where(['key' => $key])->first();
        return view('blog.public.post', ['post' => $post]);
    }


}
