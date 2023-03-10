@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row top_headings">
                    <div class="col-7 py-3">
                        <h6>{{ $job->title }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 py-3 jobdetail_headings">
                        <h5>Sr No.</h5>
                    </div>
                    <div class="col-4 py-3 jobdetail_headings">
                        <h5>Title</h5>
                    </div>
                    <div class="col-4 py-3 jobdetail_headings">
                        <h5>Details</h5>
                    </div>
                </div>
                <div class="row ">
                    <div class="col-1 py-3 jobdetail_data1">
                        <h6>1</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data1">
                        <h6>Job Location</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data1">
                        <h6>{{ $job->job_location }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 py-3 jobdetail_data2">
                        <h6>2</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data2">
                        <h6>Job Type</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data2">
                        <h6>{{ $job->job_type }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 py-3 jobdetail_data1">
                        <h6>3</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data1">
                        <h6>Published Date</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data1">
                        <h6>{{ \Carbon\Carbon::parse($job->published_date)->format('d-F-Y l') }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 py-3 jobdetail_data2">
                        <h6>4</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data2">
                        <h6>Last Date to Apply</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data2">
                        <h6>{{ \Carbon\Carbon::parse($job->last_apply_date)->format('d-F-Y l') }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 py-3 jobdetail_data1">
                        <h6>5</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data1">
                        <h6>Newspaper Name</h6>
                    </div>
                    <div class="col-4 py-3 jobdetail_data1">
                        <h6>{{ $job->newspaper_name }}</h6>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <strong class="text-danger"> Last Date to Apply:
                            {{ \Carbon\Carbon::parse($job->last_apply_date)->format('d F Y') }}</strong>
                    </div>
                </div>
                <div class="container blog-content ">
                    {!! json_decode($job->description) !!}
                </div>
                <img class="blog-img" src="{{ $job->image_path }}" alt="{{ $job->title }}">
                <hr>
                <div class="row mt-4">
                    <h2>Advertisement Files:</h2>
                    <div class="container ">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <img src="{{ $job->image_path }}" alt="" width="100%"> --}}
                                        <h6 class="mt-3">Advertisement File in English</h6>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ $job->english_pdf }}" target="_blank" class="btn btn-warning">View
                                            Online</a>
                                        <a href="{{ route('job.file.download', [$job->id, 'english']) }}"
                                            class="btn btn-primary ">Download</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <img src="{{ $job->image_path }}" alt="" width="100%"> --}}
                                        <h6 class="mt-3">Advertisement File in Urdu</h6>

                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ $job->urdu_pdf }}" target="_blank" class="btn btn-warning">View
                                            Online</a>
                                        <a href="{{ route('job.file.download', [$job->id, 'urdu']) }}" download=""
                                            class="btn btn-primary ">Download</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!is_null($job->apply_link))
                    <div class="text-center my-4">
                        <a href="{{ $job->apply_link }}" target="_blank" class="btn btn-success">Apply Now</a>
                    </div>
                @endif
            </div>
            @include('frontend.partials.aside')
        </div>
    </div>
@endsection
