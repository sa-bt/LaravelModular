@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره ها">ویرایش دوره</a></li>
@endsection
@section('content')
    <div class="col-10 bg-white" style="margin: auto">
        <p class="box__title">ویرایش دوره </p>
        <form action="{{route('courses.update',$course->id)}}" class="padding-30" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <x-input
                type="text"
                class=""
                name="title"
                placeholder="عنوان دوره"
                required
                value="{{$course->title}}"
            />

            <x-input
                type="text"
                name="slug"
                class="text-left "
                placeholder="نام انگلیسی دوره"
                required
                value="{{$course->slug}}"
            />

            <div class="d-flex multi-text ">
                <x-input
                    type="text"
                    name="priority"
                    class="text-left "
                    placeholder="ردیف دوره"
                    value="{{$course->priority}}"
                />
                <x-input
                    type="text"
                    name="price"
                    placeholder="مبلغ دوره"
                    class="text-left "
                    required
                    value="{{$course->price}}"
                />
                <x-input
                    type="number"
                    name="percent"
                    placeholder="درصد مدرس"
                    class="text-left"
                    required
                    value="{{$course->percent}}"
                />
            </div>

            <x-select name="teacher_id">
                <option value="">انتخاب مدرس دوره</option>
                @foreach($teachers as $teacher)
                    <option
                        value="{{$teacher->id}}" @if($teacher->id == $course->teacher_id) selected @endif>{{$teacher->name}}</option>
                @endforeach
            </x-select>


            <x-tag-select name="tags"/>
            <x-select name="type">
                <option value="">نوع دوره</option>
                @foreach(\Sabt\Course\Models\Course::$types as $type)
                    <option value="{{$type}}" @if($type == $course->type) selected @endif >@lang($type)</option>
                @endforeach
            </x-select>

            <x-select name="status">
                <option value="">وضعیت دوره</option>
                @foreach(\Sabt\Course\Models\Course::$statuses as $status)
                    <option value="{{$status}}" @if($status == $course->status) selected @endif >@lang($status)</option>
                @endforeach
            </x-select>

            <x-select name="category_id">
                <option value="">دسته بندی والد</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"  @if($category->id == $course->category_id) selected @endif>{{$category->name}} </option>
                @endforeach
            </x-select>

            {{--            <select name="">--}}
            {{--                <option value="0">زیر دسته بندی</option>--}}
            {{--                <option value="1">وب</option>--}}
            {{--                <option value="2">ویندوز</option>--}}
            {{--                <option value="3">اندروید</option>--}}
            {{--            </select>--}}
            <x-file placeholder="آپلود بنر دوره" name="image" :value="$course->banner"/>
            <x-textarea placeholder="توضیحات دوره" name="body" value="{{$course->body}}"/>
            <br>
            <button type="submit" class="btn btn-webamooz_net">بروزرسانی دوره</button>
        </form>
    </div>

@endsection
@section('js')
    <script src="/panel/js/tagsInput.js"></script>
@endsection
