@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="مدیریت کاربران">مدیریت کاربران</a></li>
    <li><a href="#" title="ویرایش اطلاعات کاربر">ویرایش اطلاعات کاربر</a></li>
@endsection
@section('content')
    <div class="col-10 bg-white" style="margin: auto ">
        <p class="box__title">ویرایش اطلاعات کاربر </p>
        <form action="{{route('users.update',$user->id)}}" class="padding-30" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('put')
            <x-input
                type="text"
                class=""
                name="name"
                placeholder="نام"
                required
                value="{{$user->name}}"
            />
            <x-input
                type="text"
                class=""
                name="username"
                placeholder="نام کاربری"
                required
                value="{{$user->username}}"
            />

            <x-input
                type="text"
                name="email"
                class="text-left "
                placeholder="ایمیل"
                required
                value="{{$user->email}}"
            />
            <x-input
                type="text"
                name="mobile"
                class="text-left "
                placeholder="موبایل"
                value="{{$user->mobile}}"
            />
            <x-input
                type="text"
                name="headline"
                class="text-left "
                placeholder="عنوان"
                value="{{$user->headline}}"
            />
            <x-input
                type="text"
                name="website"
                class=" "
                placeholder="وب سایت"
                value="{{$user->website}}"
            />
            <x-input
                type="text"
                name="linkedin"
                class=" "
                placeholder="اکانت لینکدین"
                value="{{$user->linkedin}}"
            />
            <x-input
                type="text"
                name="facebook"
                class=" "
                placeholder="اکانت فیس بوک"
                value="{{$user->facebook}}"
            />
            <x-input
                type="text"
                name="twitter"
                class=" "
                placeholder="ااکانت توییتر"
                value="{{$user->twitter}}"
            />
            <x-input
                type="text"
                name="youtube"
                class=" "
                placeholder="اکانت یوتیوب"
                value="{{$user->youtube}}"
            />
            <x-input
                type="text"
                name="instagram"
                class=" "
                placeholder="اکانت اینستاگرام"
                value="{{$user->instagram}}"
            />
            <x-input
                type="text"
                name="password"
                class="text-left "
                placeholder="رمز عبور جدید"
                value=""
            />

            <x-select name="status">
                <option value="">وضعیت کاربر</option>
                @foreach(\Sabt\User\Models\User::$statuses as $status)
                    <option value="{{$status}}" @if($status == $user->status) selected @endif >@lang($status)</option>
                @endforeach
            </x-select>
            <x-file placeholder="آپلود تصویر" name="image" :value="$user->image"/>
            <x-textarea placeholder="توضیحات" name="bio" value="{{$user->bio}}"/>

            <br>
            <button type="submit" class="btn btn-webamooz_net">بروزرسانی کاربر</button>
        </form>
    </div>
    <div class="row no-gutters margin-top-20">
        <div class="col-6 margin-left-10 margin-bottom-20">
            <p class="box__title">درحال یادگیری</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام دوره</th>
                        <th>نام مدرس</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr role="row" class="">
                        <td><a href="">1</a></td>
                        <td><a href="">دوره لاراول</a></td>
                        <td><a href="">صیاد اعظمی</a></td>
                    </tr>
                    <tr role="row" class="">
                        <td><a href="">1</a></td>
                        <td><a href="">دوره لاراول</a></td>
                        <td><a href="">صیاد اعظمی</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        @if($user->teaches->count())
            <div class="col-6 margin-bottom-20">
                <p class="box__title">دوره های مدرس</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>شناسه</th>
                            <th>نام دوره</th>
                            <th>تعداد دانشجو</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($user->teaches as $course)
                            <tr role="row" class="">
                                <td><a href="{{route('courses.edit',$course->id)}}">{{$course->id}}</a></td>
                                <td><a href="{{route('courses.edit',$course->id)}}">{{$course->title}}</a></td>
                                <td><a href="">150</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('js')
    <script src="/panel/js/tagsInput.js"></script>
    <script>
        @include('Common::layouts.feedback')
    </script>
@endsection
