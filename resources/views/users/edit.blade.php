@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">my profile</div>

    <div class="card-body">
        @include('partials.errors')
        <form action="{{route('users.update-profile')}}"method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control"name="name" id="name"value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="about">about me</label>
                <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{$user->about}}</textarea>
            </div>
            <button type="submit" class="btn btn-success">update profile</button>
        </form>
    </div>
</div>
@endsection
