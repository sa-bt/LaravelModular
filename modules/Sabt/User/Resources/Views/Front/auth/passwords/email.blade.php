@extends('User::auth.master')

@section('content')
    <form action="{{route('password.email')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="{{route('home')}}">
            <img src="/img/weblogo.png" alt="">
        </a>
        <div class="form-content form-account">
            @if(session('status'))
                <div class="alert alert-success">
                   {{session('status')}}
                </div>
            @endif
            <input type="text"
                   class="txt-l txt @error('email') is-invalid @enderror"
                   placeholder="ایمیل"
                   value="{{ old('email') }}"
                   name="email"
                   required
                   autocomplete="email"
                   autofocus>

            @error('email')
            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            <br>
            <button class="btn btn-recoverpass" type="submit">بازیابی</button>
        </div>
        <div class="form-footer">
            <a href="login.html">صفحه ورود</a>
        </div>
    </form>
@endsection
