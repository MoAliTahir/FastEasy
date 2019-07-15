
@extends('layouts/template')

@section('menu')
    @include('layouts.menuPartenaire')
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
$annonces = App\Annonce::all()->where('id_partenaire', Auth::user()->id)->where('history','=',0);

?>
@include('partenaire.mesAnnonces')

@endsection