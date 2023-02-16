@extends('layouts.admin')
@section('title', 'Manage Jobs')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Manage Job Categories</h3>
                        <button class="btn btn-primary add-cat-btn">Add New Category</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>
                                            <td>
                                                <form action="{{ route('job.category.delete', encrypt($category->id)) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="edit-cat-btn btn btn-sm"
                                                        data-name="{{ $category->name }}"
                                                        data-description="{{ $category->description }}"
                                                        data-id="{{ encrypt($category->id) }}">
                                                        <i class="fa fa-edit text-warning"></i>
                                                    </button>
                                                    <button type="submit" data-toggle="tooltip" title="Delete"
                                                        class="btn btn-sm">
                                                        <i class="text-danger fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="font-weight-bold">
                                                You Don't Have any Category Yet!
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="pb-4">
                            <h3>Job Posts</h3>
                            <a href="{{ route('admin.job-blog.create') }}" class="btn btn-primary">Add New Post</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Cover</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <td><img src="{{ $post->image_path }}" alt="Image" class="img-table-sm"></td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ is_null($post->category) ? 'UnCategorized' : $post->category->name }}
                                            </td>
                                            <td>
                                                <form action="{{ route('admin.job-blog.destroy', encrypt($post->id)) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a data-toggle="tooltip" title="Edit"
                                                        href="{{ route('admin.job-blog.edit', encrypt($post->id)) }}"
                                                        class="btn btn-sm">
                                                        <i class="fa fa-edit text-warning"></i></a>
                                                    <button type="submit" data-toggle="tooltip" title="Delete"
                                                        class="btn btn-sm"><i class="fa fa-trash text-danger">
                                                        </i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>You don't Have Any Job Posts Yet!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalTitle">Add Sub Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('job.category.save') }}" method="POST">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-12">
                                @csrf
                                <input value="{{ old('category_id') }}" type="hidden" name="category_id">
                                <label>Name</label>
                                <input value="{{ old('name') }}" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    placeholder="Category Name" required>
                                @error('name')
                                    <span role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-12">
                                <label>Description</label>
                                <input value="{{ old('description') }}" type="text"
                                    class="form-control @error('description') is-invalid @enderror" name="description"
                                    id="description" placeholder="Category Description" required>
                                @error('description')
                                    <span role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" onclick="document.getElementById('add-sub-class-form').submit()"
                            class="btn btn-primary">Save / Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(".add-cat-btn").click(function(e) {
            e.preventDefault();
            $("#addCategoryModal").modal('show');
        });
        $(".edit-cat-btn").click(function(e) {
            e.preventDefault();
            $("input[name='category_id']").val($(this).data('id'));
            $("input[name='name']").val($(this).data('name'));
            $("input[name='description']").val($(this).data('description'));
            $("#addCategoryModal").modal('show');
        });
        @if (Session::has('errors'))
            $("#addCategoryModal").modal('show');
        @enderror
    </script>
@endpush
