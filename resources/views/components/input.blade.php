<div class="w-100 mlg-15 ">
    <input
        type="{{$type}}"
        class="text @error($name) is-invalid @enderror"
        name="{{$name}}"
        placeholder="{{$placeholder}}"
        {{$attributes->merge(['class'=>'w-100 '])}}
    >
    <x-ValidationError field="{{$name}}"/>
</div>
