@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('categories.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره ها">ویرایش دوره ها</a></li>
@endsection
@section('content')
        <div class="col-4 bg-white" style="margin: auto" >
            <p class="box__title">بروزرسانی دوره جدید</p>
            <form action="{{route('categories.update', $category->id)}}" method="post" class="padding-30">
                @csrf
                @method('put')
                <input type="text" name="name" required placeholder="نام دوره" class="text"
                       value="{{$category->name}}">
                <input type="text" name="slug" required placeholder="نام انگلیسی دوره" class="text"
                       value="{{$category->slug}}">
                <p class="box__title margin-bottom-15">انتخاب دسته والد</p>
                <select name="parent_id" id="">
                    <option value="">ندارد</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}"
                                @if($category->parent_id == $cat->id) selected @endif>{{$cat->name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-webamooz_net">بروزرسانی</button>
            </form>
    </div>

@endsection
