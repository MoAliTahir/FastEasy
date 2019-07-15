@extends('layouts.template')
@section('style')
    <style>
        body{
            background-color:#E2E1EB ;
        }
        .btn1{
            background-color: #ffc107;
            color: white;
        }
        .btn1:hover{
            color: #2a3342;
        }
          /* style star*/

.clear{clear: both;}

.rate{
  width:225px; height: 40px;
  border:#e9e9e9 1px solid;
  background-color:  #f6f6f6;
  margin:60px auto;
  margin-bottom:0px;
}
.rate .rate-btn{
  width: 45px; height:40px;
  float: left;
  background: url("{{asset('storage/images/rate-btn.png')}}") no-repeat;
  cursor: pointer;
}
.rate .rate-btn:hover, .rate  .rate-btn-hover, .rate  .rate-btn-active{
  background: url("{{asset('storage/images/rate-btn-hover.png')}}") no-repeat;
}

.result-container{
  width: 82px; height: 18px;
  position: relative;
  background-color: #ccc;
  border: #ccc 1px solid;
  margin:auto;
}
.rate-stars{
  width: 82px; height: 18px;
  background-color:#ccc;
  background: url("{{asset('storage/images/rate-stars.png')}}") no-repeat;
  position: absolute;
}
.rate-bg{
  height: 18px;
  background-color: #ffbe10;
  position: absolute;
}
/*fin style*/

    </style>
@endsection
@section('menu')
    @include('layouts.menuPartenaire')
@endsection
@section('content')
      <div style="background-color: #E2E1EB;">
    <div class="container" style="margin-top: 135px; padding-top:20px;background-color:  #E2E1EB;  width: 100%;">

        <?php

        if (isset($message)):
        ?>
        <script>
            alert('{{ $message }}')
        </script>

            <?php
            endif;
            ?>
      <a href="{{Route('nouvelAnnonce')}}"><button class="btn btn-success" >creer une annonce</button></a>
    <br>
    <br>
        <div class="row" style="background-color:  #E2E1EB; ">
        @forelse($annonces as $an)
                <?php 	$v=\App\Voiture::find($an->id_voiture) ?><!--selectionner les info de voiture a l'aide de cle etrangere qui est dans annonce -->
                <?php    $voiture_images2 = \App\Photo::all()->where("id_voiture", "=",$an->id_voiture)->first();?>

                <div class="col-md-4" style="width:450px;
    position:relative;
    overflow: hidden;">
                        <div class="card shadow" style="width: 22rem; margin-bottom:50px; height: 480px; border-radius: 5%;">
                                {{--<div  style="background: url('{{asset('storage/'.$voiture_images2->chemin)}}'); height: 100px; ">--}}
                                {{--<div style="width: 50px;height: 50px;background: red;border-radius: 30px / 50px;">Reserved</div>--}}
                                {{--</div>--}}

                            <img style="height: 180px;" src="{{asset('storage/'.$voiture_images2->chemin)}}" class="card-img-bottom" alt="">
                                <div class="card-body">
                                @if($an->statut=='reservé')
        <div style="background-color:#fbb100;
    width:200px;
    height:200px;
    position:absolute;
    top:-100px;
    right:-100px;
    -webkit-transform:rotate(45deg);"></div>
        <div style="color:#FFF;
    -webkit-transform:rotate(45deg);
    font-size:20px;
    position:absolute;
    top:35px;
    right:15px;">Reserver</div>
    @endif
                                    <h5 class="card-title text-dark"> <?= $v['marque']?> <?= $v['type']." "; ?> </h5>
                      
                                    <div class="card-text" style="margin:20px">
                                        <table class="h6">
                                            <tr><td>Date de retrait :</td><td>{{$an->date_debut}}</td></tr>
                                              <!--noura-->
                    <img rel="icon" href="{{asset('storage/images/note.png') }}">
      <div class="box-result">
      <?php
      $idClient=$v->id;

      $query= App\CommentaireVoiture::all()->where('id_to','=',$idClient);

          $sum_rates = [];
            foreach($query  as $data)
            {
             $rate_db[] = $data;
             $sum_rates[] = $data->note;

            }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
        ?>
    <div class="result-container">
      <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
        <div class="rate-stars"></div>
    </div>
        <p style="margin:5px 0px; font-size:16px; text-align:center">Rated <strong><?php echo substr($rate_value,0,3); ?></strong> out of <?php echo $rate_times; ?> Review(s)</p>
    </div>
                                            <tr><td>Heure de retrait :</td><td>{{$an->heureDebut}}</td></tr>
                                            <tr><td>Date de retour :</td><td>{{$an->date_fin}}</td></tr>
                                            <tr><td>Heure de retour :</td><td>{{$an->heureFin}}</td></tr>
                                            <tr class="text-danger"><td>Prix/heure :</td><td>{{$an->prix}}</td></tr>
                                        </table>
                                    </div>

                                    @if($an->statut === "reservé")

                                        <div class="row">
                                            <div class="col-6">
                                                <a href="#" class="btn btn-secondary">Modifier</a>
                                                {{--@if($an->statut='reservé')--}}
                                                {{--<div style="width: 100px;height: 50px;background: red;border-radius: 30px / 50px;">Reserved</div>--}}
                                                {{--@endif--}}
                                            </div>
                                            <div class="col-6">

                                                    <a href="#" class="btn btn-secondary ">Supprimer</a>

                                            </div>
                                        </div>

                                    @else


                                        <div class="row">
                                            <div class="col-6">
                                                <a href="{{url('partenaire/modifierAnnonce/'.$an->id)}}" class="btn btn-primary">Modifier</a>
                                                {{--@if($an->statut='reservé')--}}
                                                {{--<div style="width: 100px;height: 50px;background: red;border-radius: 30px / 50px;">Reserved</div>--}}
                                                {{--@endif--}}
                                            </div>
                                            <div class="col-6">
                                            <form action="{{url('partenaire/suppressionAnnonce/'.$an->id)}}" method="post">
                                                <input type="hidden" name="_method" value="PUT">
                                                    {{ csrf_field()}}
                                                    <input type="hidden" name="history" value="1">
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>

                                            </div>
                                        </div>

                                    @endif

                                </div>
                        </div>
                    </div>
                    @empty

                    <div class="col-md-12">
                        <p class="h5">Vous n'avez creer aucune annonces.. creer une</p><br><br><br><br><br><br>
                    </div>

            @endforelse
                </div>

    </div>
      </div>

@endsection
