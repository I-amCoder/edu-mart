<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ config('settings.favicon_path') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/css/style.css">
</head>

<body>

    <!-- ======================  Top Navbar Start ===========================-->
    <nav class="top-nav py-1" id="home">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <p>
                        <span class="fs-1">{{ config('app.name') }}</span>
                    </p>
                </div>
                <div class="col-auto py-2">
                    <a class="fs-3 " style="color: white;" href="{{ route('login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- ======================== Top Navbar End =============================-->
    <!-- =====================  Main NavBar Start =====================-->

    <nav class="navbar navbar-expand-xl navbar-light  py-4">
        <div class="container">
            <!-- <a class="navbar-brand" href="#">EduMart<span>.</span></a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon white"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item ">
                        <a class="nav-link  active" href="{{ route('welcome') }}">HOME</a>
                    </li>
                    @foreach ($classes as $class)
                        @if ($class->type == 'primary')
                            <li class="nav-item ">
                                <a href="{{ route('front.class', $class->name) }}"
                                    class="nav-link">{{ $class->name }}</a>
                            </li>
                        @elseif($class->type == ('secondary' || 'tertiary'))
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown">{{ $class->name }}</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    @foreach ($class->subClasses as $sub)
                                        <a href="{{ route('front.class', $sub->name) }}"
                                            class="dropdown-item">{{ $sub->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach

                </ul>
                <!-- <a href="#" class="btn btn-brand ms-lg-3 fs-6">Contect Us</a>
      </div> -->
            </div>
    </nav>
    <!-- =====================  Main NavBar End ========================-->





    @yield('content')



    <!-- ========================= Start Fotter here  ===================-->

    <footer class="footer">
        <div class="container">
            <div class="row justify-content-between">
                <div class="footer-col">
                    <h4>Notes of</h4>
                    <ul>
                        @foreach ($classes as $class)
                            @if ($class->type == 'primary')
                                <li class="nav-item ">
                                    <a href="{{ route('front.class', $class->name) }}"
                                        class="nav-link">{{ $class->name }}</a>
                                </li>
                            @elseif($class->type == ('secondary' || 'tertiary'))
                                @foreach ($class->subClasses as $sub)
                                    <li>

                                        <a href="{{ route('front.class', $sub->name) }}">{{ $sub->name }}</a>
                                    </li>
                                @endforeach
                            @endif
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="footer-col">
                    <h4>Miscellaneous</h4>
                    <ul>
                        <li><a href="#">Past Papers of All Universities</a></li>
                        <li><a href="#">All Jobs Past Papers</a></li>
                        <li><a href="#">CSS</a></li>
                        <li><a href="#">PMS</a></li>
                        <li><a href="#">FPSC</a></li>
                        <li><a href="#">PPSC</a></li>
                        <li><a href="#">KPPSC</a></li>
                        <li><a href="#">SPSC</a></li>
                        <li><a href="#">BPSC</a></li>
                        <li><a href="#">Army</a></li>
                        <li><a href="#">PAF</a></li>
                        <li><a href="#">PAEC</a></li>
                        <li><a href="#">WAPDA</a></li>
                        <li><a href="#">BANKS</a></li>
                    </ul>
                </div> --}}
                <div class="footer-col">
                    <h4>Information</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Report Abuse</a></li>
                        <li><a href="#">Cookies Policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        @if (config('settings.facebook_link'))
                            <a target="_blank" href="{{ config('settings.facebook_link') }}"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endif
                        @if (config('settings.twitter_link'))
                            <a target="_blank" href="{{ config('settings.twitter_link') }}"><i
                                    class="fab fa-twitter"></i></a>
                        @endif
                        @if (config('settings.instagram_link'))
                            <a target="_blank" href="{{ config('settings.instagram_link') }}"><i
                                    class="fab fa-instagram"></i></a>
                        @endif
                        @if (config('settings.linkedin_link'))
                            <a target="_blank" href="{{ config('settings.linkedin_link') }}"><i
                                    class="fab fa-linkedin-in"></i></a>
                        @endif

                        @if (config('settings.youtube_link'))
                            <a target="_blank" href="{{ config('settings.youtube_link') }}"><i
                                    class="fab fa-youtube"></i></a>
                        @endif
                        @if (config('settings.pinterest_link'))
                            <a target="_blank" href="{{ config('settings.pinterest_link') }}"><i
                                    class="fab fa-pinterest"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <p>{{ config('settings.copyright_text') }}</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- ============================== END Fotter here ========================-->
















    <script src="{{ asset('frontend') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend') }}/js/jquery.min.js"></script>
    <script src="{{ asset('frontend') }}/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend') }}/js/app.js"></script>
</body>

</html>
