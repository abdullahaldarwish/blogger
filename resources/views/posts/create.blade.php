@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">{{isset($post)? 'Edit post':'Create post'}}</div>

        <div class="card-body">
            @include('partials.errors')
            <form action="{{isset($post)?route('posts.update',$post->id):route('posts.store')}}" method="POST"enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" name="title" id="title" class="form-control"value="{{isset($post)?$post->title:''}}">
                </div>

                <div class="form-group">
                    <label for="description">description</label>
                    <textarea name="description" id="description" cols="5" rows="5" class="form-control">{{isset($post)?$post->description:''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="content">content</label>
                    <input id="content" type="hidden" name="content" value="{{isset($post)?$post->content:''}}">
                    <trix-editor input="content"></trix-editor>
                </div>

                <div class="form-group">
                    <label for="published_at">published_at</label>
                    <input type="text" name="published_at" id="published_at" class="form-control" value="{{isset($post)?$post->published_at:''}}">
                </div>
                @if (isset($post))
                    <div class="form-group">
                        <img src="{{asset('storage/'.$post->image)}}" style="width: 100%" alt="">
                    </div>
                @endif
                <div class="form-group">
                    <label for="image">image</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>

                <div class="form-group">
                    <label for="category">category</label>
                    <select name="category" id="category" class="form-control">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->name}}
                                @if (@isset($post))
                                    @if ($category->id == $post->category_id)
                                        selected
                                    @endif
                                @endif
                            </option>
                        @endforeach
                    </select>
                </div>
                @if ($tags->count()>0)
                    <div class="form-group">
                        <label for="tags">tags</label>
                        <select name="tags[]" id="tags" class="form-control tags-selector"multiple>
                            @foreach ($tags as $tag)
                                <option value="{{$tag->id}}"
                                    @if (isset($post))
                                        @if ($post->hasTag($tag->id))
                                            selected
                                        @endif
                                    @endif
                                    
                                    >{{$tag->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{isset($post)?'Update post':'Create post'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/trix@2.0.5/dist/trix.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    flatpickr('#published_at',{
        enableDate: true
    });

    $(document).ready(function() {
        $('.tags-selector').select2();
    });
</script>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/trix@2.0.5/dist/trix.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection