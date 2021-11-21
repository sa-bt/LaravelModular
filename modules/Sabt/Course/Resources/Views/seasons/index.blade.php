<div class="col-12 bg-white margin-bottom-15 border-radius-3">
    <p class="box__title">سرفصل ها</p>
    <form action="{{route('seasons.store')}}" method="post" class="padding-30">
        @csrf
        <input type="hidden" name="course_id" value="{{$course->id}}"/>
        <x-input type="text" placeholder="عنوان سرفصل" class="text" name="title"/>
        <x-input type="text" placeholder="شماره سرفصل" class="text " name="number"/>
        <button class="btn btn-webamooz_net margin-top-20">اضافه کردن</button>
    </form>
    <div class="table__box padding-30">
        <table class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th class="p-r-90">شناسه</th>
                <th>عنوان فصل</th>
                <th>وضعیت</th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->seasons()->orderByNumber() as $season)
                <tr role="row" class="">
                    <td><a href="">{{$season->number}}</a></td>
                    <td><a href="">{{$season->title}}</a></td>
                    <td class="confirmation_status">
                        {!! $season->confirmation_status==\Sabt\Course\Models\Season::CONFIRMATION_STATUS_ACCEPTED
                        ? "<span class='text-success'>تایید شده</span>"
                        :($season->confirmation_status==\Sabt\Course\Models\Season::CONFIRMATION_STATUS_REJECTED
                        ?"<span class='text-error'>رد شده</span>"
                        : "<span class='text-error'>تایید نشده</span>")!!}
                    </td>
                    <td>
                        <a href="" class="item-delete mlg-15" title="حذف"
                           onclick="deleteItem(event,'{{route('seasons.destroy',$season->id)}}')"></a>
                        <a href="" class="item-confirm mlg-15"
                           onclick="updateConfirmationStatus(
                               event,
                               '{{route('seasons.accept',$season->id)}}',
                               'آیا از تایید این آیتم اطمینان دارید؟',
                               'تایید شده')"></a>
                        <a href="" class="item-reject mlg-15"
                           onclick="updateConfirmationStatus(
                               event,
                               '{{route('seasons.reject',$season->id)}}',
                               'آیا از رد این آیتم اطمینان دارید؟',
                               'رد شده')"></a>
                        <a href="{{route('seasons.edit',$season->id)}}" class="item-edit " title="ویرایش"></a>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</div>
