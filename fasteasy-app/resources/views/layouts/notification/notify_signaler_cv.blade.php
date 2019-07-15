@if(Auth::user()->statut == "admin")
    <p> </p>

    @php
        $user = \App\User::find($notification->data['Signalisation']['id_from'])
    @endphp
    <a class="dropdown-item" onclick="markAsRead('{{ $notification->id }}')" href="/CommentaireSignalerv/{{$notification->data['Signalisation']['id_to']}}">

    </a>

@endif
