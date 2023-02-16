@extends('layouts.admin')
@section('title', 'Add Subject')
@section('content')
    <div class="container-fluid">
        <h1>Add New Subject</h1>
        <h3 class="text-danger">Class: {{ $class->name }}</h3>
        <form action="{{ route('subjects.update', [encrypt($class->id), $subject->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col col-md-6 col-xl-4 mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ $subject->name }}" required type="text" name="name" id="name"
                        placeholder="Subject Name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 col-xl-4 mb-4">
                    <label for="description" class="form-label">Description</label>
                    <input value="{{ $subject->description }}" required type="text" name="description" id="description"
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
                <div class="col-md-6 col-xl-4 mb-4">
                    <label for="province" class="form-label">Province</label>
                    <select name="province" id="province" class="form-control @error('province') is-invalid @enderror">
                        <option value>Select Province</option>
                        @foreach ($provinces as $province)
                            <option {{ $subject->province_id == $province->id ? 'selected' : '' }}
                                value="{{ encrypt($province->id) }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    @error('province')
                        <span role="alert">
                            <strong class="text-danger">{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 col-xl-4 mb-4">
                    <label for="image" class="form-label">Image</label>
                    <br>
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-new img-thumbnail" style="width: 200px; height: 150px;">
                            <img src="{{ $subject->image_path }}" alt="Image">
                        </div>
                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 200px;  ">
                        </div>
                        <div>
                            <span class="btn btn-outline-secondary btn-file"><span class="fileinput-new">Select
                                    image</span><span class="fileinput-exists">Change</span><input type="file"
                                    name="image"></span>
                            <a href="#" class="btn btn-outline-secondary fileinput-exists"
                                data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
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
                            <input type="number" class="form-control" id="chapter_count">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary" data-count="{{ $subject->chapters->count() }}"
                                id="generate-btn">Generate Fields</button>
                            <button class="btn btn-danger" id="reset-btn">Reset</button>
                        </div>
                    </div>
                    <div id="field_wrapper">
                        @foreach ($subject->chapters as $chapter)
                            <div id="row{{ $loop->index }}">
                                <div class="row bg-white p-3">
                                    <div class="col-12">
                                        <button data-row="row{{ $loop->index }}" class="btn delete-row-btn float-right">
                                            <i class="fa fa-trash text-danger "></i>
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Chapter {{ $loop->index + 1 }} name</label>
                                        <input type="hidden" value="{{ encrypt($chapter->id) }}"
                                            name="chapter[{{ $loop->index }}][chapter_id]">
                                        <input type="text" class="form-control" value="{{ $chapter->name }}"
                                            name="chapter[{{ $loop->index }}][name]">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Description</label>
                                        <input type="text" class="form-control" value="{{ $chapter->description }}"
                                            name="chapter[{{ $loop->index }}][description]">
                                    </div>
                                </div>
                                <hr>
                            </div>
                        @endforeach
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
            let number = $("#chapter_count").val();
            let startingValue = $(this).data('count');
            if (number || number > 0) {
                for (let i = startingValue; i < (number + startingValue); i++) {
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
                $(this).data('count', number + startingValue);
            }
        });
        $("#reset-btn").click(function(e) {
            e.preventDefault();
            $("#field_wrapper").empty();
        });
        $('.delete-row-btn').click(function(e) {
            e.preventDefault();
            let id = $(this).data('row');
            $("#" + id).remove();
        });
    </script>
@endpush
