<p class="box__title">ایجاد نقش جدید</p>
<form action="{{route('roles.store')}}" method="post" class="padding-30">
    @csrf
    <input
        type="text"
        name="name"
        required
        placeholder="نام نقش کاربری"
        class="text @error('name') is-invalid @enderror"
        value="{{old('name')}}"
    >
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
                @if(is_array(old('permissions')) && array_key_exists($permission->id,old('permissions'))) checked @endif
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
    <br>
    <button type="submit" class="btn btn-webamooz_net mt-10">اضافه کردن</button>
</form>
