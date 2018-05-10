@component('mail::message')
# Introduction

You have a new message
<br>
Name: {{$name}}
<br>
Email: {{$email}}
<br>
Message: {{$message}}

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
