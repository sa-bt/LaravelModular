@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('roles.index')}}" title="نقش ها">نقش ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">نقش های کاربری</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نقش کاربری</th>
                        <th>مجوزها</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr role="row" class="">
                            <td><a href="">{{$role->id}}</a></td>
                            <td><a href="">{{$role->name}}</a></td>
                            <td>
                                <ul>
                                    @foreach($role->permissions as $permission)
                                        <li>
                                            @lang($permission->name)
                                        </li>
                                        @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href=""
                                   onclick="event.preventDefault(); deleteItem(event,'{{route('roles.destroy',$role->id)}}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('roles.edit',$role->id)}}" class="item-edit "
                                   title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('RolePermissions::create')
        </div>
    </div>
@endsection
@section('js')
    <script>

    </script>
@endsection
