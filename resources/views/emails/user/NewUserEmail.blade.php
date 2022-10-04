@component('mail::message')
    #Olá,
    Foi criado o seu usuário com os seguintes dados:
    @component('mail::table')
        |Nome                | Email                |
        |:-------------------|---------------------:|
        |{{ $user['name'] }} | {{ $user['email'] }} |
    @endcomponent
    A partir deste momento é possivel utilizar as APIs do nosso sitema.
    @component('mail::button', ['url' => '', 'color' => 'error'])
        Nossa API
    @endcomponent

    Seja bem vindo,<br>
    {{ config('app.name') }}
@endcomponent
