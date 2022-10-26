<textarea placeholder="{{$placeholder}}" class="text h" name="{{$name}}" >{!! isset($value)? $value : old($name) !!}</textarea>
<x-ValidationError field="{{$name}}"/>
