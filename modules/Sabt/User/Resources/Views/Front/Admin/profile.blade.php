@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="مدیریت کاربران">مدیریت کاربران</a></li>
    <li><a href="#" title="ویرایش اطلاعات کاربر">ویرایش پروفایل</a></li>
@endsection
@section('content')
    <div class="col-10 bg-white" style="margin: auto ">
        <p class="box__title">ویرایش پروفایل </p>
        <x-user-photo/>
        <form action="{{route('users.profile')}}" class="padding-30" method="post"
              enctype="multipart/form-data">
            @csrf
            <x-input
                type="text"
                class=""
                name="name"
                placeholder="نام"
                required
                value="{{auth()->user()->name}}"
           />

{{--TODO create link for per user--}}
{{--            <p class="input-help margin-bottom-12 text-left">--}}

{{--                <a href="{{route(auth()->user()->profilePath())}}">{{auth()->user()->profilePath()}}</a>--}}
{{--            </p>--}}
            <x-input
                type="text"
                class=""
                name="username"
                placeholder="نام کاربری"
                required
                value="{{auth()->user()->username}}"
            />

            <x-input
                type="text"
                name="email"
                class="text-left "
                placeholder="ایمیل"
                required
                value="{{auth()->user()->email}}"
            />
            <x-input
                type="text"
                name="mobile"
                class="text-left "
                placeholder="موبایل"
                value="{{auth()->user()->mobile}}"
            />
            <x-input
                type="text"
                name="headline"
                class="text-left "
                placeholder="عنوان"
                value="{{auth()->user()->headline}}"
            />
            <x-input
                type="text"
                name="shaba"
                class="text-left "
                placeholder="شماره شبا"
                value="{{auth()->user()->shaba}}"
            />
            <x-input
                type="text"
                name="cart_number"
                class="text-left "
                placeholder="شماره کارت"
                value="{{auth()->user()->cart_number}}"
            />
            <x-input
                type="text"
                name="website"
                class=" "
                placeholder="وب سایت"
                value="{{auth()->user()->website}}"
            />
            <x-input
                type="text"
                name="linkedin"
                class=" "
                placeholder="اکانت لینکدین"
                value="{{auth()->user()->linkedin}}"
            />
            <x-input
                type="text"
                name="facebook"
                class=" "
                placeholder="اکانت فیس بوک"
                value="{{auth()->user()->facebook}}"
            />
            <x-input
                type="text"
                name="twitter"
                class=" "
                placeholder="اکانت توییتر"
                value="{{auth()->user()->twitter}}"
            />
            <x-input
                type="text"
                name="youtube"
                class=" "
                placeholder="اکانت یوتیوب"
                value="{{auth()->user()->youtube}}"
            />
            <x-input
                type="text"
                name="instagram"
                class=" "
                placeholder="اکانت اینستاگرام"
                value="{{auth()->user()->instagram}}"
            />
            <x-input
                type="text"
                name="password"
                class="text-left "
                placeholder="رمز عبور جدید"
                value=""
            />
            <x-textarea placeholder="توضیحات" name="bio" value="{{auth()->user()->bio}}"/>

            <br>
            <button type="submit" class="btn btn-webamooz_net">بروزرسانی کاربر</button>
        </form>
    </div>
@endsection
@section('js')
    <script src="/panel/js/tagsInput.js"></script>
    <script>
        @include('Common::layouts.feedback')
    </script>
@endsection
