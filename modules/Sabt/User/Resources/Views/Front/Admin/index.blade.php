@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('users.index')}}" title="دوره ها">دوره ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دوره ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>ردیف</th>
                        <th>شناسه</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>نقش کاربری</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr role="row" class="">
                            <td>{{$loop->index +1}}</td>
                            <td>{{$user->id}}</td>
                            <td><a href="">{{$user->name}}</a></td>
                            <td><a href="">{{$user->email}}</a></td>
                            <td><a href="">
                                    <ul>
                                        @foreach($user->roles as $role)
                                            <li class="delete-list-item">{{$role->name}} <a href=""
                                                                   onclick="deleteItem(event,'{{route('users.removeRole',['user'=>$user,'role'=>$role])}}','li')"
                                                                   class="item-remove margin-right-5 bold " title="حذف"></a>
                                            </li>
                                        @endforeach
                                        <li><a href="#roles-modal" onclick="setFormAction({{$user->id}})"
                                               rel="modal:open" class="item-add mlg-15 bold text-l" title="اضافه کردن نقش کاربری"></a></li>
                                    </ul>
                                </a></td>
                            <td>
                                <a href=""
                                   onclick="deleteItem(event,'{{route('users.destroy',$user->id)}}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('users.edit',$user->id)}}" class="item-edit mlg-15"
                                   title="ویرایش"></a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="roles-modal" class="modal">
                    <form action="{{route('users.addRole',0)}}" id="role-form" method="post">
                        @csrf
                        <select name="role" id="">
                            <option value="">نقش کاربری را انتخاب کنید</option>
                            @foreach($roles as $role)
                                <option value="{{$role->name}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-webamooz_net mt-10">افزودن</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script>
        function setFormAction(id) {
            $('#role-form').attr('action', '{{route('users.addRole',0)}}'.replace('/0/', '/' + id + '/'))
        }
        @include('Common::layouts.feedback')

    </script>
@endsection
