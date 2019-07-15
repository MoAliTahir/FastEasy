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
        .btn7:hover{
            color: #2a3342;
        }

        .btn7{
            background-color: #ffc107;
            color: white;
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
    @if(\Illuminate\Support\Facades\Auth::user()->statut=='client')
        @include('layouts.menuClient')
    @elseif(\Illuminate\Support\Facades\Auth::user()->statut=='partenaire')
        @include('layouts.menuPartenaire')
    @elseif(\Illuminate\Support\Facades\Auth::user()->statut=='admin')
        @include('layouts.menuAdmin')
    @endif
@endsection

@section('content')
    <style>
        body {
            background:#fafcfd;
            margin-bottom: 0;
            padding-bottom: 0;
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

    </style>
    <div style="background-color: #E2E1EB; height: 100%;">
        <div class="container" style="margin-top: 100px; padding-top: 10px;">
            @if(\Illuminate\Support\Facades\Auth::user()->statut=='partenaire' || \Illuminate\Support\Facades\Auth::user()->statut=='client')
            <div class="row profile">
                <div class="col-md-3">
                    <div class="profile-sidebar"  style="background-color: white; margin-right: 20px; height: 100%; position: absolute;">
                        <!-- SIDEBAR USERPIC -->
                        <center>
                            <div class="profile-userpic">
                                <img src="{{asset('storage/'.$data->chemin_image)}}">
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <h5 style="color: #0b2e13; text-transform: uppercase; font-family: 'Baskerville Old Face'">{{$data->login}}</h5>
                                    <div class="profile-usertitle-job">
                                        <span style="font-size: 12px; font-weight: 600;color: #0b2e13;">{{$data->statut}}</span>
                                    </div>

                                    <center>
                                        <table>
                                            <tr><td style="font-size: 17px; font-weight: 600;"> Nom: </td><td STYLE="font-size: 21px; font-weight: 800 ;color: #1b4b72;">{{$data->name}}</td></tr>
                                            <tr><td style="font-size: 17px; font-weight: 600;">CIN: </td><td STYLE="font-size: 21px; font-weight: 800 ;color: #1b4b72;">{{$data->cin}}</td></tr>
                                            <tr><td style="font-size: 17px; font-weight: 600;">Tel:</td><td STYLE="font-size: 21px; font-weight: 800 ;color: #1b4b72;">{{$data->tel}}</td></tr>
                                            <tr><td style="font-size: 17px; font-weight: 600;">Email: </td><td STYLE="font-size: 21px; font-weight: 800 ;color: #1b4b72;">{{$data->email}}</td></tr>
                                        </table>
                                    </center>

                                </div>

                            </div>
                            <!--noura-->
                            @if(\Illuminate\Support\Facades\Auth::user()->statut!='admin')
                            <img rel="icon" href="{{asset('storage/images/notednndn.png') }}">
                            <div class="box-result">
                                <?php
                                $idClient=Auth::user()->id;

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
                            @endif
                            <div class="profile-userbuttons">
                                <a href="/modifier" class="btn btn-danger btn-md" >Modifier</a>
                            </div>
                    </div>
                    <!--noura-->
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->


                    </center>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->

                    <!-- END MENU -->
                </div>

                <div class="col-md-9" >
                    <div class="profile-content" style="background-color: #fff; margin-left: 20px; height: 100%; position: relative;">
                        <h3>les commentaires sur mon profill</h3>
                        <hr>
                        <?php $idUser=\Illuminate\Support\Facades\Auth::user()->id; ?>
                        @isset($reservations)
                            @foreach ($reservations as $resev)

                                <?php

                                $idResev=$resev->id;
                                $comments=\App\CommentaireUser::all()->where('id_reservation','=',$idResev)->where('history','=','0');    ?>
                                @if($comments->count()>1)
                                    @foreach($comments as $commentaire)
                                        @if($commentaire->id_to ==$idUser )
                                            <?php $who=\App\User::find($commentaire->id_from) ?>
                                            <a style="color:blue;float:right;text-decoration:none" href="/whoComments/{{$who->id}}">{{$who->login}}</a>
                                            <a style="  text-decoration:none ; " href='/whoComments/{{$who->id}}'>
                                                <img border-radius="50%" width="20%" style="float: right; width: 30px; height: 30px;"  src="{{asset('storage/'.$who->chemin_image)}}">
                                            </a>
                                            <p><img  src="{{asset('storage/images/happy.png')}}" style="width: 20px; height: 20px; margin-right: 5px;"><span style="font-weight: 700">{{$commentaire->avisPositive}}</span></p>
                                            <p><img  src="{{asset('storage/images/sad.png')}}" style="width: 20px; height: 20px;margin-right: 5px;"><span style="font-weight: 700">{{$commentaire->avisNegative}}</span></p>
                                            <hr>
                                        @endif
                                    @endforeach

                                @endif

                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="row profile" style="margin-left: 400px; margin-top: 50px;">
                <div class="col-md-6">

                        <!-- SIDEBAR USERPIC -->
                        <center>
                            <div class="profile-userpic" style="background-color: white;">
                                <img src="{{asset('storage/'.$data->chemin_image)}}">
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle" style="background-color: white; margin-top: 10px; height: 250px;">
                                <div class="profile-usertitle-name">
                                    <h5 style="color: #0b2e13; text-transform: uppercase; font-family: 'Baskerville Old Face'">{{$data->login}}</h5>
                                    <div class="profile-usertitle-job">
                                        <span style="font-size: 12px; font-weight: 600;color: #0b2e13;">{{$data->statut}}</span>
                                    </div>

                                    <center>
                                        <table>
                                            <tr><td style="font-size: 17px; font-weight: 600;"> Nom: </td><td STYLE="font-size: 21px; font-weight: 600 ;color: #1b4b72;">{{$data->name}}</td></tr>
                                            <tr><td style="font-size: 17px; font-weight: 600;">CIN: </td><td STYLE="font-size: 21px; font-weight: 600 ;color: #1b4b72;">{{$data->cin}}</td></tr>
                                            <tr><td style="font-size: 17px; font-weight: 600;">Tel:</td><td STYLE="font-size: 21px; font-weight: 600 ;color: #1b4b72;">{{$data->tel}}</td></tr>
                                            <tr><td style="font-size: 17px; font-weight: 600;">Email: </td><td STYLE="font-size: 21px; font-weight: 600 ;color: #1b4b72;">{{$data->email}}</td></tr>
                                        </table>
                                    </center>

                                </div><br>
                                <div class="profile-userbuttons">
                                    <a href="/modifier" class="btn btn-danger btn-md" >Modifier</a>
                                </div>
                            </div>



                    </center>
                    <!-- END SIDEBAR BUTTONS -->
                    <!-- SIDEBAR MENU -->

                    <!-- END MENU -->
                </div>

        @endif
    </div>
    </div>
@endsection

