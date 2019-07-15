@extends('layouts.template')
@section('style')
    <style>
        .btn3{
            background-color: #ffc107;
            color: white;
        }

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
<div style="margin-top: 150px; background-color:  #E2E1EB;height: 100%;">
<div class="container form-group">
<h3> Modifier profil </h3>

<form method="post" action="/updateclient" enctype="multipart/form-data">

    <input type="hidden" name="_method" value="PUT">

    {{csrf_field()}}
    <div class="row">
        <div class="col-md-3">
   <label> <b>loginn</b> </label><input type="text" class="form-control"  name="login" value="{{ $data->login }}"><br>
        </div>
        <div class="col-md-3">

                <label><b> Nom </b></label><input class="form-control" type="text" name="name" value="{{$data->name}}"> <br>
        </div>

        <div class="col-md-3">
                <label> <b>Cin</b></label><input class="form-control" type="text" name="cin" value ="{{ $data->cin }}"><br>
        </div>
        <div class="col-md-5"> <label><b>Tel</b></label><input name="tel"class="form-control" value="{{ $data->tel }}"><br></div>
        <div class="col-md-5"><label><b>Email</b></label><input type="email" class="form-control" name="email" value="{{ $data->email  }}"><br></div>
        <div class="col-md-6">
              <b><label>Changer votre photo</label><input type="file" class="form-control" name="imageurl"><br>
        <button name="enregistrer" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</form>
</div>
</div>
@stop
