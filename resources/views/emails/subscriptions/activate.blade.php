@component('mail::message')
# Introduction

You have been asked to subscribe to recurring billing, please enter payment details to begin.

@component('mail::button', ['url' => url('/subscription-activate?customer_id='.$customer['id'].'&plan_id='.$plan['id'].'&amount='.$plan['amount'])])
Activate Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
