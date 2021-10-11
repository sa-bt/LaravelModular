@extends('User::auth.master')

@section('content')

    <div class="account act">
        <form action="{{route('verification.verify')}}" class="form" method="post">
            @csrf
            <a class="account-logo" href="index.html">
                <img src="/img/weblogo.png" alt="">
            </a>
            <div class="card-header">
                <p class="activation-code-title">کد فرستاده شده به ایمیل <span>{{auth()->user()->email}}</span>
                    را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
                </p>
            </div>
            <div class="form-content form-content1">
                <input name="verify_code" class="activation-code-input" placeholder="فعال سازی" required>
                @error('verify_code')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

                <br>
                <button class="btn i-t">تایید</button>
                <a href="#"
                   onclick="event.preventDefault();
                    document.getElementById('resendVerification').submit()">ارسال مجدد کد فعال سازی</a>

            </div>
            <div class="form-footer">
                <a href="{{route('login')}}">صفحه ثبت نام</a>
            </div>
        </form>

        <form id="resendVerification" action="{{route('verification.resend')}}" method="post">
            @csrf
        </form>
    </div>

@endsection

@section('js')
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/activation-code.js"></script>
@endsection


