@component('mail::message')
# Register Camp

Hi, {{$checkout->User->name}}
<br>
Thank you for register on <b>{{$checkout->Camp->title}}</b>, please see payment instruction by click button below

@component('mail::button', ['url' => route('dashboard')]
Get Invoice
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
