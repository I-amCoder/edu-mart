@extends('layouts.app')
@section('content')
    <!-- ====================Breadcrumb =========================-->
    <div class="container breadcrumb1">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mt-2"><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="breadcrumb-item mt-2"><a href="#">{{ $class->name }}
                                {{ $province ? $province->name : '' }} Board</a>
                        </li>
                        <li class="breadcrumb-item active mt-2" aria-current="page">Chapter
                            {{ $class->name }}:{{ $chapter->name }}
                            Board</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ====================Breadcrumb end =========================-->


    <div class="container my-5">
        @forelse ($chapter->topics as $topic)
            <div class="list-group mb-4 ">
                <div class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $topic->name }}</h5>
                        @if (now()->diffInDays($topic->created_at) <= 0)
                            @if (now()->diffInHours($topic->created_at) <= 0)
                                <span>
                                    <i class="fa fa-clock"></i>
                                    Just a moment ago</span>
                            @else
                                <span><i class="fa fa-clock"></i> {{ now()->diffInHours($topic->created_at) }}Hours
                                    ago</span>
                            @endif
                        @else
                            <span><i class="fa fa-clock"></i> {{ now()->diffInDays($topic->created_at) }} Days ago</span>
                        @endif
                    </div>
                    <p class="mb-1">{{ $topic->description }}</p>
                    <hr>
                    <a href="{{ $topic->show_pdf }}" target="_blank" class="btn btn-outline-primary ">View Online</a>
                    <a href="{{ route('topic.download', $topic->slug) }}" download=""
                        class="btn btn-outline-info ">Download
                        PDF</a>
                </div>
            </div>
        @empty
            <div class="row my-4">
                <h4>No Topics Have Been Uploaded In This Chapter</h4>
            </div>
        @endforelse

    </div>


    <!-- ================= Punjab 6th Class Notes end=========== -->
@endsection
