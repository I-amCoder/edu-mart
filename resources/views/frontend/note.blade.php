@extends('layouts.app')
@section('title', 'Notes')
@section('content')
    <!-- ====================Breadcrumb =========================-->
    <div class="container breadcrumb1">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mt-2"><a href="#">Home</a></li>
                        <li class="breadcrumb-item mt-2"><a href="#">{{ $topic->class->name }}
                                {{ $topic->subject->board->name }}</a></li>
                        <li class="breadcrumb-item active mt-2" aria-current="page">Chapter {{ $topic->chapter }}:
                            {{ $topic->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ====================Breadcrumb end =========================-->

    <!-- ================= Punjab 6th Class Notes start=========== -->


    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-body">
                        <img src="{{ $topic->image_path }}" alt="" width="100%">
                        <h6 class="mt-3">Chapter {{ $topic->chapter }}: {{ $topic->name }}</h6>
                        <p>{{ $topic->subject->description }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ $topic->show_pdf }}" target="_blank" class="btn btn-warning">View</a>
                        <a href="{{ route('topic.download', $topic->slug) }}" class="btn btn-primary ">Download</a>
                    </div>
                </div>

            </div>


        </div>
    </div>
@endsection
