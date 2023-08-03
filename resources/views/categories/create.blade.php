@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{isset($category) ? 'edit category': 'create category'}}
        </div>
        <div class="card-body">
            @include('partials.errors')
            <form action="{{isset($category) ? route('categories.update', $category->id): route('categories.store') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="forn-group">
                    <label for="name">name</label>
                    <input type="text" id="name" name="name" value="{{isset($category) ? $category->name : ''}}" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{isset($category)? 'update category':'Add Category'}}</button>
                </div>
            </form>
        </div>
    </div>
@endsection