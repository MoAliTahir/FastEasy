@if(Auth::user()->statut == "admin")

    @php
        $user = \App\User::find($notification->data['Signalisation']['id_from'])
    @endphp
    <a class="dropdown-item" onclick="markAsRead('{{ $notification->id }}')" href="/CommentaireSignaler/{{$notification->data['Signalisation']['id_to']}}">
        Commentaire signalé par: <strong>{{$user->login}}</strong>
    </a>
    <hr>

@endif
