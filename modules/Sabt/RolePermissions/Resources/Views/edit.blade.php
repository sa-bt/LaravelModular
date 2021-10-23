@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('roles.index')}}" title="نقش ها">نقش ها</a></li>
    <li><a href="#" title="ویرایش نقش ها">ویرایش نقش ها</a></li>
@endsection
@section('content')
    <div class="col-4 bg-white" style="margin: auto">
        <p class="box__title">بروزرسانی نقش جدید</p>
        <form action="{{route('roles.update', $role->id)}}" method="post" class="padding-30">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="{{$role->id}}"/>
            <input type="text" name="name" required placeholder="نام نقش کاربری" class="text"
                   value="{{$role->name}}">

            @error('name')
            <span class="invalid-feedback margin-bottom-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
            @foreach($permissions as $permission)
                <label class="ui-checkbox pt-10">
                    <input
                        type="checkbox"
                        class="sub-checkbox" name="permissions[{{$permission->id}}]"
                        @if(is_array(old('permissions')) && array_key_exists($permission->id,old('permissions')) ||
                          $role->hasPermissionTo($permission->name)) checked @endif
                        value="{{$permission->id}}">
                    <span class="checkmark"></span>
                    @lang($permission->name)
                </label>
            @endforeach
            @error('permissions')
            <span class="invalid-feedback margin-bottom-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror
            @error('id')
            <span class="invalid-feedback margin-bottom-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
            @enderror

            <button type="submit" class="btn btn-webamooz_net mt-10">بروزرسانی</button>
        </form>
    </div>

@endsection
