@component('mail::message')
# Welcom to Key In Click Store ..

your desire is available in our store , you can check it .

@component('mail::button', ['url' => 'https::/codewithdary.com'])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
