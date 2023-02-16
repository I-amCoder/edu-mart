@extends('layouts.admin')
@section('title', 'Manage Topics')
@section('content')
    <div class="container-fluid">
        <h3 class="text-danger">{{ $class->name }} Class: {{ $subject->name }}
        </h3>
        <h2>Manage {{ $chapter->name }} Articls</h2>
        <a href="{{ route('admin.topic.create', $chapter->id) }}" class="btn btn-primary mb-4">Add
            New Article</a>
        <div class="row">
            @forelse ($chapter->topics as $topic)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card">
                        <img class="card-img-top" src="{{ $topic->image_path }}" alt="Card image" style="width:100%">
                        <div class="card-body">
                            <h4 class="card-title">{{ $topic->name }}</h4>
                            <p class="card-text">{{ $topic->description }}</p>
                            <form method="POST" action="{{ route('admin.topic.destroy', [$chapter->id, $topic->id]) }}">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <a href="{{ route('admin.topic.edit', [$chapter->id, $topic->id]) }}"
                                    class="btn btn-primary">Edit</a>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p>You don't have added any topic yet</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
