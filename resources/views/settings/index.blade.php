@extends('layouts.admin')
@section('title', 'Settings')
@section('settings', 'active')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h3>Site Settings</h3>
        </div>
        <hr>
        @if ($settings)
            @include('settings.partials.edit')
        @else
            @include('settings.partials.create')
        @endif
    </div>
@endsection
