@extends('Front::layout.master')

@section('content')

    <div class="container">
        <article class="article">
            @include('Front::layout.ads')
            <div class="h-t">
                <h1 class="title">{{$course->title}}</h1>
                <div class="breadcrumb">
                    <ul>
                        <li><a href="" title="خانه">خانه</a></li>
                        @if($course->category->parent)
                            <li><a href="{{$course->category->parent}}" title="برنامه نویسی">{{$course->category->parent->title}}</a></li>
                        @endif
                        <li><a href="" title="وب">وب</a></li>
                    </ul>
                </div>
            </div>

        </article>
    </div>
@endsection
