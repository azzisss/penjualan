@extends('layout.mainLogin')

@section('mainkonten')

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <?php
                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                header("Refresh: 7199; URL= $actual_link ");
            ?>
                <input type="hidden" value="{{ $actual_link }}">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            @if(isset ($errors) && count($errors) > 0)
                                <div class="alert alert-warning text-center" role="alert">
                                    <ul class="list-unstyled mb-0">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow-lg border-warning rounded-0">
                            <div class="card-body">
                                <img class="img-thumbnail" src="{{ asset('/img/logo.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow-lg border-warning rounded-0 mt-5">
                            <div class="card-header border-danger text-center"><h3>Login</h3></div>
                            <div class="card-body">
                                <form action="/login" method="post">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control  rounded-0 @error ('username') is-invalid @enderror " name="username" id="username" placeholder="name@example.com">
                                        <label for="username">Email address or Username</label>
                                        @error('username')
                                            <div class="invalid-feedback" id="username">
                                                {{ $message }} 
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control  rounded-0 @error ('password')is-invalid @enderror" name="password" id="password" placeholder="Password">
                                        <label for="password">Password</label>
                                        @error('password')
                                            <div class="invalid-feedback" id="password">
                                                {{ $message }}
                                            </div> 
                                        @enderror
                                    </div>
                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <button class="btn btn-warning" type="submit"><i class="bi bi-box-arrow-in-up fs-3"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

@endsection
