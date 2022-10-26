<div class="file-upload">
    <div class="i-file-upload">
        <span>{{$placeholder}}</span>
        <input type="file" class="file-upload" id="files" name="{{$name}}"/>
    </div>
    <span class="filesize"></span>
    @if(isset($value))

        <p class="selectedFiles">
            <p>فایل انتخاب شده: {{$value->filename}}</p>
            <img src="{{$value->thumb}}" alt="" width="100" height="100">
        </p>
    @else
        <span class="selectedFiles">فایلی انتخاب نشده است</span>
    @endif
    <x-ValidationError field="{{$name}}"/>
</div>
