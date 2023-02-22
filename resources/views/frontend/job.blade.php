@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow">

                    <div class="card-header">
                        <h1>{{ $job->title }}</h1>
                    </div>

                    <div class="card-body">
                        <img class="blog-img" src="{{ $job->image_path }}" alt="{{ $job->title }}">
                        <div class="blog-content mx-5">
                            {!! json_decode($job->description) !!}
                        </div>
                        @if (!is_null($job->apply_link))
                            <div class="text-center my-4">
                                <a href="{{ $job->apply_link }}" target="_blank" class="btn btn-success">Apply Now</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @include('frontend.partials.aside')
        </div>
    </div>
@endsection
