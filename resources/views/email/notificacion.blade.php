@component('mail::message')
# Notificacion de Documentos Temporales

@component('mail::panel')
    {{$e_message}}
@endcomponent

@component('mail::button', ['url' => 'https://www.greendfield.com'])
Ver Intranet
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
