@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('courses.index')}}" title="دوره ها">دوره ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دوره ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>ردیف</th>
                        <th>بنر</th>
                        <th>نام دوره</th>
                        <th>مدرس</th>
                        <th>نوع دوره</th>
                        <th>وضعیت</th>
                        <th>وضعیت تایید</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr role="row" class="">
                            <td>{{$course->id}}</td>
                            <td>{{$course->priority}}</td>
                            <td><img src="{{$course->banner->thumb}}" alt=""></td>
                            <td><a href="">{{$course->title}}</a></td>
                            <td><a href="">{{$course->teacher->name}}</a></td>
                            <td>@lang($course->type)</td>
                            <td class="status">@lang($course->status)</td>
                            <td class="confirmation_status">@lang($course->confirmation_status)</td>
                            <td>
                                <a href=""
                                   onclick="deleteItem(event,'{{route('courses.destroy',$course->id)}}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{route('courses.show',$course->id)}}" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('courses.edit',$course->id)}}" class="item-edit mlg-15"
                                   title="ویرایش"></a>
                                <a href="" class="item-confirm mlg-15"
                                   onclick="updateConfirmationStatus(
                                       event,
                                       '{{route('courses.accept',$course->id)}}',
                                       'آیا از تایید این آیتم اطمینان دارید؟',
                                       'تایید شده')"></a>
                                <a href="" class="item-reject mlg-15"
                                   onclick="updateConfirmationStatus(
                                       event,
                                       '{{route('courses.reject',$course->id)}}',
                                       'آیا از رد این آیتم اطمینان دارید؟',
                                       'رد شده')"></a>
                                <a href="" class="item-lock mlg-15"
                                   onclick="updateConfirmationStatus(
                                       event,
                                       '{{route('courses.lock',$course->id)}}',
                                       'آیا از قفل کردن این آیتم اطمینان دارید؟',
                                       'قفل شده',
                                       'status')"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
