<div class="episodes-list">
    <div class="episodes-list--title">فهرست جلسات</div>
    <div class="episodes-list-section">
        @foreach($lessons as $lesson)
            <div
                class="episodes-list-item  {{auth()->user() && auth()->user()->hasAccessToCourse($lesson->course)?'':'lock'}}">
                <div class="section-right">
                    <span class="episodes-list-number">{{$lesson->number}}</span>
                    <div class="episodes-list-title">
                        <a href="{{$lesson->path()}}">{{$lesson->title}}</a>
                    </div>
                </div>
                <div class="section-left">
                    <div class="episodes-list-details">
                        <div class="episodes-list-details">
                            <span class="detail-type">@lang($lesson->type)</span>
                            <span class="detail-time">{{$lesson->time}}</span>
                            <a class="detail-download">
                                <i class="icon-download"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
