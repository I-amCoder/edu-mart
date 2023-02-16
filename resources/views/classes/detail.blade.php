@extends('layouts.admin')
@section('title', $class->name . ' Class Managment')
@section('content')
    <div class="container-fluid">
        <h1>Class: {{ $class->name }}</h1>
        <h5 class="text-uppercase text-danger">Type: {{ $class->type }}</h5>


        @include('classes.partials.classSubject')
        <hr>


    </div>
    @if ($class->type == 'secondary' || $class->type == 'tertiary')
        @include('classes.partials.addClassModal')
    @endif

    </div>
    </div>
@endsection
@push('js')
    <script>
        $(".addSubClass").click(function(e) {
            e.preventDefault();
            $("#addSubClassModal").modal('show');
        });

        @if (Session::has('errors'))
            $("#addSubClassModal").modal('show');
        @endif
    </script>
@endpush
