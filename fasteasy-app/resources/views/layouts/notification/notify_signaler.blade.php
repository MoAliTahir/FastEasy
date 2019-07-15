@if(Auth::user()->statut == "admin")
    @php
        $user = \App\User::find($notification->data['Signalisation']['id_from'])
    @endphp
    <a class="dropdown-item" onclick="markAsRead('{{ $notification->id }}')" href="/whoComments/{{$notification->data['Signalisation']['id_to']}}">
        Compte signalé par: <strong>{{ $user->login }}</strong>
    </a>
    <hr>
@endif
