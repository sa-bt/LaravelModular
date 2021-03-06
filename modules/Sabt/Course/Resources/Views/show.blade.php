@extends('Dashboard::master')

@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="{{$course->title}}">{{$course->title}}</a></li>
@endsection

@section('content')
    <div class="col-12 bg-white" style="margin: auto">
        <div class="row no-gutters  ">
            <div class="col-8 bg-white padding-30 margin-left-10 margin-bottom-15 border-radius-3">
                <div class="margin-bottom-20 flex-wrap font-size-14 d-flex bg-white padding-0">
                    <p class="mlg-15">{{$course->title}}</p>
                    <a class="btn all-confirm-btn" href="{{route('lessons.create',$course->id)}}">آپلود جلسه جدید</a>
                </div>
                <div class="d-flex item-center flex-wrap margin-bottom-15 operations__btns">
                    @can('change_confirmation_status',$course)
                        <button class="btn confirm-btn" onclick="changeMultiple(
                            '{{route("lessons.acceptMultiple",$course->id)}}',
                            'تایید جلسات',
                            'آیا از تایید جلسات انتخاب شده اطمینان دارید؟')"
                        >تایید جلسات
                        </button>

                        <button class="btn reject-btn" onclick="changeMultiple(
                            '{{route("lessons.rejectMultiple",$course->id)}}',
                            'رد جلسات',
                            'آیا از رد جلسات انتخاب شده اطمینان دارید؟')"
                        >رد جلسات
                        </button>

                        <button
                            class="btn delete-btn"
                            onclick="changeMultiple(
                                '{{route("lessons.deleteMultiple",$course->id)}}',
                                'حذف رکورد',
                                'آیا از حذف این رکورد(ها) اطمینان دارید؟',
                                'delete')"
                        >حذف جلسات
                        </button>
                    @endcan

                </div>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th style="padding: 13px 30px;">
                                <label class="ui-checkbox">
                                    <input type="checkbox" class="checkedAll">
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th>شناسه</th>
                            <th>عنوان جلسه</th>
                            <th>عنوان فصل</th>
                            <th>مدت زمان جلسه</th>
                            <th>وضعیت تایید</th>
                            <th>سطح دسترسی</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->lessons as $lesson)
                            <tr role="row" class="" data-row-id="1">
                                <td>
                                    <label class="ui-checkbox">
                                        <input type="checkbox" class="sub-checkbox" data-id="{{$lesson->id}}">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><a href="">{{$lesson->number}}</a></td>
                                <td><a href="">{{$lesson->title}}</a></td>
                                <td>{{$lesson->season?$lesson->season->title:''}}</td>
                                <td>{{$lesson->time}}</td>
                                <td class="confirmation_status">@lang($lesson->confirmation_status)</td>
                                <td>{{$lesson->access}}</td>
                                <td>

                                    <a href="{{route('lessons.show',[$course->id,$lesson->id])}}"
                                       class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{route('lessons.edit',[$course->id,$lesson->id])}}"
                                       class="item-edit mlg-15"
                                       title="ویرایش"></a>
                                    @can('change_confirmation_status',$course)
                                        <a href="#"
                                           onclick="deleteItem(event,'{{route('lessons.destroy',[$course->id,$lesson->id])}}')"
                                           class="item-delete mlg-15" title="حذف"></a>
                                        <a href="#" class="item-confirm mlg-15"
                                           onclick="updateConfirmationStatus(
                                               event,
                                               '{{route('lessons.accept',[$course->id,$lesson->id])}}',
                                               'آیا از تایید این آیتم اطمینان دارید؟',
                                               'تایید شده')"></a>
                                        <a href="#" class="item-reject mlg-15"
                                           onclick="updateConfirmationStatus(
                                               event,
                                               '{{route('lessons.reject',[$course->id,$lesson->id])}}',
                                               'آیا از رد این آیتم اطمینان دارید؟',
                                               'رد شده')"></a>
                                        <a href="#" class="item-lock mlg-15"
                                           onclick="updateConfirmationStatus(
                                               event,
                                               '{{route('lessons.lock',[$course->id,$lesson->id])}}',
                                               'آیا از قفل کردن این آیتم اطمینان دارید؟',
                                               'قفل شده',
                                               'status')"></a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4">

                @include('Course::seasons.index')

                <div class="col-12 bg-white margin-bottom-15 border-radius-3">
                    <p class="box__title">اضافه کردن دانشجو به دوره</p>
                    <form action="" method="post" class="padding-30">
                        <select name="" id="">
                            <option value="0">انتخاب کاربر</option>
                            <option value="1">mohammadniko3@gmail.com</option>
                            <option value="2">sayad@gamil.com</option>
                        </select>
                        <div class="dropdown-select wide " tabindex="0"><span class="current">انتخاب کاربر</span>
                            <div class="list">
                                <div class="dd-search"><input id="txtSearchValue" autocomplete="off" onkeyup="filter()"
                                                              class="dd-searchbox" type="text"></div>
                                <ul>
                                    <li class="option selected" data-value="0" data-display-text="">انتخاب کاربر</li>
                                    <li class="option " data-value="1" data-display-text="">mohammadniko3@gmail.com</li>
                                    <li class="option " data-value="2" data-display-text="">sayad@gamil.com</li>
                                </ul>
                            </div>
                        </div>
                        <input type="text" placeholder="مبلغ دوره" class="text">
                        <p class="box__title">کارمزد مدرس ثبت شود ؟</p>
                        <div class="notificationGroup">
                            <input id="course-detial-field-1" name="course-detial-field" type="radio" checked="">
                            <label for="course-detial-field-1">بله</label>
                        </div>
                        <div class="notificationGroup">
                            <input id="course-detial-field-2" name="course-detial-field" type="radio">
                            <label for="course-detial-field-2">خیر</label>
                        </div>
                        <button class="btn btn-webamooz_net">اضافه کردن</button>
                    </form>
                    <div class="table__box padding-30">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th class="p-r-90">شناسه</th>
                                <th>نام و نام خانوادگی</th>
                                <th>ایمیل</th>
                                <th>مبلغ (تومان)</th>
                                <th>درامد شما</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="">
                                <td><a href="">1</a></td>
                                <td><a href="">توفیق حمزه ای</a></td>
                                <td><a href="">Mohammadniko3@gmail.com</a></td>
                                <td><a href="">40000</a></td>
                                <td><a href="">20000</a></td>
                                <td>
                                    <a href="" class="item-delete mlg-15" title="حذف"></a>
                                    <a href="" class="item-edit " title="ویرایش"></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script></script>
@endsection
