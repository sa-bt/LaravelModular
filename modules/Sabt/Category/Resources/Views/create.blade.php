<p class="box__title">ایجاد دسته بندی جدید</p>
<form action="{{route('categories.store')}}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" required placeholder="نام دسته بندی" class="text">
    <input type="text" name="slug" required placeholder="نام انگلیسی دسته بندی" class="text">
    <p class="box__title margin-bottom-15">انتخاب دسته والد</p>
    <select name="parent_id" id="">
        <option value="">ندارد</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-webamooz_net">اضافه کردن</button>
</form>
