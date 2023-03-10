@extends('layouts.app')
@section('content')
    <!-- ======================== Logo section start ===============-->
    <section>
        <div class="container logo">
            <div class="row g-0 bg-light position-relative">
                <div class="col-md-6 mb-md-0 p-md-4">
                    <img src="{{ asset('frontend') }}/img/project5.jpg" class="w-100">
                    <!-- is image ma website logo aya ga -->
                </div>
                <div class="col-md-6 p-4 ps-md-0">
                    <h2 class="mt-0">Welcome to EduMart</h2>
                    <p><b>Edumart</b> is a widely platform for students which provides Notes of all classes (6th, 7th, 8th,
                        9th, 10th, Intermediate, Bachelors (BS,ADs/BSc), Masters (MSc Physics, MSc Chemistry, MSc
                        Mathematics, MSc Computer Science , etc..), Mphil/PhD ) and the jobs materials in the pakistan. </p>
                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- ========================= Logo section end  =============-->

    <!-- ===================== for Mobile ancher start here ======================-->
    <div class="container eduancher">
        <h3 class="heading_of_edu pt-5">NOTES of</h3>
        <div class="mobileheadings px-4">
            <h5>Middle Classes:</h5>
        </div>
        <div class="row mobile_ancher_text_settings px-4">
            @foreach ($primary as $class)
                <div class="col-4 "><a href="">{{ $class->name }} Class</a></div>
            @endforeach

        </div>
        @foreach ($secondary as $class)
            <div class="mobileheadings px-4">
                <h5>{{ $class->name }} Classes:</h5>
            </div>
            <div class="row mobile_ancher_text_settings px-4">
                @foreach ($class->subClasses as $subClass)
                    <div class="col-4"><a href="">{{ $subClass->name }} Class</a></div>
                @endforeach
            </div>
        @endforeach

        <div class="mobileheadings px-4">
            <h5>Bachelors Programs:</h5>
        </div>
        <div class="row mobile_ancher_text_settings px-4">
            <div class="col-sm-2"><a href="">BS Chemistry</a></div>
            <div class="col-sm-2"><a href="">BS Physics</a></div>
            <div class="col-sm-2"><a href="">BS Mathematics</a></div>
            <div class="col-sm-2"><a href="">BS CS</a></div>
            <div class="col-sm-2"><a href="">BS islamiat</a></div>
            <div class="col-sm-2"><a href="">BS English</a></div>
            <div class="col-sm-2"><a href="">BS Urdu</a></div>
            <div class="col-sm-2"><a href="">BS Physology</a></div>
            <div class="col-sm-2"><a href="">BS History</a></div>
            <div class="col-sm-2"><a href="">BS Civil Engineering</a></div>
            <div class="col-sm-2"><a href="">BS Software Engineering</a></div>
            <div class="col-sm-2"><a href="">BS Chemical Engineering</a></div>
        </div>
        <div class="mobileheadings px-4">
            <h5>Masters Programs:</h5>
        </div>
        <div class="row mobile_ancher_text_settings px-4">
            <div class="col-sm-2"><a href="">MSc Chemistry</a></div>
            <div class="col-sm-2"><a href="">MSc Physics</a></div>
            <div class="col-sm-2"><a href="">MSc Mathematics</a></div>
            <div class="col-sm-2"><a href="">MSc Physics</a></div>
            <div class="col-sm-2"><a href="">MSc Botony</a></div>
            <div class="col-sm-2"><a href="">MSc Zology</a></div>
            <div class="col-sm-2"><a href="">MSc Sociology</a></div>
            <div class="col-sm-2"><a href="">MSc Physics</a></div>
            <div class="col-sm-2"><a href="">MA English</a></div>
            <div class="col-sm-2"><a href="">MA Urdu</a></div>
            <div class="col-sm-2"><a href="">MA Physology</a></div>
            <div class="col-sm-2"><a href="">MA History</a></div>
            <div class="col-sm-2"><a href="">MA Islamiat</a></div>
            <div class="col-sm-2"><a href="">Master of Computer Science</a></div>
            <div class="col-sm-2"><a href="">Msc Software Engineering</a></div>
            <div class="col-sm-2"><a href="">MSc Civil Engineering</a></div>
            <div class="col-sm-2"><a href="">MSc Chemical Engineering</a></div>
        </div>
        <div class="mobileheadings px-4">
            <h5>M Phil/ PhD:</h5>
        </div>
        <div class="row mobile_ancher_text_settings px-4">
            <div class="col-sm-2"><a href="">Physics</a></div>
            <div class="col-sm-2"><a href="">English</a></div>
            <div class="col-sm-2"><a href="">Chemistry</a></div>
            <div class="col-sm-2"><a href="">Mathematics</a></div>
            <div class="col-sm-2"><a href="">Computer Science</a></div>
        </div>
    </div>


    <div class="container eduancher">
        <h3 class="heading_of_edu pt-5">JOB ADVERTISEMENTS</h3>

        @foreach ($jobCategories as $category)
            <div class="mobileheadings px-4">
                <h5>{{ $category->name }}:</h5>
                <div class="row mobile_ancher_text_settings px-4">
                    <div class="col-sm-2">
                        <a href="{{ route('jobs.all.show', ['category' => $category->name]) }}">Show All</a>
                    </div>
                    @foreach ($category->subCategories as $sub)
                        <div class="col-sm-2">
                            <a href="{{ route('jobs.all.show', ['category' => $sub->name]) }}">{{ $sub->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach


    </div>

    <div class="container eduancher">
        <h3 class="heading_of_edu pt-5">Preparation materials and Past Papers of</h3>
        <div class="row mobile_ancher_text_settings px-4">
            <div class="col-sm-2"><a href="">Army</a></div>
            <div class="col-sm-2"><a href="">Navy</a></div>
            <div class="col-sm-2"><a href="">PAF</a></div>
            <div class="col-sm-2"><a href="">Rangers</a></div>
            <div class="col-sm-2"><a href="">FIA</a></div>
            <div class="col-sm-2"><a href="">IB</a></div>
            <div class="col-sm-2"><a href="">ASF</a></div>
            <div class="col-sm-2"><a href="">NAB</a></div>
            <div class="col-sm-2"><a href="">Punjab Police</a></div>
            <div class="col-sm-2"><a href="">Sindh Police</a></div>
            <div class="col-sm-2"><a href="">ICT Police</a></div>
            <div class="col-sm-2"><a href="">Moterway Police</a></div>
            <div class="col-sm-2"><a href="">CSS</a></div>
            <div class="col-sm-2"><a href="">PMS</a></div>
            <div class="col-sm-2"><a href="">WAPDA</a></div>
            <div class="col-sm-2"><a href="">FPSC</a></div>
            <div class="col-sm-2"><a href="">PPSC</a></div>
            <div class="col-sm-2"><a href="">KPSC</a></div>
            <div class="col-sm-2"><a href="">BPSC</a></div>
            <div class="col-sm-2"><a href="">SPSC</a></div>
            <div class="col-sm-2"><a href="">AJKPSC</a></div>
            <div class="col-sm-2"><a href="">Lecturers Physics</a></div>
            <div class="col-sm-2"><a href="">Lecturers Chemistry</a></div>
            <div class="col-sm-2"><a href="">Lecturers Biology</a></div>
            <div class="col-sm-2"><a href="">Lecturers CS</a></div>
            <div class="col-sm-2"><a href="">Lecturers Maths</a></div>
            <div class="col-sm-2"><a href="">Lecturers urdu</a></div>
            <div class="col-sm-2"><a href="">Lecturers English</a></div>
            <div class="col-sm-2"><a href="">Lecturers Pak Studies</a></div>
        </div>
    </div>

    <div class="container eduancher">
        <h3 class="heading_of_edu pt-5">Notes of Programing Languages of</h3>
        <div class="row mobile_ancher_text_settings px-4">
            <div class="col-sm-2"><a href="">HTML</a></div>
            <div class="col-sm-2"><a href="">CSS</a></div>
            <div class="col-sm-2"><a href="">Bootstrap5</a></div>
            <div class="col-sm-2"><a href="">C++</a></div>
            <div class="col-sm-2"><a href="">C#</a></div>
            <div class="col-sm-2"><a href="">Javascripts</a></div>
            <div class="col-sm-2"><a href="">PHP</a></div>
            <div class="col-sm-2"><a href="">MySQL</a></div>
            <div class="col-sm-2"><a href="">Jquery</a></div>
            <div class="col-sm-2"><a href="">Laravel</a></div>
            <div class="col-sm-2"><a href="">Python</a></div>
            <div class="col-sm-2"><a href="">Dart</a></div>
        </div>
    </div>

    <!-- ========================= for Mobile ancher End here ===============-->
@endsection
