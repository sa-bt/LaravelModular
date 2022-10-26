<form action="{{route('users.photo')}}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img
                src="@if(auth()->user()->image_id) {{auth()->user()->image->thumb}} @else {{'/panel/img/pro.jpg'}}@endif"
                class="avatar___img" >
            <input type="file" accept="image/*" class="hidden avatar-img__input" name="image" onchange="this.form.submit()">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر : {{auth()->user()->name}}</span>
    </div>
</form>

