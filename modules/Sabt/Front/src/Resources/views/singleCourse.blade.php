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
                            {{--                            <li><a href="{{$course->category->parent}}" title="برنامه نویسی">{{$course->category->parent->title}}</a></li>--}}
                        @endif
                        <li><a href="" title="وب">وب</a></li>
                    </ul>
                </div>
            </div>

        </article>


        <div class="main-row container">
            <div class="sidebar-right">
                <div class="sidebar-sticky" style="top: 104px;">
                    <div class="product-info-box">
                        <div class="discountBadge d-none">
                            <p>45%</p>
                            تخفیف
                        </div>
                        <div class="sell_course d-none">
                            <strong>قیمت :</strong>
                            <del class="discount-Price">900,000</del>
                            <p class="price">
                        <span class="woocommerce-Price-amount amount">495,000
                            <span class="woocommerce-Price-currencySymbol">تومان</span>
                        </span>
                            </p>
                        </div>
                        @if(auth()->id()==$course->teacher_id)
                            <p class="mycourse ">شما مدرس این دوره هستید</p>
                        @elseif(auth()->user()&&auth()->user()->hasAccessToCourse($course->id))
                            <p class="mycourse ">شما این دوره رو خریداری کرده اید</p>
                        @else
                            <button class="btn buy ">خرید دوره</button>
                        @endif
                        <div class="average-rating-sidebar">
                            <div class="rating-stars">
                                <div class="slider-rating">
                                    <span class="slider-rating-span slider-rating-span-100" data-value="100%"
                                          data-title="خیلی خوب"></span>
                                    <span class="slider-rating-span slider-rating-span-80" data-value="80%"
                                          data-title="خوب"></span>
                                    <span class="slider-rating-span slider-rating-span-60" data-value="60%"
                                          data-title="معمولی"></span>
                                    <span class="slider-rating-span slider-rating-span-40" data-value="40%"
                                          data-title="بد"></span>
                                    <span class="slider-rating-span slider-rating-span-20" data-value="20%"
                                          data-title="خیلی بد"></span>
                                    <div class="star-fill"></div>
                                </div>
                            </div>

                            <div class="average-rating-number">
                                <span class="title-rate title-rate1">امتیاز</span>
                                <div class="schema-stars">
                                    <span class="value-rate text-message"> 4 </span>
                                    <span class="title-rate">از</span>
                                    <span class="value-rate"> 555 </span>
                                    <span class="title-rate">رأی</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info-box">
                        <div class="product-meta-info-list">
                            <div class="total_sales">
                                تعداد دانشجو : <span>246</span>
                            </div>
                            <div class="meta-info-unit one">
                                <span class="title">تعداد جلسات منتشر شده :  </span>
                                <span class="vlaue">{{$course->lessonsCount()}}</span>
                            </div>
                            <div class="meta-info-unit two">
                                <span class="title">مدت زمان دوره تا الان : </span>
                                <span class="vlaue">{{$course->formattedDuration()}}</span>
                            </div>
                            <div class="meta-info-unit three">
                                <span class="title">مدت زمان کل دوره : </span>
                                <span class="vlaue">-</span>
                            </div>
                            <div class="meta-info-unit four">
                                <span class="title">مدرس دوره : </span>
                                <span class="vlaue">{{$course->teacher->name}}</span>
                            </div>
                            <div class="meta-info-unit five">
                                <span class="title">وضعیت دوره : </span>
                                <span class="vlaue">@lang($course->status)</span>
                            </div>
                            <div class="meta-info-unit six">
                                <span class="title">پشتیبانی : </span>
                                <span class="vlaue">دارد</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-teacher-details">
                        <div class="top-part">
                            <a href="https://webamooz.net/tutor/mohammadnikoo/"><img alt="{{$course->teacher->name}}"
                                                                                     class="img-fluid lazyloaded"
                                                                                     src="{{$course->teacher->thumb}}"
                                                                                     loading="lazy">
                                <noscript>
                                    <img class="img-fluid" src="img/profile.jpg" alt="{{$course->teacher->name}}">
                                </noscript>
                            </a>
                            <div class="name">
                                <a href="https://webamooz.net/tutor/mohammadnikoo/" class="btn-link">
                                    <h6>{{$course->teacher->name}}</h6>
                                </a>
                                <span class="job-title">{{$course->teacher->headline}}</span>
                            </div>
                        </div>
                        <div class="job-content">
{{--                            <p>{{$course->teacher->bio}}</p>--}}
                        </div>
                    </div>
                    <div class="short-link">
                        <div class="">
                            <span>لینک کوتاه</span>
                            <input class="short--link" value="{{$course->shortUrl()}}">
                            <a href="{{$course->shortUrl()}}" class="short-link-a" data-link="{{$course->shortUrl()}}"></a>
                        </div>
                    </div>
@include('Front::layout.sidebar-banners')
                </div>
            </div>
            <div class="content-left">
                <div class="preview">
                    <video width="100%" controls="">
                        <source src="intro.mp4" type="video/mp4">
                    </video>
                </div>
                <a href="#" class="episode-download">دانلود این قسمت (قسمت {{$lesson->number}})</a>
                <div class="course-description">
                    {{$course->body}}
                </div>
                @include('Front::layout.episodes-list')

            </div>
        </div>
    </div>
@endsection
