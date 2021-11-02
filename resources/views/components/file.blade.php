<div class="file-upload">
    <div class="i-file-upload">
        <span>{{$placeholder}}</span>
        <input type="file" class="file-upload" id="files" name="{{$name}}"/>
    </div>
    <span class="filesize"></span>
    @if(isset($value))
        <span class="selectedFiles">
            <img src="{{$value->thumb}}" alt="">
        </span>
    @else
        <span class="selectedFiles">فایلی انتخاب نشده است</span>
    @endif
    <x-ValidationError field="{{$name}}"/>
</div>
