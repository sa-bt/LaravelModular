@extends('Front::layout.master')
@section('content')
    <main id="index" class="mrt-150">
        <div class="bt-0-top article mr-202"></div>
        <div class="bt-1-top">
            <div class="container">
                <div class="tutor">
                    <div class="tutor-item">
                        <div class="tutor-avatar">
                            <span class="tutor-image" id="tutor-image"><img src="{{$tutor->thumb}}"
                                                                            class="tutor-avatar-img"></span>
                            <div class="tutor-author-name">
                                <a id="tutor-author-name" href="" title="{{$tutor->name}}">
                                    <h3 class="title"><span class="tutor-author--name">{{$tutor->name}}</span></h3>
                                </a>
                            </div>
                            <div id="Modal1" class="modal">
                                <div class="modal-content" style="width: 800px;">
                                    <div class="modal-header">
                                        <div class="close">×</div>
                                    </div>
                                    <div class="modal-body">
                                        <img class="tutor--avatar--img" src="img/laravel-pic.png" alt="">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tutor-item">
                        <div class="stat">
                            <span class="tutor-number tutor-count-courses">{{count($tutor->teaches)}} </span>
                            <span class="">تعداد دوره ها</span>
                        </div>
                        <div class="stat">

                            <span class="tutor-number">{{$tutor->studentsCount()}} </span>
                            <span class="">تعداد  دانشجویان</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-filter">
                <div class="b-head">
                    <h2>دوره های {{$tutor->name}}</h2>
                </div>
                <div class="posts">
                    @foreach($tutor->teaches as $course)
                        @include('Front::layout.course')
                    @endforeach
                </div>
            </div>


            <div class="pagination">

            </div>
        </div>
    </main>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/modal.css">
@endsection

@section('js')
    <script src="/js/modal.js"></script>
@endsection
