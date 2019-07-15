@extends('layouts.template')
@section('style')
    <style>
        .btn2{
            background-color: #ffc107;
            color: white;
        }
        .btn2:hover{
            color: #2a3342;
        }
        </style>
@endsection
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
              <div style="background-color:  #E2E1EB;margin-top: 130px; padding-top: 30px;">
    @isset(Auth::user()->statut)
        <div class="container" style="  ">
            @endisset

            <div id="carouselExampleIndicators" class="carousel slide"  data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" style="margin-left: 350px; margin-top: 50px;">
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
            <h3 style="font-size: 30px ; font-weight: 800; margin-top: 10px;"><center>{{$v->marque}}  {{$v->type}}</center></h3>

                          {{--******RATING****--}}
            <div class="box-result">
                <?php
                $idClient=\Illuminate\Support\Facades\Auth::user()->id;

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
                <p style="margin:5px 0px; font-size:16px; text-align:center">Rated <strong><?php echo substr($rate_value,0,3); ?></strong> out of <?php echo $rate_times; ?> Review(s)</p>
            </div>



            </center>

            <div style="margin:50px;" >


                <div class="row">

                    <div class="col-md-5 shadow bb" style="background:white; ">
                        <p style="color: #2a3342; font-weight: 800;"><h5>CARACTÉRISTIQUES TECHNIQUES</h5></p>
                        <p><span style="font-size: 20px ; font-weight: 500">Marque:</span><span style="font-size: 21px; color: #1b4b72 ; font-weight: 800">{{$v->marque}}</span></p>
                        <p><span style="font-size: 20px ; font-weight: 500">Type:</span> <span style="font-size: 21px; color: #1b4b72 ; font-weight: 800">{{$v->type}}</span></p>
                        <p><span style="font-size: 20px ; font-weight: 500">Carburant:</span> <span style="font-size: 21px; color: #1b4b72 ; font-weight: 800">{{$v->carburant}}</span></p>
                        <p><span style="font-size: 20px ; font-weight: 500">Nombre de places:</span> <span style="font-size: 21px; color: #1b4b72 ; font-weight: 800">{{$v->nbr_places}}</span></p>
                    </div>

                </div>
                <br>

                <div class="row shadow" style="background-color: white;">
                    <div class="col-md-10 " style=" margin-top:10px;">
                        <h3>Commentaires sur la voiture</h3>
                        <p style="color:#5a7391">{{$comment->count()}} commentaires</p>
                        <hr>
                        @foreach($comment as $commentaire)
                            <?php $who=\App\User::find($commentaire->id_from) ?>
                            <a style="color:blue;float:right;text-decoration:none" href="/whoComments/{{$who->id}}">{{$who->login}}</a>
                            <a style="  text-decoration:none ; " href='/whoComments/{{$who->id}}'>
                                <img border-radius="50%" width="20%" style="float: right; width: 30px; height: 30px;"  src="{{asset('storage/'.$who->chemin_image)}}">
                            </a>

                            <p>   <img  src="{{asset('storage/images/happy.png')}}" style="width: 20px; height: 20px;"><span>{{$commentaire->avisPositive}}</span></p>
                            <p>   <img  src="{{asset('storage/images/sad.png')}}" style="width: 20px; height: 20px;"><span>{{$commentaire->avisNegative}}</span></p>
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
