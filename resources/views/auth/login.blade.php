<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

</head>

<body>
    <div class="container" style="margin-top:5cm">
        <div class="row">
            <div class="card border border-3 shadow" style="height:700px">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-7">
                            <p style="text-align:center;font-size:35px;font-weight:700;margin-top:15px;color:rgb(0, 157, 255)">SARAL BILLING
                            </p>
                            <img src="{{ asset('assets/img/login.png') }}" width="750" style="margin-top:25px">
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div style="margin-top:100px">
                                        <p style="font-size:27px;font-weight:700">USERNAME</p>
                                        <div class="form-group row">

                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email"
                                                style="height:50px;font-size:25px;font-weight-bold" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="">
                                        <p style="font-size:27px;font-weight:700;margin-top:30px">PASSWORD</p>
                                        <div class="form-group row mt-3">


                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password"
                                                style="height:50px;font-size:25px;font-weight-bold">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-group row mt-4">
                                        <div class="col-md-6 "> {{-- offset-md-4 --}}
                                            <div class="form-check"
                                                style="font-size:20px;font-weight:700;margin-top:15px">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg btn-block"
                                        style="margin-top:30px;height:50px;width:380px">LOG IN</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>