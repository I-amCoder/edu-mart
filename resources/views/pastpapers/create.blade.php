@extends('layouts.admin')
@section('pastpapers', 'active')
@section('title', 'Past Papers')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3>Add New TOpic</h3>
            </div>
            <form action="{{ route('past-papers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="category">Select Category</label>
                            <select name="category" id="category" required
                                class="form-control @error('category') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <option value="{{ encrypt($category->id) }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <span role="alert">
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Name/Title</label>
                            <input type="text" name="name" id="name" placeholder="Enter topic name" required
                                value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span role="alert">
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="description">Small Description</label>
                            <input type="text" name="description" id="description" placeholder="Enter topic description"
                                required value="{{ old('description') }}"
                                class="form-control @error('description') is-invalid @enderror">
                            @error('description')
                                <span role="alert">
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="file">File (Pdf)</label>
                            <input accept=".pdf" type="file" name="file" id="file"
                                placeholder="Enter topic file" required value="{{ old('file') }}"
                                class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <span role="alert">
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
