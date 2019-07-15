
@extends('layouts.template')
@section('titre')
    Acceuil
@endsection


@section('content')

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

    <br><br><br>
    <div class="container" style="margin-top: 80px">
        <center>
            <h3 style="margin-top: 30px;">Bienvenue sur <b>FastEasy</b></h3><br>

            <div class="col flex-center">
                <form class="form-inline shadow-none" method='post' action='/chercher' class="form-inline" >
                    {{csrf_field()}}
                    <label for="ville" class="mr-sm-2">Ville</label>
                    <select name="ville" class="form-control mr-sm-4" id="ville" required="required">
                        <option value="null">--</option>
                        <option value="Agadir">Agadir</option>
                        <option value="Casablanca">Casablanca</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Fes">Fes</option>
                        <option value="Sidi Kacem">Sidi kacem</option>
                        <option value="Sale">Sale</option>
                        <option value="Tetouan">Tetouan</option>
                        <option value="Tanger">Tanger</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Meknes">Meknes</option>
                        <option value="Essaouira ">Essaouira </option>
                        <option value="Dakhla">Dakhla</option>
                    </select>

                    <label for="marque" class="mr-sm-2">Marque</label>
                    <select name="marque" class="form-control mr-sm-4" id="marque" required="required">
                        <option value="null">--</option>
                        <option value="Audi">Audi</option>
                        <option value="Range">Range</option>
                        <option value="Mercedes">Mercedes</option>
                        <option value="Kia">Kia</option>
                        <option value="Dacia">Dacia</option>
                        <option value=" Volkswagen">   Volkswagen</option>

                        <option value="BM">BM</option>
                        <option value="Firari">Firari</option>
                    </select>

                    <label for="date" class="mr-sm-2">Date de disponibilite</label>

                    <input type="date" name="date_debut" class="form-control mr-sm-4" required="required">


                    <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" name="Rechercher">Rechercher</button>
                </form>
            </div>

        </center>
        <br><br><br>
        <div class="row" >
        @foreach ($ann as $an)
            <?php   $v=\App\Voiture::find($an->id_voiture) ?><!--selectionner les info de voiture a l'aide de cle etrangere qui est dans annonce -->
                <?php   $Par=\App\User::find($an->id_partenaire) ?>
                <?php    $voiture_images2 = \App\Photo::all()->where("id_voiture", "=",$an->id_voiture)->first();?>

                <div class="col-md-4  colonne " style="margin-bottom: 30px; " >
                    <div class="ard shadow" style="width: 18rem; height: 480px;border-radius: 5%;">

                        <img src="{{asset('storage/'.$voiture_images2->chemin)}}" class="card-img-bottom img-fluid" alt="" style="height: 200px;border-radius: 5%;">

                        {{--<div class="view overlay zoom">--}}
                        {{--<img src="{{asset('storage/'.$voiture_images2->chemin)}}" class=" card-img-bottom  img-fluid " alt="smaple image">--}}
                        {{--<div class="mask flex-center">--}}
                        {{--<p class="white-text">Zoom effect</p>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="card-body">
                            <h5 class="card-title text-dark">Annonceur : <a href="/whoComments/{{$an->id_partenaire}}">{{$Par->login}}</a></h5>
        <!--STAR-->

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
      <!--STAR-->

                            <div class="card-text" style="margin:20px">
                                <table class="h6">
                                    <h7 class="card-title text-dark">Ville <?= $an->ville?></h7>
                                    <h5 class="card-title text-dark"> <?= $v['marque']?> <?= $v['type']." "; ?> </h5>
                                    <tr class="text-danger"><td>Prix/Heure :</td><td>{{$an->prix}}</td></tr>
                                </table>
                            </div>
                            <a href="/consulterAnnonce/{{$an->id}}" class="btn btn-primary">Consulter</a>
                            <a href="/reserverAnnonce/{{$an->id}}" class="btn btn-success">Reserver</a>

                        </div>

                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection



