
@extends('layouts/template')

@section('menu')
    @include('layouts.menuAdmin')
@endsection

@section('content')
    <div STYLE="background-color: #E2E1EB; margin-top: 120px;height: 100%; ">
        <div class="container">
            <h1 style="font-size: 70px; padding-top: 200px;padding-left: 100px; background-color: white;border-radius: 10px;" class="shadow" >ESPACE ADMINISTRATEUR</h1>
        </div>
    </div>

@endsection
@section('footer')
    @include('layouts.footer2')
@stop



