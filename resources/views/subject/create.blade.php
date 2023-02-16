@extends('layouts.admin')
@section('title', 'Add Subject')
@section('content')
    <div class="container-fluid">
        <h1>Add New Subject</h1>
        <h3 class="text-danger">Class: {{ $class->name }}</h3>
        <form action="{{ route('subjects.store', encrypt($class->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col col-md-6 col-xl-4 mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input required type="text" name="name" id="name" placeholder="Subject Name"
                        class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 col-xl-4 mb-4">
                    <label for="description" class="form-label">Description</label>
                    <input required type="text" name="description" id="description"
                        placeholder="Subject Short Description"
                        class="form-control @error('description') is-invalid @enderror">
                    @error('description')
                        <span role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                @if (count($class->subClasses) > 0)
                    <div class="col-md-6 col-xl-4 mb-4">
                        <label for="subClass" class="form-label">Select Sub Class</label>
                        <select name="subClass" id="subClass" class="form-control @error('subClass') is-invalid @enderror">
                            <option value>Select Sub Class</option>
                            @foreach ($class->subClasses as $subClass)
                                <option value="{{ encrypt($subClass->id) }}">{{ $subClass->name }}</option>
                            @endforeach
                        </select>
                        @error('subClass')
                            <span role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
                @if ($class->type != 'tertiary')
                    <div class="col-md-6 col-xl-4 mb-4">
                        <label for="province" class="form-label">Province</label>
                        <select name="province" id="province" class="form-control @error('province') is-invalid @enderror">
                            <option value>Select Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ encrypt($province->id) }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @error('province')
                            <span role="alert">
                                <strong class="text-danger">{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif
                <div class="col-md-6 col-xl-4 mb-4">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" placeholder="Upload Image"
                        class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h3>Chapters</h3>
                    <div class="row mb-5">
                        <div class="col col-md-4 mb-3">
                            <input required type="number" class="form-control" id="chapter_count">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" id="generate-btn">Generate Fields</button>
                        </div>
                    </div>
                    <div id="field_wrapper">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        $("#generate-btn").click(function(e) {
            e.preventDefault();
            number = $("#chapter_count").val();
            if (number || number > 0) {
                $("#field_wrapper").empty();
                for (let i = 0; i < number; i++) {
                    const element = number[i];
                    $("#field_wrapper").append(
                        `   <div class="row ">
                        <div class="col-md-6">
                            <label class="form-label">Chapter ${i+1} Name</label>
                            <input type="text" class="form-control" name="chapter[${i}][name]">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="chapter[${i}][description]">
                        </div>
                    </div>
                    <hr>
                    `
                    );
                }
            }
        });
    </script>
@endpush
