
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" type="text/css" href="{{ asset('admin/dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/dist/css/bootstrap.min.css') }}" />
    <title>Login form</title>
    <style>
        .login-head{
            color: #ffffff;
            font-family: sans-serif;
            font-size: 30px;
            text-align: center;
        }
        .bg-success-100{
            background: #2a9da2;
        }
    </style>
</head>
<body style="background-image: url({{ asset('Template/img/intro-bg.jpg') }}); background-size:100%;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5 shadow">
                <div class="card">
                    <div class="card-header bg-success-100 pt-1 pb-1">
                        <h4 class="login-head">User Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <p class="text-danger">
                                        @if (isset($error))
                                            {{ $error }}
                                        @endif
                                    </p>
                                </div>

                                <div class="col-md-12">
                                    <label for="email" class="col-form-label text-md-right">Enter Email</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong></strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="password" class="col-form-label text-md-right">Password</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong></strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Login
                                    </button>


                                        <a class="btn btn-link" href="">
                                           Forgot Password
                                        </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('admin/dist/js/jquery-3.6.0.min.js') }}" ></script>

    <script src="{{ asset('admin/dist/js/bootstrap.min.js') }}" ></script>
    <script src="{{ asset('admin/dist/js/bootstrap.js') }}"></script>
</body>
</html>

