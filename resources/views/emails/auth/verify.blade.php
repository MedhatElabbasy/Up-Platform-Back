@component('mail::message')
# تفعيل البريد الاإلكتروني

شكرا لتسجيلك.
الكود الخاص بك للتفعيل : {{$verificationCode}}

شكرا,<br>
{{ config('app.name') }}
@endcomponent
