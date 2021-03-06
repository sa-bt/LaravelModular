@extends('User::auth.master')

@section('content')
    <form  class="form" method="post" action="{{ route('password.update') }}">
        @csrf


        <a class="account-logo" href="{{route('home')}}">
            <img src="/img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            @error('password')
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
                required
            >


            <input
                id="password-confirm"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                class="txt txt-l"
                placeholder="تایید رمز عبور *"
            >
            <span class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای غیر الفبا مانند !@#$%^&*() باشد.</span>
            <br>
            <button class="btn btn-recoverpass" type="submit">تغییر رمز عبور</button>
        </div>
        <div class="form-footer">
            <a href="{{route('login')}}">صفحه ورود</a>
        </div>
    </form>



@endsection
