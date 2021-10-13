@component('mail::message')
# کد بازیابی رمز عبور حساب شما

این ایمیل بنا به درخواست شما برای بازیابی حساب کاربری در سایت {{ config('app.name') }} ارسال شده است.
در صورت تایید این موضوع کد فعال سازی را در صفحه مورد نظر وارد کنید

@component('mail::panel')
کد بازیابی حساب شما: {{$code}}
@endcomponent

با تشکر،<br>
{{ config('app.name') }}
@endcomponent
