@extends('layouts.admin')
@section('title', 'Manage Topics | Add Article')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.topic.index', $chapter->id) }}" class="btn btn-danger float-right">Back</a>
                <h5>Add New Topic</h5>
                <p class="text-danger">Class: {{ $chapter->subject->myClass->name }}</p>
                <p class="text-danger">Subject: {{ $chapter->subject->name }}</p>

            </div>
            <div class="card-body">
                <form action="{{ route('admin.topic.update', [$chapter->id, $topic->id]) }}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="from-group row">
                        <div class="col-md-6 mb-4 col-xl-4">
                            <label class="form-label">Name</label>
                            <input required value="{{ $topic->name }}" type="text" name="topic_name"
                                value="{{ old('topic_name') }}" class="form-control">
                            @error('topic_name')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4 col-xl-4">
                            <label class="form-label">Description</label>
                            <input required value="{{ $topic->description }}" type="text" name="description"
                                value="{{ old('description') }}" class="form-control">
                            @error('description')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="image" class="form-label">Topic Cover Image</label>
                        <div class="col-12 ">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                    <img src="{{ $topic->image_path }}" alt="Image">
                                </div>
                                <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;  ">
                                </div>
                                <div>
                                    <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                            image</span><span class="fileinput-exists">Change</span><input type="file"
                                            name="topic_image"></span>
                                    <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                        data-dismiss="fileinput">Remove</a>
                                </div>
                            </div>
                            @error('topic_image')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="pdf_file" class="form-label">PDF File</label>
                            <input accept=".pdf" type="file" name="pdf_file" id="pdf_file" class="form-control">
                            @error('pdf_file')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('.fileinput').fileinput()
    </script>
@endpush
