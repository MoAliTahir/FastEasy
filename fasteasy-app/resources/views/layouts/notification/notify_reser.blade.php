@if(Auth::user()->statut == "partenaire")

    @php
        $client = \App\User::find($notification->data['reservation']['id_client']);
    @endphp


        @if($notification->data['url'] != null)
            <a onclick="markAsRead('{{ $notification->id }}')" class="dropdown-item" href="{{$notification->data['url']['val'].'/'.$notification->data['reservation']['id']}}">Veuillez evaluer le client <strong>{{ $client->login }}</strong></a>
        @else
            <a  class="dropdown-item" href="/whoComments/{{$notification->data['reservation']['id_client']}}">Demande de reservation: <strong>{{ $client->login }}</strong></a>
            <a class="dropdown-item" onclick="markAsRead('{{ $notification->id }}')" href="/confirmer/{{$notification->data['reservation']['id']}}/{{$notification->data['reservation']['id_annonce']}}" name="confimer">confirmer</a>
            <a  class="dropdown-item" onclick="markAsRead('{{ $notification->id }}')" href="/Annuler/{{$notification->data['reservation']['id']}}/{{$notification->data['reservation']['id_annonce']}}">Annuler</a>
        @endif
@endif
@if(Auth::user()->statut == "client")

    @php
        $annonce = \App\Annonce::find($notification->data['reservation']['id_annonce']);
        $partenaire = \App\User::find($annonce->id_partenaire);
    @endphp
    @if($notification->data['url'] != null)
        <a onclick="markAsRead('{{ $notification->id }}')" class="dropdown-item" href="{{$notification->data['url']['val'].'/'.$notification->data['reservation']['id']}}">Veuillez evaluer le partenaire <strong>{{ $partenaire->login }}</strong></a>
    @else
        <a href="/consulterAnnonce/{{$notification->data['reservation']['id_annonce']}}" class="dropdown-item" onclick="markAsRead('{{ $notification->id }}')">
            Felicitaion, votre reservation N°{{$notification->data['reservation']['id'] }} est confirmé
        </a>
    @endif
@endif

