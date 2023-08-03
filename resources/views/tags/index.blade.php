@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
<a href="{{route('tags.create')}}" class="btn btn-success mb-2">Add tag</a>
</div>
    <div class="card card-default">
        <div class="card-header">tags</div>
        <div class="card-body">
            @if ($tags->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Posts count</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{$tag->name}}</td>
                            <td>
                                {{$tag->posts->count()}}
                            </td>
                            <td>
                                <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-info btn-sm">edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="" method="POST" id="DeletetagForm">
                    @csrf
                    @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="deleteModalLabel">Delete tag</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p class="text-center text-bold">Are You sure yo want to delete this tag??</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, go back</button>
                              <button type="submit" class="btn btn-danger">yes, delete</button>
                            </div>
                      </div>
                  </form>
                </div>
              </div>
            @else
                <h3 class="text-center">no tags yet</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id){
            var form = document.getElementById('DeletetagForm')
            form.action = '/tags/'+ id
            console.log('deleting',form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection