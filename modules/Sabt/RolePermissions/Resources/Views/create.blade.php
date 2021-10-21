<p class="box__title">ایجاد نقش جدید</p>
<form action="{{route('roles.store')}}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" required placeholder="نام دسته بندی" class="text">
    <p class="box__title margin-bottom-15">انتخاب دسته والد</p>
    <select name="parent_id" id="">
        <option value="">ندارد</option>
        @foreach($roles as $role)
            <option value="{{$role->id}}">{{$role->name}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
</form>
