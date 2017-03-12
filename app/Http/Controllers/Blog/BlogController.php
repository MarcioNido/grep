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
        if (isset($request->term) && $request->term != '') {
            $posts = Post::where(['ativo'=>1])->where('titulo', 'like', "%{$request->term}%")->orderBy('id', 'desc')->paginate(12);
        } else {
            $posts = Post::where(['ativo' => 1])->orderBy('id', 'desc')->paginate(12);
        }
        return view('blog.public.lista', ['posts' => $posts, 'term' => $request->term]);
    }

    public function viewPost($key)
    {
        $post = Post::where(['key' => $key])->first();
        return view('blog.public.post', ['post' => $post]);
    }


}
