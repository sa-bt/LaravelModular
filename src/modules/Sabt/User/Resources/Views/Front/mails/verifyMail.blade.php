@component('mail::message')
# کد فعال سازی حساب شما

این ایمیل بنا به درخواست شما برای عضویت در سایت {{ config('app.name') }} ارسال شده است.
در صورت تایید این موضوع کد فعال سازی را در صفحه مورد نظر وارد کنید

@component('mail::panel')
کد فعال سازی حساب شما: {{$code}}
@endcomponent

با تشکر،<br>
{{ config('app.name') }}
@endcomponent
