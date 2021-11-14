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
                                            <li>{{$role->name}}</li>
                                        @endforeach
                                        <li><a href="#roles-modal" onclick="setFormAction({{$user->id}})"
                                               rel="modal:open">اصلاح نقش کاربری</a></li>
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
        Swal.queue([{
            icon: 'success',
            title: 'success',
            timer: 3000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
        },
       {
            icon: 'error',
            title: 'salam',
            timer: 30000,
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
        }])
        @if(session()->has('feedback'))
            @foreach(session()->get('feedback') as $feedback)
        Toast.fire({
            icon: '{{$feedback['type']}}',
            title: '{{$feedback['message']}}'
        })
        @endforeach
        @endif

    </script>
@endsection
