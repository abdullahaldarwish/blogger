<?php

namespace App\Http\Controllers;

use App\models\Tag;

use Illuminate\Http\Request;

use App\http\requests\Tags\CreateTagRequest;

use App\http\requests\Tags\UpdateTagsRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tags.index')->with('tags', Tag::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTagRequest $request)
    {
        Tag::create([
            'name'=>$request['name']
        ]);

        session()->flash('success', 'Tag created successfully');

        return redirect(route('tags.index'));
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
    public function edit(tag $tag)
    {
        return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagsRequest $request, tag $tag)
    {
        $tag->update([
            'name'=>$request->name
        ]);

        session()->flash('success', 'Tag updated successfully');

        return redirect(route('tags.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tag $tag)
    {
        if ($tag->posts->count()>0){
            session()->flash('error', 'cannot delete tag because it has posts');

            return redirect()->back();
        }
        $tag->delete();

        session()->flash('success', 'Tag deleted successfully');

        return redirect(route('tags.index'));
    }
}
