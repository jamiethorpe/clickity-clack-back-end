@component('mail::message')
# Hello!

It looks like you're having some trouble logging into your account. Use the button below to reset your password.

If you did not request a password reset, please ignore this email.

@component('mail::button', ['url' => $passwordReset->getLink()])
    Reset Password
@endcomponent

Thanks,<br>
The {{ config('app.name') }} Team
@endcomponent
