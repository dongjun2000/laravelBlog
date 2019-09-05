@component('mail::message')
# 感谢您注册成为《{{config('app.name')}}》用户

您需要验证注册时填写的此邮箱激活该账号。

点击以下按钮完成验证：

@component('mail::button', ['url' => route('confirmEmailToken', $user['email_token'])])
    点击验证
@endcomponent

或者点击以下链接：

{{ route('confirmEmailToken', $user['email_token']) }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
