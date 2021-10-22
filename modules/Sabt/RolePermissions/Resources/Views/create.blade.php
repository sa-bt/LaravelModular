<p class="box__title">ایجاد نقش جدید</p>
<form action="{{route('roles.store')}}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" required placeholder="نام نقش کاربری" class="text">
    <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
        @foreach($permissions as $permission)
        <label class="ui-checkbox pt-10">
            <input type="checkbox" class="sub-checkbox" name="permission[{{$permission->id}}]" data-id="1" value="{{$permission->id}}">
            <span class="checkmark"></span>
            @lang($permission->name)
        </label>
    @endforeach
    <button type="submit" class="btn btn-webamooz_net mt-10">اضافه کردن</button>
</form>
