<x-mail::message>
# One more step before joining Laracasts!

You need to confirm your email
<x-mail::button url="{{route('confirm-email').'?token='.$user->confirm_token}}">
Confrim Email
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
