@extends('layouts.app')
@section('content')
    <div class="container breadcrumb1">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item mt-2"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active mt-2" aria-current="page">6th class Boards</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- ====================Breadcrumb end =========================-->
    <!-- ================= Punjab 6th Class Notes start=========== -->
    <br><br>

    <div class="container">
        <div class="row">
            <div>
                <div class="accordion" id="accordionExample">

                    @if ($class->parent && $class->parent->type == 'tertiary')
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="pujabboard">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsepunjab" aria-expanded="true" aria-controls="collapsepunjab">
                                    <h5>{{ $class->parent->name }}</h5>
                                </button>
                            </h2>
                            <div id="collapsepunjab" class="accordion-collapse collapse show" aria-labelledby="pujabboard"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @foreach ($class->subjects as $subject)
                                        <a
                                            href="{{ route('front.subject', ['class' => $class->name, 'subject' => $subject->name]) }}"><strong>
                                                <div class="oddeven1 px-5">{{ $class->name }}
                                                    class:{{ $subject->name }} </div>
                                            </strong><br></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($provinces as $province)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="pujabboard">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsepunjab" aria-expanded="true"
                                        aria-controls="collapsepunjab">
                                        <h5>{{ $province->name }} Boards</h5>
                                    </button>
                                </h2>
                                <div id="collapsepunjab" class="accordion-collapse collapse show"
                                    aria-labelledby="pujabboard" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        @foreach ($class->subjects as $subject)
                                            @if ($subject->province_id == $province->id)
                                                <a
                                                    href="{{ route('front.subject', ['class' => $class->name, 'board' => $province->name, 'subject' => $subject->name]) }}"><strong>
                                                        <div class="oddeven1 px-5">{{ $class->name }}
                                                            class:{{ $subject->name }} </div>
                                                    </strong><br></a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
