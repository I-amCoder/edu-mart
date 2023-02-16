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
                <form action="{{ route('admin.topic.store', $chapter->id) }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="from-group row">
                        <div class="col-md-6 mb-4 col-xl-4">
                            <label class="form-label">Name</label>
                            <input required type="text" name="topic_name" value="{{ old('topic_name') }}"
                                class="form-control">
                            @error('topic_name')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-4 col-xl-4">
                            <label class="form-label">Description</label>
                            <input required type="text" name="description" value="{{ old('description') }}"
                                class="form-control">
                            @error('description')
                                <span role="alert">
                                    <strong class="text-danger">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-12">
                            <label for="image" class="form-label">Topic Cover Image</label>
                            <input required type="file" name="topic_image" id="image" class="form-control">
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
                            <input accept=".pdf" required type="file" name="pdf_file" id="pdf_file"
                                class="form-control">
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
