@if(session()->has('feedback'))
    @foreach(session()->get('feedback') as $feedback)
        Toast.fire({
        icon: '{{$feedback['type']}}',
        title: '{{$feedback['message']}}'
        })
    @endforeach
@endif
