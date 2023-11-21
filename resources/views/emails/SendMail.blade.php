@component('mail::message')

<h1 style="font-size:24px;">Good Day!</h1>   

<p style="font-size:22px;">
{{ $content['message'] }}.
</p>

<p style="text-align:center; color:black; font-size:32px;"><strong>{{ $content['code'] }}</strong></p>

@endcomponent
