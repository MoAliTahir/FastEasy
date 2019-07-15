@extends('layouts.template')
@section('style')
    <style>
        .btn3{
            background-color: #ffc107;
            color: white;
        }
        .btn3:hover{
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

    <div style="margin-top: 130px; padding-top:20px;background-color: #E2E1EB; ">
    <div class="container" style="">
        <br>

  <a href="{{url('partenaire/formVoiture')}}">  <button class="btn btn-success">nouvelle voiture</button></a><br><br>

<div class="row">
        @forelse($voiture as $v)
        <?php    $voiture_images2 = \App\Photo::all()->where("id_voiture", "=",$v->id)->first();

        ?>

                    <div class="col-md-4 " style=" border-radius: 5%; margin-top: 15px;">
                        <div class="card shadow " style="width: 18rem; height: 400px;">
                            <img src="{{asset('storage/'.$voiture_images2->chemin)}}" class="card-img-bottom card zoom" style="border-radius: 5%;"  alt="">
                                <div class="card-body zoom colonne " style="width: 18rem; height: 250px;border-radius: 8%;">
                                    <h5 class="card-title text-dark">{{$v->marque ." ".$v->type}}</h5>
                                                <!--noura-->
                    {{--<img rel="icon" href="{{asset('storage/images/note.png') }}">--}}
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
        <p style="margin:5px 0px; font-size:16px; text-align:center">Moyenne <strong><?php echo substr($rate_value,0,3); ?></strong> sur <?php echo $rate_times; ?> evaluation(s)</p>
    </div>

                                    <div class="row" style="margin-top: 10px">
                                        <div class="col-md-4">
                                            <a href="{{url('partenaire/modifierVoiture/'.$v->id)}}" class="btn btn-primary btn-sm">Modifier</a>
                                        </div>
                                        <div class="col-md-4">
                                        <form action="{{url('partenaire/suppressionVoiture/'.$v->id)}}" method="post">
                                            <input type="hidden" name="_method" value="PUT">
                                                {{ csrf_field()}}
                                                <input type="hidden" name="history" value="1" >
                                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                        </div>
                                        <div class="col-md-4">
                                            <a  href="/consulterVoiture/{{$v->id}}" class="btn btn-success btn-sm">Consulter</a>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>

                    @empty

        <div class="col-md-12">
            <p class="h5">Vous n'avez creer aucune voiture.. creer une</p>
        </div>
                    @endforelse 
                </div>
        <br><br>


        
    </div>

    </div>
@endsection

