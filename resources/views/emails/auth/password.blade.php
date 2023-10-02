@component('mail::message')
# إعادة تعيين كلمة السر

الكود الخاص بك : <h4>{{$verificationCode}}</h4>

شكرا,<br>
{{ config('app.name') }}
@endcomponent
