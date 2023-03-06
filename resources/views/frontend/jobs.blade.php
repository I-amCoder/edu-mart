@extends('layouts.app')
@section('title', 'Jobs')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @forelse ($jobs as $job)
                        <div class="col-md-6 col-lg-4 mb-2">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('frontend/img/10th bio.jpg') }}"
                                    style="max-height: 200px" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">Some quick example text to build on the card title and make up the
                                        bulk
                                        of
                                        the card's content.</p>
                                    <a href="{{ route('job.show', $job->slug) }}" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        @if ($currentCategory)
                            <div class="h3">No Jobs Fount In this sector yet</div>
                            <a href="{{ route('jobs.all.show') }}" class="btn btn-success">Show All Jobs</a>
                        @endif
                    @endforelse
                </div>
                {{ $jobs->links() }}
            </div>
            @include('frontend.partials.aside')
        </div>
    </div>
@endsection
