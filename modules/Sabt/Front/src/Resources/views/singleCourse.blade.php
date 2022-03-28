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
                        @elseif(auth()->user())
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
                                                                                     src="img/profile.jpg"
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
                                               <p>{{$course->teacher->bio}}</p>
                        </div>
                    </div>
                    <div class="short-link">
                        <div class="">
                            <span>لینک کوتاه</span>
                            <input class="short--link" value="webamooz.net/c/Y33x3">
                            <a href="" class="short-link-a" data-link="https://webamooz.net/c/Y33x3"></a>
                        </div>
                    </div>
                    <di class="sidebar-banners">

                        <div class="sidebar-pic">
                            <a href="https://t.me/webmooz_net"><img src="img/telgram.png" alt="کانال تلگرام"></a>
                        </div>

                        <div class="sidebar-pic">
                            <a href="https://t.me/webmooz_net"><img src="img/laravel-tel.png" alt="کانال تلگرام"></a>
                        </div>
                        <div class="sidebar-pic">
                            <a href="https:webamooz.net/blog"><img src="img/podcast.png" alt="وبلاگ وب آموز"></a>
                        </div>
                        <div class="sidebar-pic">
                            <a href="https://t.me/webmooz_net"><img src="img/workinja.png" alt="کانال تلگرام"></a>
                        </div>
                        <div class="sidebar-pic">
                            <a href="https://t.me/webmooz_net"><img src="img/blog-pic.png" alt="کانال تلگرام"></a>
                        </div>
                    </di>

                </div>
            </div>
            <div class="content-left">
                <div class="preview">
                    <video width="100%" controls="">
                        <source src="intro.mp4" type="video/mp4">
                    </video>
                </div>
                <a href="#" class="episode-download">دانلود این قسمت (قسمت 1)</a>
                <div class="course-description">
                    <div class="course-description-title">توضیحات دوره</div>
                    <p>
                        در این مقاله ما یاد می گیریم که ReactJs چیه و چرا ما باید از اون به جای فریمورک های دیگه جاوا
                        اسکریپت
                        مثل angular استفاده کنیم.
                    </p>
                    <p>ری اکت (reactjs) اساسا یک کتابخونه open-source جاوا اسکریپتی برای
                        ساخت رابط کاربری(user interfaces) برای
                        <a href="" target="_blank" rel="noopener nofollow">single page
                            applications(اپلیکیشن های تک صفحه ای</a>) است.این کتابخونه برای مدیریت لایه View برای وب
                        استفاده
                        می
                        شود.همچنین React این امکان رو در اختیار ما میذاره که reusable UI components(کامپوننت های قابل
                        استفاده
                        مجدد رابط کاریری) ایجاد کنیم.React&nbsp; در ابتدا توسط Jordan Walke یکی از مهندسین ارشد فیسبوک
                        ایجاد
                        شد.React ابتدا در سال 2011 در فیسبوک مورد استفاده قرار گرفت و سپس در سال 2012 در اینستاگرام
                        استفاده
                        شد.
                    </p>
                    <p>
                        ری اکت این امکان را در اختیار توسعه دهندگان می گذارد که وب اپلیکیشن های خیلی بزرگ که می تواند
                        date
                        را
                        تغییر بدهد،بدون reload صفحه ایجاد کنند.مهم ترین اهداف React را میتوان سادگی،سرعت و مقیاس پذیر
                        بودن
                        دانست.تمرکز اصلی React بر روی رابط کاربری است و فقط در لایه View در معماری MVC مطابقت دارد.این
                        کتابخانه
                        می تواند با کتابخانه های و فریمورک های دیگر جاوا اسکریپت مثل Angular ترکیب و مورد استفاده قرار
                        گیرد.
                    </p>
                    <h2 class="">ویژگی های React Js چیست</h2>
                    <p>بیایید نگاهی به ویژگی های مهم React بیاندازیم:</p>
                    <p><strong> JSX</strong></p>
                    <p>در React به جای استفاده از جاوا اسکریپت معمولی،از JSX برای templating استفاده می شود.jsx یک فرمت
                        جاوا
                        اسکریپتی برای ایجاد DOM های HTML در قالب یک کامپوننت است </p>
                    <p>
                        <img alt="آموزش جاوا اسکریپت" src="img/banner/lara.png"></p>
                    <p><strong>React Native </strong></p>
                    <p> یک فریمورک جاوا اسکریپتی برای توسعه اپلیکیشن های موبایل به صورت
                        Native برای دو سیستم عامل Android و&nbsp; ios است که در سال 2015 معرفی شد.این فریمورک بر پایه
                        زبان
                        جاوا
                        اسکریپت و کتابخانه React است.یعنی شما با تسلط بر React می توانید در یادگیریReact Native خیلی
                        جلوتر
                        از
                        بقیه باشید.البته توجه داشته باشید که بین این کتابخونه و فریمورک تفاوت های اساسی وجود دارد که
                        برای
                        درک
                        این تفاوت های پیشنهاد می کنم مقاله <a href="" target="_blank" rel="noopener nofollow">تفاوت های
                            اصلی
                            بین
                            React و
                            React Native</a> را بخوانید. </p>
                    <p>
                        <strong>Single-Way data flow</strong>
                    </p>
                    <p>
                        در React مجموعه ای از value های تغییر ناپذیر بین کامپوننت ها به عنوان properties به تگ های HTML
                        پاس
                        داده
                        می شوند.کامپوننت ها به صورت مستقیم نمی توانند هر properties را تغییر دهند اما می توانند آن ها را
                        به
                        call
                        back function پاس دهند و به کمک آن ها تغییرات را انجام دهند.این فراآیند به طور کامل با
                        “properties
                        flow
                        down; actions flow up” شناخته می شود
                    </p>
                    <p>
                        <strong> Virtual Document Object Model </strong>
                    </p>
                    <p>ری اکت React یک ساختار کش in-memory ایجاد می کند. در این ساختار اگر تغییری رخ داده باشد DOM را
                        بروزرسانی
                        می کند.این ویژگی برنامه نویس را قادر می سازد درحالی که در یک wtpi تغییرات ایجاد میشود تنها
                        کامپوننتی
                        rerender شود که تغییر پیدا کرده است.Virtual DOM ی مانند DOM یک درخت از گره هایی هست که شامل
                        element
                        ها و
                        attributes هایشان و محتوا به عنوان objects است.متدrender() یک درخت از کلمپوننت های React ایجاد
                        می
                        کند و
                        تغییر در هر کامپوننت باعث می شود این گره بروز رسانی شو</p>
                    <div class="tags">
                        <ul>
                            <li><a href="">ری اکت</a></li>
                            <li><a href="">reactjs</a></li>
                            <li><a href="">جاوااسکریپت</a></li>
                            <li><a href="">javascript</a></li>
                            <li><a href="">reactjs چیست</a></li>
                        </ul>
                    </div>
                </div>
                <div class="episodes-list">
                    <div class="episodes-list--title">فهرست جلسات</div>
                    <div class="episodes-list-section">
                        <div class="episodes-list-item ">
                            <div class="section-right">
                                <span class="episodes-list-number">۱</span>
                                <div class="episodes-list-title">
                                    <a href="php-ep-1.html">php چیست</a>
                                </div>
                            </div>
                            <div class="section-left">
                                <div class="episodes-list-details">
                                    <div class="episodes-list-details">
                                        <span class="detail-type">رایگان</span>
                                        <span class="detail-time">44:44</span>
                                        <a class="detail-download">
                                            <i class="icon-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="episodes-list-item">
                            <div class="section-right">
                                <span class="episodes-list-number">2</span>
                                <div class="episodes-list-title">
                                    <a href="php-ep-2.html">نصب و راه اندازی</a>
                                </div>
                            </div>
                            <div class="section-left">
                                <div class="episodes-list-details">
                                    <div class="episodes-list-details">
                                        <span class="detail-type">رایگان</span>
                                        <span class="detail-time">44:44</span>
                                        <a class="detail-download">
                                            <i class="icon-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="episodes-list-item lock">
                            <div class="section-right">
                                <span class="episodes-list-number">3</span>
                                <div class="episodes-list-title">
                                    <a href="#">اضافه کردن متد های جدید به router - از فصل اول بخش اخر</a>
                                </div>
                            </div>
                            <div class="section-left">
                                <div class="episodes-list-details">
                                    <div class="episodes-list-details">
                                        <!--                                            <span class="detail-type">نقدی</span>-->
                                        <span class="detail-time">44:44</span>
                                        <a class="detail-download">
                                            <i class="icon-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="episodes-list-item lock">
                            <div class="section-right">
                                <span class="episodes-list-number">-</span>
                                <div class="episodes-list-title">
                                    <a href="#">دانلود فایل</a>
                                </div>
                            </div>
                            <div class="section-left">
                                <div class="episodes-list-details">
                                    <div class="episodes-list-details">
                                        <!--                                            <span class="detail-type">نقدی</span>-->
                                        <span class="detail-time"></span>
                                        <a class="detail-download">
                                            <i class="icon-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
