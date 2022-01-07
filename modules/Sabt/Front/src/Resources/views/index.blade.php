@extends('Front::layout.master')
@section('content')
    <article class="container article">
        @include('Front::layout.ads')
        @include('Front::layout.top_info')
        @include('Front::layout.latestCourses')
        @include('Front::layout.popularCourses')
    </article>
    @include('Front::layout.latestArticles')
@endsection
