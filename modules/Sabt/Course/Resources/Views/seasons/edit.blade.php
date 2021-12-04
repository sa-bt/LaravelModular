@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="{{route('courses.show',$season->course->id)}}" title="{{$season->course->title}}">{{$season->course->title}}</a></li>
    <li><a href="#" title="ویرایش سرفصل ">ویرایش سرفصل</a></li>
@endsection
@section('content')
    <div class="col-10 bg-white" style="margin: auto">
        <p class="box__title">ویرایش سرفصل </p>
        <form action="{{route('seasons.update',$season->id)}}" class="padding-30" method="post">
            @csrf
            @method('put')
            <x-input
                type="text"
                class=""
                name="title"
                placeholder="عنوان سرفصل"
                required
                value="{{$season->title}}"
            />

            <x-input
                type="text"
                name="number"
                class="text-left "
                placeholder="شماره سرفصل"
                value="{{$season->number}}"
            />

            <br>
            <button type="submit" class="btn btn-webamooz_net">بروزرسانی سرفصل</button>
        </form>
    </div>

@endsection
