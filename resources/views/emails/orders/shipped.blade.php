@component('mail::message')
# Introduction

bloood bank reset password

@component('mail::button', ['url' => ''])
Button Text
@endcomponent
<p>your reset password is {{$code}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
