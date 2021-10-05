@extends('auth.master')

@section('content')
<form action="{{route('register')}}" class="form" method="post">
    @csrf
    <a class="account-logo" href="index.html">
        <img src="img/weblogo.png" alt="">
    </a>
    <div class="form-content form-account">
        <input
            type="text"
            id="name"
            class="txt @error('name') is-invalid @enderror"
            placeholder="نام و نام خانوادگی *"
            name="name"
            value="{{ old('name') }}"
            required
            autocomplete="name"
            autofocus
        >
        @error('name')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <input
            type="email"
            id="email"
            value="{{ old('email') }}"
            name="email"
            class="txt txt-l @error('email') is-invalid @enderror"
            placeholder="ایمیل *"
            required
        >
        @error('email')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <input
            type="text"
            id="mobile"
            name="mobile"
            value="{{ old('mobile') }}"
            class="txt txt-l @error('mobile') is-invalid @enderror"
            placeholder="شماره موبایل"
        >
        @error('mobile')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <input
            type="password"
            id="password"
            name="password"
            autocomplete="new-password"
            class="txt txt-l @error('password') is-invalid @enderror"
            placeholder="رمز عبور *"
        >
        @error('password')
        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
        @enderror

        <input
            id="password-confirm"
            type="password"
            name="password_confirmation"
            required
            autocomplete="new-password"
            class="txt txt-l @error('password_confirmation') is-invalid @enderror"
            placeholder="تایید رمز عبور *"
        >
        <span class="rules">رمز عبور باید حداقل 8 کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>


        <br>
        <button class="btn continue-btn">ثبت نام و ادامه</button>

    </div>
    <div class="form-footer">
        <a href="{{route('login')}}">صفحه ورود</a>
    </div>
</form>
@endsection
