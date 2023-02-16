@extends('layouts.admin')
@section('title', 'Manage Classs')
@section('content')
    <div class="container-fluid">
        <h1>Classs Managment</h1>
        <div class="card">
            <div class="card-header">
                <button class="btn btn-primary addNewClass">Add New</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Description</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($classes as $class)
                                <tr>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->type }}</td>
                                    <td>{{ $class->description }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.classes.destroy', $class->id) }}">
                                            @csrf
                                            @method('delete')
                                            <a href="{{ route('admin.class.details', $class->id) }}" class="btn btn-sm"
                                                data-toggle="tooltip" title="Details">
                                                <i class="fa fa-desktop text-primary"></i>
                                            </a>
                                            <button data-toggle="tooltip" title="Edit" data-id="{{ $class->id }}"
                                                data-name="{{ $class->name }}" data-description="{{ $class->description }}"
                                                class="btn btn-sm text-warning editClass"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="submit" class="btn btn-sm " data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>You Don't have any classes yet</td>
                                </tr>
                                <tr>
                                    <td>
                                        <button class="btn btn-primary addNewClass">Add New</button>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Models --}}
    <!-- Modal -->
    <div class="modal fade" id="addNewClassModal" tabindex="-1" role="dialog" aria-labelledby="addNewClassModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewClassModalTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.classes.store') }}" method="POST" id="add-class-form">
                        @csrf
                        <input required type="hidden" name="class_id">
                        <div class="form-group row mb-4">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input required type="text"
                                    class="form-control @error('class_name') is-invalid @enderror" name="class_name"
                                    placeholder="E.g 6th">
                                @error('class_name')
                                    <span role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col">
                                <label for="type" class="form-label">Type</label>
                                <select name="class_type" required id="class_type" class="form-control">

                                    <option value>Not Specified</option>
                                    <option value="primary">Primary</option>
                                    <option value="secondary">Secondary</option>
                                    <option value="tertiary ">Tertiary </option>
                                </select>
                                @error('class_type')
                                    <span role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col">
                                <label for="name" class="form-label">Description</label>
                                <input required type="text"
                                    class="form-control @error('class_description') is-invalid @enderror"
                                    name="class_description" placeholder="A Small Descripion About Class">
                                @error('class_description')
                                    <span role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="document.getElementById('add-class-form').submit()"
                        class="btn btn-primary">Save / Update Class</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End MOdels --}}
@endsection


@push('js')
    <script>
        $('.addNewClass').click(function(e) {
            e.preventDefault();
            $("#addNewClassModal").modal('show');
        });


        $('.editClass').click(function(e) {
            e.preventDefault();
            $('input[name="class_id"]').val($(this).data('id'));
            $('input[name="class_name"]').val($(this).data('name'));
            $('input[name="class_address"]').val($(this).data('address'));
            $('input[name="class_description"]').val($(this).data('description'));
            $("#addNewClassModal").modal('show');
        });
        @if (Session::has('errors'))
            $("#addNewClassModal").modal('show');
        @endif
    </script>
@endpush
