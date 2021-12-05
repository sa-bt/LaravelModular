@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="{{route('courses.show',$course->id)}}" title="{{$course->title}}">{{$course->title}}</a></li>
    <li><a href="#" title="ایجاد جلسه">ایجاد جلسه</a></li>
@endsection
@section('content')
    <div class="col-10 bg-white" style="margin: auto">
        <p class="box__title">ایجاد جلسه جدید</p>
        <form action="{{route('lessons.store',[$course->id])}}" class="padding-30" method="post" enctype="multipart/form-data">
            @csrf
            <x-input
                type="text"
                class=""
                name="title"
                placeholder="عنوان جلسه*"
                required
            />

            <x-input
                type="text"
                name="slug"
                class="text-left "
                placeholder="نام انگلیسی جلسه"
            />
            <x-input
                type="number"
                name="time"
                class="text-left "
                placeholder="زمان جلسه"
            />
            <x-input
                type="number"
                name="number"
                class="text-left "
                placeholder="شماره جلسه"
            />
            <div class="w-50 " style="margin:10px auto">
                <p class="box__title">ایا این جلسه رایگان است ؟ </p>
                <div class="notificationGroup">
                    <input id="lesson-upload-field-1" name="free" type="radio" value="0" checked="">
                    <label for="free-1">خیر</label>
                </div>
                <div class="notificationGroup">
                    <input id="free-2" name="free" type="radio" value="1">
                    <label for="lesson-upload-field-2">بله</label>
                </div>
            </div>

            <x-select name="status">
                <option value="">وضعیت جلسه</option>
                @foreach(\Sabt\Course\Models\Lesson::$confirmationStatuses as $status)
                    <option value="{{$status}}" @if($status == old('status')) selected @endif >@lang($status)</option>
                @endforeach
            </x-select>

            <x-select name="season_id">
                <option value="">سرفصل</option>
                @foreach($seasons as $season)
                    <option value="{{$season->id}}">{{$season->title}}</option>
                @endforeach
            </x-select>

            <x-file placeholder="آپلود جلسه*" name="lessonFile"/>
            <x-textarea placeholder="توضیحات جلسه" name="body"/>
            <br>
            <button type="submit" class="btn btn-webamooz_net">ایجاد جلسه</button>
        </form>
    </div>

@endsection
@section('js')
    <script src="/panel/js/tagsInput.js"></script>
@endsection
