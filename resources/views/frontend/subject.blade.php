@extends('layouts.app')
@section('content')
    <!-- ====================Breadcrumb =========================-->
    <div class="container breadcrumb1">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mt-2"><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="breadcrumb-item mt-2" aria-label="current">
                            <a href="#">{{ $class->name }}
                                @if ($class->parent && $class->parent->type != 'tertiary')
                                    {{ $province->name }} Board
                                @endif
                            </a>
                        </li>

                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row justify-content-center ">
            <div class="col-md-12">
                <div class="card">
                    <img class="subject-img-front" src="{{ $subject->image_path }}" alt="{{ $subject->name }}">
                    <div class="card-body">
                        <h1>{{ $subject->name }}</h1>
                        <p>{{ $subject->description }}</p>
                        <hr>
                        <h4>Chapters:</h4>
                        @if ($class->parent && $class->parent->type != 'tertiary')
                            @foreach ($subject->chapters as $chapter)
                                <div class="list-group mb-4 ">
                                    <a href="{{ route('front.chapter', ['class' => $class->name, 'board' => $province, 'subject' => $subject->name, 'chapter' => $chapter->slug]) }}"
                                        class="list-group-item list-group-item-action flex-column align-items-start ">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Chapter:{{ $loop->index + 1 }} {{ $chapter->name }}</h5>
                                        </div>
                                        <p class="mb-1">{{ $chapter->description }}</p>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            @foreach ($subject->chapters as $chapter)
                                <div class="list-group mb-4 ">
                                    <a href="{{ route('front.chapter', ['class' => $class->name, 'subject' => $subject->name, 'chapter' => $chapter->slug]) }}"
                                        class="list-group-item list-group-item-action flex-column align-items-start ">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Chapter:{{ $loop->index + 1 }} {{ $chapter->name }}</h5>
                                        </div>
                                        <p class="mb-1">{{ $chapter->description }}</p>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
