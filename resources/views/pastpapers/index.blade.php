@extends('layouts.admin')
@section('pastpapers', 'active')
@section('title', 'Past Papers')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Past Paper Topics</h3>
                        <button class="btn btn-success addBtn">Add New</button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>Name</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            <form action="{{ route('past-papers-category.delete', $category->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('delete')
                                                <button title="Edit" data-toggle="tooltip" data-id="{{ $category->id }}"
                                                    data-name="{{ $category->name }}" class="btn btn-sm editCat">
                                                    <i class="fa fa-edit text-warning"></i>
                                                </button>
                                                <button type="submit" class="btn-sm btn" title="Delete"
                                                    data-toggle="tooltip">
                                                    <i class="fa fa-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">You Don't Have any PastPaper Topic Yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Manage Topics</h3>
                        <a href="{{ route('past-papers.create') }}" class="btn btn-primary">Add New</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    @forelse ($papers as $paper)
                                        <tr>
                                            <td>{{ $paper->name }}</td>
                                            <td>{{ $paper->description }}</td>
                                            <td>
                                                <form action="{{ route('past-papers.destroy', $paper->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('past-papers.edit', $paper->id) }}" title="Edit"
                                                        data-toggle="tooltip" class="btn btn-sm ">
                                                        <i class="fa fa-edit text-warning"></i>
                                                    </a>
                                                    <button type="submit" class="btn-sm btn" title="Delete"
                                                        data-toggle="tooltip">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">
                                                You havn't uploaded any paper/article yet
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
    </div>

    {{-- Modals --}}
    <div class="modal fade" id="addTopic" tabindex="-1" role="dialog" aria-labelledby="addTopicTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTopicTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('past-papers-category.store') }}" method="POST" id="add-class-form">
                        @csrf
                        <input required type="hidden" name="topic_id">
                        <div class="form-group row mb-4">
                            <div class="col">
                                <label for="name" class="form-label">Name</label>
                                <input required type="text"
                                    class="form-control @error('topic_name') is-invalid @enderror" name="topic_name"
                                    placeholder="E.g CSS" required>
                                @error('topic_name')
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
@endsection

@push('js')
    <script>
        $(".addBtn").click(function(e) {
            e.preventDefault();
            $("#addTopic").modal('show');
        });
        $(".editCat").click(function(e) {
            e.preventDefault();
            $("#addTopic").modal('show');
            $("input[name='topic_id']").val($(this).data('id'))
            $("input[name='topic_name']").val($(this).data('name'))
        });
    </script>
@endpush
