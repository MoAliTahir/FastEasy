@extends('layouts.template')
@section('style')

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
<div style="background-color:  #E2E1EB; height: 100%; margin-top: 135px; padding-top: 30px;">
<div class="container form-group">

    <h2 style="margin-left: 100px;">Modifier Profil</h2><br>
<form method="post" action="/update" enctype="multipart/form-data" style="margin-left: 100px;">

    <input type="hidden" name="_method" value="PUT">

    {{csrf_field()}}
    <div class="row">
        <div class="col-md-3">
   <label style="font-weight: 800;"> <b>login</b> </label><input type="text" class="form-control"  name="login" value="{{ $data->login }}"><br>
        </div>
        <div class="col-md-3">

                <label style="font-weight: 800;"><b> Nom </b></label><input class="form-control" type="text" name="name" value="{{$data->name}}"> <br>
        </div>

        <div class="col-md-3">
                <label style="font-weight: 800;"> <b>Cin</b></label><input class="form-control" type="text" name="cin" value ="{{ $data->cin }}"><br>
        </div>
        <div class="col-md-5"> <label style="font-weight: 800;"><b>Tel</b></label><input name="tel"class="form-control" value="{{ $data->tel }}"><br></div>
        <div class="col-md-5"><label style="font-weight: 800;"><b>Email</b></label><input type="email" class="form-control" name="email" value="{{ $data->email  }}"><br></div>
        <div class="col-md-6">
              <b><label style="font-weight: 800;">Changer votre photo</label><input type="file" class="form-control" name="imageurl"><br>
        <button name="enregistrer" class="btn btn-primary">Enregistrer</button>
        </div>
    </div>
</form>
</div>

</div>
@stop
