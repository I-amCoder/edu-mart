@extends('layouts.app')
@section('title', 'Jobs')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                @forelse ($jobs as $job)
                    <div class="row">
                        <div class="col-lg-10 col-sm-12 joblinksall">
                            <h6><a href="{{ route('job.show', $job->slug) }}">{{ $job->title }}</a></h6>
                            <small><i class=" mr-2">Newspaper:</i><i
                                    class="ms-1 text-success">{{ $job->newspaper_name }}</i></small>
                            <small><i class="  ms-5">Publish Date:</i><i
                                    class="ms-1 text-success">{{ \Carbon\Carbon::parse($job->published_date)->format('d-F-Y l') }}</i></small>
                        </div>
                    </div>
                @empty
                    @if ($currentCategory)
                        <div class="h3">No Jobs Fount In this sector yet</div>
                        <a href="{{ route('jobs.all.show') }}" class="btn btn-success">Show All Jobs</a>
                    @endif
                @endforelse
                {{ $jobs->links() }}
            </div>
            @include('frontend.partials.aside')
        </div>
    </div>
@endsection
