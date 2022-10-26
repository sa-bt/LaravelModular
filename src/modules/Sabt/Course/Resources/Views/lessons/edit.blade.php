@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="{{route('courses.show',$course->id)}}" title="{{$course->title}}">{{$course->title}}</a></li>
    <li><a href="#" title="ایجاد جلسه">بروزرسانی جلسه</a></li>
@endsection
@section('content')
    <div class="col-10 bg-white" style="margin: auto">
        <p class="box__title">بروزرسانی جلسه</p>
        <form action="{{route('lessons.update',[$course->id,$lesson->id])}}" class="padding-30" method="post"
              enctype="multipart/form-data">
            @method('put')
            @csrf
            <x-input
                type="text"
                class=""
                name="title"
                placeholder="عنوان جلسه*"
                value="{{$lesson->title}}"
                required
            />

            <x-input
                type="text"
                name="slug"
                class="text-left "
                value="{{$lesson->slug}}"
                placeholder="نام انگلیسی جلسه"
            />
            <x-input
                type="number"
                name="time"
                value="{{$lesson->time}}"
                class="text-left "
                placeholder="زمان جلسه"
            />
            <x-input
                type="number"
                name="number"
                class="text-left "
                value="{{$lesson->number}}"
                placeholder="شماره جلسه"
            />
            <div class="w-50 " style="margin:10px auto">
                <p class="box__title">ایا این جلسه رایگان است ؟ </p>
                <div class="notificationGroup">
                    <input id="lesson-upload-field-1" name="free" type="radio" value="0" @if(!$lesson->free) checked="" @endif>
                    <label for="lesson-upload-field-1">خیر</label>
                </div>
                <div class="notificationGroup">
                    <input id="lesson-upload-field-2" name="free" type="radio" value="1"@if($lesson->free) checked="" @endif>
                    <label for="lesson-upload-field-2">بله</label>
                </div>
            </div>

            <x-select name="season_id">
                <option value="">سرفصل</option>
                @foreach($seasons as $season)
                    <option value="{{$season->id}}"
                            @if($lesson->season_id && $lesson->season_id ==$seeson->id) checked="" @endif>{{$season->title}}</option>
                @endforeach
            </x-select>

            <x-file placeholder="آپلود جلسه*" name="lessonFile" :value="$lesson->media"/>
            <x-textarea placeholder="توضیحات جلسه" name="body" value="{{$lesson->body}}"/>
            <br>
            <button type="submit" class="btn btn-webamooz_net">بروزرسانی جلسه</button>
        </form>
    </div>

@endsection
