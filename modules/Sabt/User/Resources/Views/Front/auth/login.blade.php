@extends('User::auth.master')

@section('content')
    <form action="{{route('login')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="index.html">
            <img src="img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            <input
                type="text"
                id="email"
                value="{{ old('email') }}"
                name="email"
                class="txt txt-l @error('email') is-invalid @enderror"
                placeholder="ایمیل یا شماره موبایل"
                required
            >
            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <input
                type="password"
                id="password"
                name="password"
                autocomplete="new-password"
                class="txt txt-l"
                placeholder="رمز عبور *"
            >
            @error('password')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <br>
            <button class="btn btn--login">ورود</button>
            <label class="ui-checkbox">
                مرا بخاطر داشته باش
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
            <div class="recover-password">
                <a href="{{route('password.request')}}">بازیابی رمز عبور</a>
            </div>
        </div>
        <div class="form-footer">
            <a href="{{route('register')}}">صفحه ثبت نام</a>
        </div>
    </form>
@endsection
