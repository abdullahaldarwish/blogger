<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\http\Requests\Posts\CreatePostsRequest;

use App\http\Requests\Posts\UpdatePostsRequest;
use App\Models\category;
use App\Models\Post;
use App\Models\Tag;

class PostsController extends Controller
{

    public function __construct(){
        $this->middleware('VerifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index')->with('posts', post::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create')->with('categories', category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostsRequest $request)
    {
        $image = $request->image->store('posts', 'public');

        $post = post::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'image'=>$image,
            'published_at'=>$request->published_at,
            'category_id' =>$request->category,
            'user_id' => auth()->user()->id
        ]);
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        session()->flash('success', 'post created successfully');

        return redirect(route('posts.index'));

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
    public function edit(post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories',category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostsRequest $request, post $post)
    {
        $data = $request->only(['title','description','published_at','content']);
        if($request->hasFile('image')){
            $image =$request->image->store('posts', 'public');

            $post->deleteImage();

            $data['image'] = $image;
            
            if($request->tags){
                $post->tags()->sync($request->tags);
            }
        }
            $post->update($data);

            session()->flash('success', 'post updated successfully');

            //dd('hello');
             return redirect(route('posts.index'));
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstorfail();

        if($post->trashed()){
            $post->deleteImage();
            $post->Forcedelete();
        }
        else{
            $post->delete();
        }
        session()->flash('success', 'post trashed successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display Trashed Posts.
     */
    public function trashed(){
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
        //with('posts', post::all())=== withPosts(Post:all)
    }

    public function restore($id){
        $post = Post::withTrashed()->where('id',$id)->firstorfail();
        $post->restore();

        session()->flash('success', 'post restored successfully');
        
        return redirect()->back();
    }
}
