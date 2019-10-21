@component('mail::message')
<strong>These are the domains you checked for availability</strong>

@foreach ($data as $response)
<hr>
<div>
    @if (isset($response['available']) and $response['available'])
    <h4>{{$response['domain']}} : {{$response['message']}}</h4> Price: <span class="h4">${{$response['price']}}</span>
    for the first year
    @else
    <h4>{{$response['domain']}}</h4>
    <h4>{{$response['message']}}</h4>
    @endif
</div>
@endforeach

@endcomponent