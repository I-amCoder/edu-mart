@extends('layouts.app')
@section('title', 'Jobs')
@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    @forelse ($papers as $paper)
                        <div class="list-group mb-4 ">
                            <div class="list-group-item list-group-item-action flex-column align-items-start ">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $paper->name }}</h5>
                                </div>
                                <p class="mb-1">{{ $paper->description }}</p>
                                <hr>
                                <a href="{{ $paper->show_pdf }}" target="_blank" class="btn btn-outline-primary ">View
                                    Online</a>
                                <a href="{{ route('paper.download', $paper->id) }}" class="btn btn-outline-info ">Download
                                    PDF</a>
                            </div>
                        </div>

                    @empty
                        @if ($currentCategory)
                            <div class="h3">No Jobs Fount In this sector yet</div>
                            <a href="{{ route('jobs.all.show') }}" class="btn btn-success">Show All Jobs</a>
                        @endif
                    @endforelse
                </div>
                {{ $papers->links() }}
            </div>
            @include('frontend.partials.aside1')
        </div>
    </div>
@endsection
