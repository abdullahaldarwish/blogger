@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end">
<a href="{{route('categories.create')}}" class="btn btn-success mb-2">Add Category</a>
</div>
    <div class="card card-default">
        <div class="card-header">categories</div>
        <div class="card-body">
            @if ($categories->count() > 0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Posts count</th>
                    <th></th>
                </thead>

                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{$category->name}}</td>
                            <td>{{$category->posts->count()}}</td>
                            <td>
                                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-info btn-sm">edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="" method="POST" id="DeleteCategoryForm">
                    @csrf
                    @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="deleteModalLabel">Delete Category</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p class="text-center text-bold">Are You sure yo want to delete this category??</p>
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
                <h3 class="text-center">no categories yet</h3>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id){
            var form = document.getElementById('DeleteCategoryForm')
            form.action = '/categories/'+ id
            console.log('deleting',form)
            $('#deleteModal').modal('show')
        }
    </script>
@endsection