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
            <div class="col-md-4">
                <h3>Check More Jobs</h3>
                <div class="list-group">
                    @foreach ($jobCategories as $category)
                        <a href="#"
                            class="list-group-item list-group-item-action flex-column align-items-start  @if ($category->jobs->count() < 1) disabled @endif">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $category->name }}</h5>
                                <small>{{ $category->jobs->count() }} jobs</small>
                            </div>
                            <p class="mb-1">{{ $category->description }}</p>
                        </a>
                    @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endsection
