@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{isset($tag) ? 'edit tag': 'create tag'}}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{isset($tag) ? route('tags.update', $tag->id): route('tags.store') }}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="forn-group">
                    <label for="name">name</label>
                    <input type="text" id="name" name="name" value="{{isset($tag) ? $tag->name : ''}}" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{isset($tag)? 'update tag':'Add Tag'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection