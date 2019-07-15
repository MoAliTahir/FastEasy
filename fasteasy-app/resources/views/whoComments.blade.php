@extends('layouts.template')
@section('style')
    <style>
        .btn3{
            background-color: #ffc107;
            color: white;
        }


        body {
            background:#fafcfd;
        }
        .profile {
            margin: 20px 0;
        }
        .profile-sidebar {
            margin-top: 50px;
            height: 480px;
            width: 280px;
            padding: 20px 0 10px 0;
            background:lavender;
        }

        .profile-userpic img {
            float: none;
            margin: 0;
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }

        .profile-usertitle {
            text-align: center;
            margin-top: 20px;
        }

        .profile-usertitle-name {
            color: #5a7391;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .profile-usertitle-job {
            text-transform: uppercase;
            color: #5b9bd1;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }


        /* Profile Content */
        .profile-content {
            margin-top: 50px;
            text-align: left;
            padding: 20px;
            background:lavender;
            min-height: 480px;
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

    @if(\Illuminate\Support\Facades\Auth::check())

        @if(\Illuminate\Support\Facades\Auth::user()->statut=='client')
            @include('layouts.menuClient')
        @elseif(\Illuminate\Support\Facades\Auth::user()->statut=='partenaire')
            @include('layouts.menuPartenaire')
        @elseif(\Illuminate\Support\Facades\Auth::user()->statut=='admin')
            @include('layouts.menuAdmin')
        @endif
    @endif
@endsection

@section('content')
  <div style="background-color: #E2E1EB;">
<div class="container" style="margin-top: 120px;">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar" style="">
                    <!-- SIDEBAR USERPIC -->
                    <center>
                        <div class="profile-userpic">
                            <img src="{{asset('storage/'.$partennaire->chemin_image)}}">
                        </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                   <h6>{{$partennaire->login}}</h6>
                                    <div class="profile-usertitle-job">
                                            {{$partennaire->statut}}

                                          <!--noura-->
                                          <img rel="icon" href="{{asset('storage/images/note.png') }}">
                                                <div class="box-result">
                                                    <?php
                                                    $idClient=$partennaire->id;

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
                                                    <p style="margin:5px 0px; font-size:16px; text-align:center">Rated <strong><?php echo substr($rate_value,0,3); ?></strong> out of <?php echo $rate_times; ?> Review(s)</p>
                                                </div>
                                              
                                    </div>
                                <!--noura-->


                                        @if(Auth::check())
                                            @if(Auth::user()->statut=='client' || Auth::user()->statut=='partenaire' )

                                                <br><a href="/Signaler/{{$partennaire->id}}" class="btn btn-danger" >Signaler</a>
                                            @endif
                                            @if(Auth::user()->statut=='admin')
                                                    <br> <a href="/bloquer/{{$partennaire->id}}" class="btn btn-danger" >bloquer</a>

                                            @endif
                                         @endif

                                    </div>

                            </div>
                        </div>
                    </center>
            </div>
      
            <div class="col-md-9">
                <div class="profile-content">
                        <h3>les commentaires sur mon profil</h3>
                        <p style="color:#5a7391">{{$comments->count()}} commentaires</p>
                        <hr>
                        @foreach($comments as $commentaire)

                            <?php $who=\App\User::find($commentaire->id_from) ?>
                    <a style="color:blue;float:right;text-decoration:none" href="/whoComments/{{$who->id}}">{{$who->login}}</a>
                                <p><span>Avis Positif:</span>{{$commentaire->avisPositive}}</p>
                                <p><span>Avis Negatif:</span>{{$commentaire->avisNegative}}</p>

                                <!--noura-->
                   <p> <img rel="icon" href="{{asset('storage/images/note.png') }}"></p>
      <div class="box-result">
      <?php
      $idClient=$partennaire->id;

      $query= App\CommentaireUser::all()->where('id_to','=',$idClient);
            foreach($query  as $data)
            {
             $rate_db[] = $data;

            }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $rate_value = $commentaire->note;
                    
                    $rate_bg = (($rate_value)/5)*100;
                }
                else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg=0;
                }
        ?>
    <div class="result-container">
      <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
        <div class="rate-stars"></div>
    </div>
        <p style="margin:5px 0px; font-size:16px; text-align:center">Note <strong><?php echo substr($rate_value,0,3); ?></strong> </p>
    </div>
                                @if(Auth::check())
                                    @if(Auth::user()->statut=='client' || Auth::user()->statut=='partenaire' )

                                        <a href="/SignalerCommentaire/{{$commentaire->id}}" class="btn btn-danger btn-sm" >Signaler</a>
                                    @endif

                                    @if(Auth::user()->statut=='admin')

                                        <br> <a href="/SupprimerCommentaire/{{$commentaire->id}}" class="btn btn-danger" >Supprimer</a>
                                     @endif
                                @endif
                    <hr>

                        @endforeach
                </div>
            </div>
        </div>

    @if(Auth::check())

        @if(Auth::user()->statut == 'admin')

            <div class="row">
                <div class="col-12">
                    <h3>les commentaires sur les autres profils</h3>
                    <p style="color:#5a7391">{{$comments->count()}} commentaires</p>
                    <hr>
                    @php
                        $comm = App\CommentaireUser::all()->where('id_from', '=', $partennaire->id);
                    @endphp
                    @foreach($comm as $commentaire)

                        <?php $who=\App\User::find($commentaire->id_to) ?>
                            <a style="color:blue;float:right;text-decoration:none;font-size: 20px;" href="/whoComments/{{$who->id}}">{{$who->login}}</a>
                            <a style="  text-decoration:none ; " href='/whoComments/{{$who->id}}'>
                                <img border-radius="50%" width="20%" style="float: right; width: 30px; height: 30px;"  src="{{asset('storage/'.$who->chemin_image)}}">
                            </a>
                            <p><img  src="{{asset('storage/images/happy.png')}}" style="width: 20px; height: 20px; margin-right: 5px;"><span style="font-weight: 700">{{$commentaire->avisPositive}}</span></p>
                            <p><img  src="{{asset('storage/images/sad.png')}}" style="width: 20px; height: 20px;margin-right: 5px;"><span style="font-weight: 700">{{$commentaire->avisNegative}}</span></p>
                        <p>note:<span>{{$commentaire->note}}</span></p>
                            @if(Auth::check())
                                @if(Auth::user()->statut=='client' || Auth::user()->statut=='partenaire' )

                                    <a href="/SignalerCommentaire/{{$commentaire->id}}" class="btn btn-danger" >Signaler</a>
                                @endif

                            @endif
                        <hr>

                    @endforeach
                </div>
            </div>

        @endif

    @endif
</div>

</div>
  </div>
@endsection
