
@extends('layouts/template')

@section('menu')
    @include('layouts.menuClient')
@endsection

@section('style')
    <style>
        .btn1{
            background-color: #ffc107;
            color: white;
        }
        .btn1:hover{
            color: #2a3342;
        }

    </style>
@endsection

@section('content')

    <?php
    $v=\App\Voiture::all();
    $ann= \App\Annonce::all()->where('history','=',0)->where('statut','=','disponible');//limiter le nombre d'annonce a 3 selon la date de creation
    $Par=\App\User::all();
    ?>
<div class="" style="background-color: #E2E1EB">
    @include('../welcome')
</div>


@endsection
