@extends('layouts.guest')

@section('content')
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0  shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row " style="height: 80vh">
                            <div class="col-lg-6 d-none d-lg-block ">
                                <img src="{{ config('settings.logo_path') }}" alt="Logo Image"
                                    style="width: 100%; height: 100%; object-fit: cover">
                            </div>
                            <div class="col-lg-6 align-self-center">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form class="user" action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." value="{{ old('email') }}" required
                                                autocomplete="email" autofocus name="email">
                                        </div>
                                        @error('email')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-group">
                                            <input type="password" required name="password"
                                                class="form-control @error('password')
                                                is-invalid
                                            @enderror form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        @error('password')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input name="remember" type="checkbox" class="custom-control-input"
                                                    id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
