@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ویرایش دوره ها">ایجاد دوره</a></li>
@endsection
@section('content')
    <div class="col-10 bg-white" style="margin: auto" >
        <p class="box__title">ایجاد دوره جدید</p>
        <form action="{{route('courses.store')}}" class="padding-30" method="post">
            @csrf
            <input
                type="text"
                class="text @error('title') is-invalid @enderror"
                name="title"
                placeholder="عنوان دوره"

            >
            <x-ValidationError field="title"/>


            <input
                type="text"
                name="slug"
                class="text text-left @error('slug') is-invalid @enderror"
                placeholder="نام انگلیسی دوره"

            >
            <x-ValidationError field="slug"/>

            <div class="d-flex multi-text">
                <input type="text" name="priority" class="text text-left mlg-15 @error('priority') is-invalid @enderror" placeholder="ردیف دوره">
                <x-ValidationError field="priority"/>


                <input type="text" name="price" placeholder="مبلغ دوره"  class="text-left text mlg-15 @error('price') is-invalid @enderror">
                <x-ValidationError field="price"/>


                <input type="number" name="percent" placeholder="درصد مدرس"  class="text-left text @error('percent') is-invalid @enderror">
                <x-ValidationError field="percent"/>

            </div>
            <select name="teacher_id" >
                <option value="">انتخاب مدرس دوره</option>
                @foreach($teachers as $teacher)
                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                    @endforeach
            </select>
            <x-ValidationError field="teacher_id"/>


            <ul class="tags">

                <li class="addedTag">dsfsdf<span class="tagRemove" onclick="$(this).parent().remove();">x</span>
                    <input type="hidden" value="dsfsdf" name="tags[]"></li>
                <li class="addedTag">dsfsdf<span class="tagRemove" onclick="$(this).parent().remove();">x</span>
                    <input type="hidden" value="dsfsdf" name="tags[]"></li>
                <li class="tagAdd taglist">
                    <input type="text" id="search-field" placeholder="برچسب ها">
                </li>
            </ul>
            <select name="type" >
                <option value="">نوع دوره</option>
                @foreach(\Sabt\Course\Models\Course::$types as $type)
                    <option value="{{$type}}">@lang($type)</option>
                @endforeach
            </select>
            <x-ValidationError field="type"/>

            <select name="status" >
                <option value="">وضعیت دوره</option>
                @foreach(\Sabt\Course\Models\Course::$statuses as $status)
                    <option value="{{$status}}">@lang($status)</option>
                @endforeach
            </select>
            <x-ValidationError field="status"/>

            <select name="category_id" >
                <option value="0">دسته بندی والد</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <x-ValidationError field="category_id"/>

            {{--            <select name="">--}}
{{--                <option value="0">زیر دسته بندی</option>--}}
{{--                <option value="1">وب</option>--}}
{{--                <option value="2">ویندوز</option>--}}
{{--                <option value="3">اندروید</option>--}}
{{--            </select>--}}
            <div class="file-upload">
                <div class="i-file-upload">
                    <span>آپلود بنر دوره</span>
                    <input type="file" class="file-upload" id="files" name="image" />
                    <x-ValidationError field="image"/>

                </div>
                <span class="filesize"></span>
                <span class="selectedFiles">فایلی انتخاب نشده است</span>
            </div>
            <textarea placeholder="توضیحات دوره" class="text h" name="body"></textarea>
            <button type="submit" class="btn btn-webamooz_net">ایجاد دوره</button>
        </form>
    </div>

@endsection
@section('js')
    <script src="/panel/js/tagsInput.js"></script>
@endsection
