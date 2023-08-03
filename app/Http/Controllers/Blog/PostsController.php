<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostsController extends Controller
{
    public function show(post $post){
        return view('blog.show')->with('post',$post);
    }
    public function tag(tag $tag){
        return view('blog.tag')
        ->with('tag',$tag)
        ->with('posts',$tag->posts()->searched()->simplepaginate(2))
        ->with('categories',Category::all())
        ->with('tags',Tag::all());
    }
    public function category(category $category){
       return view('blog.category')
       ->with('category',$category)
       ->with('categories',Category::all())
       ->with('tags',Tag::all())
       ->with('posts',$category->posts()->searched()->simplepaginate(2));
    }
}
