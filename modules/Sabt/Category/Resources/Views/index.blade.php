@extends('Dashboard::master')
@section('content')
    <div class="row no-gutters  ">
        <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
            <p class="box__title">دسته بندی ها</p>
            <div class="table__box">
                <table class="table">
                    <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام دسته بندی</th>
                        <th>نام انگلیسی دسته بندی</th>
                        <th>دسته پدر</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr role="row" class="">
                            <td><a href="">{{$category->id}}</a></td>
                            <td><a href="">{{$category->name}}</a></td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->parent}}</td>
                            <td>
                                <a href=""
                                   onclick="event.preventDefault(); deleteItem(event,'{{route('categories.destroy',$category->id)}}')"
                                   class="item-delete mlg-15" title="حذف"></a>
                                <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                <a href="{{route('categories.edit',$category->id)}}" class="item-edit "
                                   title="ویرایش"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-4 bg-white">
            @include('Category::create')
        </div>
    </div>
@endsection
@section('js')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })



        function deleteItem(event, route) {
            Swal.fire({
                title: 'حذف رکورد',
                text: "آیا از حذف این رکورد اطمینان دارید؟",
                icon: 'error',
                showDenyButton: true,
                // showCancelButton: true,
                confirmButtonText: 'بله',
                denyButtonText: `خیر`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.post(route, {
                        _method: "delete",
                        _token: "{{csrf_token()}}"
                    })
                        .done(function (response) {
                            event.target.closest('tr').remove()
                            Toast.fire({
                                icon: 'success',
                                title: response.message
                            })
                        })
                        .fail()
                }
                // else if (result.isDenied) {
                //     Swal.fire('Changes are not saved', '', 'info')
                // }
            })
        }
    </script>
@endsection
