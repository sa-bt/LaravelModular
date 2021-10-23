@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره ها">ایجاد دوره</a></li>
@endsection
@section('content')
        <div class="col-4 bg-white" style="margin: auto" >
            <p class="box__title">ایجاد دوره جدید</p>
            <form action="{{route('courses.store', $course->id)}}" method="post" class="padding-30">
                @csrf
                <input type="text" name="name" required placeholder="نام دوره" class="text"
                       value="{{$course->name}}">
                <input type="text" name="slug" required placeholder="نام انگلیسی دوره" class="text"
                       value="{{$course->slug}}">
                <p class="box__title margin-bottom-15">انتخاب دسته والد</p>
                <select name="parent_id" id="">
                    <option value="">ندارد</option>
                    @foreach($courses as $cat)
                        <option value="{{$cat->id}}"
                                @if($course->parent_id == $cat->id) selected @endif>{{$cat->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-webamooz_net">ایجاد</button>
            </form>
    </div>

@endsection
