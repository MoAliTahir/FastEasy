@extends('layouts.template')
@section('style')
    <style>
        .btn4{
            background-color: #ffc107;
            color: white;
        }
        .btn4:hover{
            color: #2a3342;
        }

    </style>
@endsection
@section('menu')
    @include('layouts.menuClient')
@endsection
@section('content')
    <div class="container" style="height: 100%; margin-top: 150px;">
      <h2>LES COMMENTAIRES SUR LES VOITURES</h2>
        <table class="table">
            <tr>
                <th>Partenaire</th>
                <th>Voiture</th>
                <th>Contenu</th>
                <th>Date Commentaire</th>
            </tr>

        @foreach($comments1 as $comm1)
            <?php $voiture = \App\Voiture::find($comm1->id_to);
                  $partenaire=\App\User::find($voiture->id_partenaire);
            ?>

              <tr>

                  <td>
                      <a style="  text-decoration:none ; " href='/whoComments/{{$partenaire->id}}'>
                          <img border-radius="50%" width="20%" style=" width: 30px; height: 30px;"  src="{{asset('storage/'.$partenaire->chemin_image)}}">
                      </a>
                      <a style="color:blue;text-decoration:none" href="/whoComments/{{$partenaire->id}}">{{$partenaire->login}}</a>
                  </td>
                  <td><a href="">{{$voiture->marque}} {{$voiture->type}}</a></td>
                  <td>
                      <p>   <img  src="{{asset('storage/images/happy.png')}}" style="width: 20px; height: 20px;"><span>{{$comm1->avisPositive}}</span></p>
                      <p>   <img  src="{{asset('storage/images/sad.png')}}" style="width: 20px; height: 20px;"><span>{{$comm1->avisNegative}}</span></p>
                  </td>
                  <td>{{$comm1->created_at}}</td>
              </tr>

        @endforeach
        </table>
      <hr>
      <h2>LES COMMENTAIRES SUR LES PARTEANIRES</h2>
        <table class="table">
            <tr>
                <th>Partenaire</th>
                <th>Contenu</th>
                <th>Date Commentaire</th>
            </tr>

            @foreach($comments2 as $comm1)
                <?php
                      $partenaire=\App\User::find($comm1->id_to);
                ?>

                <tr>

                    <td>
                        <a style="  text-decoration:none ; " href='/whoComments/{{$partenaire->id}}'>
                            <img border-radius="50%" width="20%" style=" width: 30px; height: 30px;"  src="{{asset('storage/'.$partenaire->chemin_image)}}">
                        </a>
                        <a style="color:blue;text-decoration:none" href="/whoComments/{{$partenaire->id}}">{{$partenaire->login}}</a>
                    </td>

                    <td>
                        <p>   <img  src="{{asset('storage/images/happy.png')}}" style="width: 20px; height: 20px;"><span>{{$comm1->avisPositive}}</span></p>
                        <p>   <img  src="{{asset('storage/images/sad.png')}}" style="width: 20px; height: 20px;"><span>{{$comm1->avisNegative}}</span></p>
                    </td>
                    <td>{{$comm1->created_at}}</td>
                </tr>

            @endforeach
        </table>
    </div>
@endsection