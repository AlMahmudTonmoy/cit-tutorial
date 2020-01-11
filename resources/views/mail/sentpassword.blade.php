
@component('mail::message')
# Your New Account Created Successfully at Boighor.com

Please check Login Details!

@component('mail::button', ['url' => "http://127.0.0.1:8000/login"])
Click Here To Login
@endcomponent

@component('mail::panel')
Your New Password is: {{ $g_pass }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
