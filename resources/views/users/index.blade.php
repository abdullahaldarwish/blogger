@extends('layouts.app')

@section('content')
    
    <div class="card card-default">
        <div class="card-header">Users</div>

        <div class="card-body">
            @if ($users->count() > 0)
            <table class="table">
                <thead>
                    <th>image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                               {{-- {{Gravatar::src($user->email)}} --}}
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                {{$user->role}}
                            </td>
                            <td>
                                @if (!$user->isAdmin())
                                    <form action="{{route('users.make-admin', $user->id)}}"method="POST">
                                        @csrf
                                        <button type="submit"class="btn btn-success btn-sm">Make an admin</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center">no Users yet</h3>
            @endif
        </div>
    </div>
@endsection