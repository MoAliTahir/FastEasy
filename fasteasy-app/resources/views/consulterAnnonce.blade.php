@extends('layouts.template')
@section('titre')
  Consulter Annonce
    @endsection
  @isset(Auth::user()->statut)

@if (Auth::user()->statut === "admin")
@section('menu')
    @include('layouts.menuClient')
@endsection
@elseif (Auth::user()->statut === "partenaire")
@section('menu')
    @include('layouts.menuPartenaire')
@endsection
@else
@section('menu')
    @include('layouts.menuClient')
@endsection
@endif

  @endisset

@section('content')
       <div style="background-color: #E2E1EB; margin-top: -10px;">
@isset(Auth::user()->statut)
    <div class="container" style="margin-top: 150px; width: 80%; ">
@endisset

@section('style')
<style>
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
<center>
<div id="carouselExampleIndicators" class="carousel slide"  data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style=" margin-top: 100px;">
                <div class="carousel-item active">
                        <img class="d-block " height="350px"  width="500px" src="{{asset('storage/'.$voiture_images2->chemin)}}" alt="First slide">
                </div>
                <?php  $table=array();
                        $i=0;
                foreach ($voiture_images as $image){
                    $table[$i++]=$image;
                    } ?>



              @for ($j=1; $j < sizeof($table); $j++)
              <div class="carousel-item">
              <img class="d-block"  height="350px"  width="500px" src="{{asset('storage/'.$table[$j]->chemin)}}" alt="First slide">
              </div>
              @endfor

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" >
          <span class="carousel-control-prev-icon" aria-hidden="false" style="background-color:#2a3342;"></span>
          <span class="sr-only" style="">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon"  aria-hidden="false" style="background-color: #2a3342;"></span>
          <span class="sr-only">Next</span>
        </a>

    </div>
        <h3 style="font-size: 30px ;margin-top: 10px;">{{$v->marque}}  {{$v->type}}</h3>
        <img rel="icon" href="{{asset('storage/images/note.png') }}">
         <div class="box-result">
            <?php
            $idClient=$v->id;

            $query= App\CommentaireVoiture::all()->where('id_to','=',$idClient);
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
              <p style="margin:5px 0px; font-size:16px; text-align:center">Moyenne <strong><?php echo substr($rate_value,0,3); ?></strong> sur <?php echo $rate_times; ?> evaluation(s)</p>
          </div>

<a href="{{route('reserver',$an1->id )}}" class="btn btn-primary" style="">Reserver</a>
</center>
    <div  style=" padding:5%" >
<div class="row">
        <div style="background-color: white; padding:2%" class="col-md-6 shadow bb"  >
            <p style="color: #2a3342 ">  PROPRIÉTAIRE </p>

            <div> <a style="  text-decoration:none ; " href='/whoComments/{{$P->id}}'>
                        <img style="border-radius:50%; width:6%;"  src="{{asset('storage/'.$P->chemin_image)}}">
                    </a>
            <a style="  text-decoration:none" href='/whoComments/{{$P->id}}'>
                        <strong style="font-size: 15px;">{{$P->login}}</strong>
                    </a>
                      <!--noura-->
                      <img rel="icon" href="{{asset('storage/images/notednndn.png') }}">
                      <div class="box-result">
                      <?php
                      $idClient=$P->id;
                      $sum_rates = array();
                      $query= App\CommentaireUser::all()->where('id_to','=',$idClient);
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
                        <p style="margin:5px 0px; font-size:16px; text-align:center">Moyenne : <strong><?php echo substr($rate_value,0,3); ?></strong> sur <?php echo $rate_times; ?> evaluation(s)</p>
                    </div>

                </div>
                  <!--noura-->
                </div>
        </div></div>
        <br>

            <div class="row">
                <div class="col-md-5 shadow bb" style="background:white">
                    <p style="color: #2a3342"><h5>INFORMATIONS SUR L'ANNONCE</h5></p>
                    <p><span style="font-size: 20px "> Date de Debut:</span> <span style="font-size: 18px; color: #1b4b72 ; ">{{$an1->date_debut}}</span></p>
                    <p><span style="font-size: 20px"> Heure de Debut:</span> <span style="font-size: 18px; color: #1b4b72 ;">{{$an1->heureDebut}}</span></p>
                    <p ><span style="font-size: 20px "> Date de Fin: </span><span style="font-size: 18px; color: #1b4b72 ; "> {{$an1->date_fin}}</span></p>
                    <p> <span style="font-size: 20px">Heure de Fin: </span><span style="font-size: 18px; color: #1b4b72 ;">{{$an1->heureFin}}</span></p>
                    <p><span style="font-size: 20px ">Prix/Jour:</span> <span style="font-size: 18px; color: #1b4b72 ;">{{$an1->prix}} Dhs</span></p>
                </div>

            <div class="col-md-5 shadow bb" style="background:white; margin-left:100px;">
                <p style="color: #2a3342;"><h5>CARACTÉRISTIQUES TECHNIQUES</h5></p>
                 <p><span style="font-size: 20px ; ">Marque:</span><span style="font-size: 18px; color: #1b4b72 ; ">{{$v->marque}}</span></p>
                <p><span style="font-size: 20px ; ">Type:</span> <span style="font-size: 18px; color: #1b4b72 ;">{{$v->type}}</span></p>
                 <p><span style="font-size: 20px ; ">Carburant:</span> <span style="font-size: 18px; color: #1b4b72 ;">{{$v->carburant}}</span></p>
                <p><span style="font-size: 20px ;">Nombre de places:</span> <span style="font-size: 18px; color: #1b4b72 ; ">{{$v->nbr_places}}</span></p>
            </div>

        </div><br>


        <div class="row shadow" style="background-color: white;">
            <div class="col-md-10 " style=" margin-top:10px;">
                <h3>Commentaires sur la voiture</h3>
                <p style="color:#5a7391">{{$comment->count()}} commentaires</p>
                <hr>
                @foreach($comment as $commentaire)
                    <?php $who=\App\User::find($commentaire->id_from) ?>
                        <a style="color:blue;float:right;text-decoration:none" href="/whoComments/{{$who->id}}">{{$who->login}}</a>
                        <a style="  text-decoration:none ; " href='/whoComments/{{$P->id}}'>
                                    <img border-radius="50%" width="20%" style="float: right; width: 30px; height: 30px;"  src="{{asset('storage/'.$P->chemin_image)}}">
                                </a>

                    <p>   <img  src="{{asset('storage/images/happy.png')}}" style="margin-right: 5px;width: 20px; height: 20px;"><span style="font-weight: 700">{{$commentaire->avisPositive}}</span></p>
                        <p>   <img  src="{{asset('storage/images/sad.png')}}" style="margin-right: 5px;width: 20px; height: 20px;"><span style="font-weight: 700">{{$commentaire->avisNegative}}</span></p>
                    <p>note:<span>{{$commentaire->note}}</span></p>
                    <hr>
                @endforeach
            </div>
        </div>
        </div>

   </div>

       </div>
@endsection
@section('style')
            <style>
                .bb :hover{
                    box-shadow: 3px black;
                    cursor: pointer;

                }
            </style>
@endsection
