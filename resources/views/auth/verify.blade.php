@extends('auth.master')

@section('content')
    <form action="{{route('verification.resend')}}" class="form" method="post">
        @csrf
        <a class="account-logo" href="/">
            <img src="img/weblogo.png" alt="">
        </a>


        <div class="form-content form-content1">
            {{--            <input class="activation-code-input" placeholder="فعال سازی">--}}

            <p class="activation-code-title">کد فرستاده شده به ایمیل <span>{{auth()->user()->email}}</span>
                را وارد کنید . ممکن است ایمیل به پوشه spam فرستاده شده باشد
            </p>
            @if(session('resent'))
                <div class="alert alert-success">
                    لینک تایید ایمیل جدید به ایمیلتان ارسال شد.
                </div>
            @endif
            <br>
            <button class="btn i-t" type="submit">ارسال مجدد لینک فعال سازی</button>

        </div>
        <div class="form-footer">
            <a href="/">بازگشت به صفحه اصلی</a>
        </div>
    </form>
@endsection
