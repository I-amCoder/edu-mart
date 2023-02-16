@extends('layouts.admin')
@section('title', 'Manage Jobs')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="" class="btn btn-danger float-right">Cancel</a>
                        <h4>Add New Job Post</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.job-blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="title">Job Title</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text"
                                        name="title" id="title" value="{{ old('title') }}"
                                        placeholder="Enter Job Title" required>
                                    @error('title')
                                        <span role="alert">
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apply_link">Job Title</label>
                                    <input class="form-control @error('apply_link') is-invalid @enderror" type="text"
                                        name="apply_link" id="apply_link" value="{{ old('apply_link') }}"
                                        placeholder="Enter Job Title" required>
                                    @error('apply_link')
                                        <span role="alert">
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="category">Job Category</label>
                                    <select name="category" id="category" class="form-control">
                                        <option value="{{ encrypt(0) }}">Uncategorized</option>
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
                                <div class="form-group col-md-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                                            <img src="https://via.placeholder.com/1000x800" alt="upload Image">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists img-thumbnail"
                                            style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                            <span class="btn btn-outline-secondary btn-file"><span
                                                    class="fileinput-new">Select image</span><span
                                                    class="fileinput-exists">Change</span><input type="file"
                                                    name="image"></span>
                                            <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                                data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                    @error('image')
                                        <span role="alert">
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <textarea id="description" name="description"></textarea>
                                    @error('description')
                                        <span role="alert">
                                            <strong class="text-danger">
                                                {{ $message }}
                                            </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.css') }}">
@endpush
@push('js')
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: ($(window).height() - 300),
                callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    }
                }
            });
        });

        function uploadImage(image) {
            var data = new FormData();
            data.append("image", image);
            data.append("_token", "{{ csrf_token() }}")
            $.ajax({
                url: '{{ route('image.upload') }}',
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                success: function(url) {
                    console.log(url);
                    var image = $('<img>').attr('src', url);
                    $('#description').summernote("insertNode", image[0]);
                },
                error: function(e) {
                    alert('Error in uploading the Image');
                }
            });
        }
    </script>
@endpush
