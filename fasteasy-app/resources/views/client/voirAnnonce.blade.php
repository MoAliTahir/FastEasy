@extends('layouts.template')
@section('style')
    <style>
        .btn3{
            background-color: #ffc107;
            color: white;
        }

    </style>
@endsection
@section('menu')
    @include('layouts.menuClient')
@endsection
@section('content')
<div class="container" style="padding-top: 200px">
          {{--<p>date Annonce : {{$annonce->created_at}}</p>--}}
          {{--<p>date debut:{{$annonce->date_debut}}</p>--}}
          {{--<p>heure Fin:{{$annonce->heureFin}}</p>--}}
          {{--<p>heure debut:{{$annonce->heureDebut}}</p>--}}
          {{--<p>heure Fin:{{$annonce->heureFin}}</p>--}}
          {{--<p>prix : {{$annonce->prix}}</p>--}}
             {{--<h2>Les infos sur la voiture</h2>--}}
          {{--<p>TYPE{{$voiture->type}}</p>--}}
          {{--<p>MARQUE{{$voiture->marque}}</p>--}}
          {{--<p>MODELE{{$voiture->modele}}</p>--}}
             {{--<h2>Le partenaire</h2>--}}
          {{--<p><a href="/whoComments/{{$partenaire->id}}">{{$partenaire->login}}</a></p>--}}
    {{----}}

          <div class="col-md-4">
              <div class="card" style="width: 18rem;">
                <?php  use App\Photo;
                $voiture_images2 =Photo::all()->where("id_voiture", "=",$an->id_voiture)->first(); ?>

                  <img src="{{asset('storage/'.$voiture_images2->chemin)}}" class="card-img-bottom" alt="">
                  <div class="card-body">
                      <h5 class="card-title text-dark"> <?= $v['marque']?> <?= $v['type']." "; ?> </h5>
                      <div class="card-text" style="margin:20px">
                          <table class="h6">
                              <tr><td>Date de retrait :</td><td>{{$an->date_debut}}</td></tr>
                              <tr><td>Heure de retrait :</td><td>{{$an->heureDebut}}</td></tr>
                              <tr><td>Date de retour :</td><td>{{$an->date_fin}}</td></tr>
                              <tr><td>Heure de retour :</td><td>{{$an->heureFin}}</td></tr>
                              <tr class="text-danger"><td>Prix/heure :</td><td>{{$an->prix}}</td></tr>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
    <br><br><br>

</div>

@stop
