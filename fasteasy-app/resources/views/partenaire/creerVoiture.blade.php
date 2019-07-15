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
    @include('layouts.menuPartenaire')
@endsection
  @section('content')
      <div class="container" style="padding-top: 180px; background-color: #E2E1EB ;">
          <div class=" form-group">
              <form action="{{url('partenaire/createVoiture')}}" method="post"  enctype="multipart/form-data" class="form-group">
                  {{ csrf_field() }}
                  <div class="row">

                      <input type="hidden" name="id" value="{{Auth::user()->id}}">
                      <div class="col-md-3">
                          <label  style="font-weight: 800;">Type</label>

                          <select name="type" class="form-control">
                              <option value="Coupé">Coupe</option>
                              <option value="Familiale">Familiale</option>
                              <option value="Cabriolet">Cabriolet</option>
                              <option value="Pickup">Pickup</option>
                          </select>
                      </div>
                      <br>
                      <div class="col-md-4">
                          <label  style="font-weight: 800;">Marque</label>
                          <select name="marque" class="form-control">
                              <option value="--" selected="selected">--</option>
                              <option value="Range">Range</option>
                              <option value="Mercedes">Mercedes</option>
                              <option value="Kia">Kia</option>
                              <option value="Dacia">Dacia</option>
                              <option value="BM">BM</option>
                              <option value="Volkswagen">Volkswagen</option>
                              <option value="Firari">Firari</option>
                              <option value="Renault">Renault</option>
                              <option value="Audi">Audi</option>
                          </select><br></div>
                      <div class="col-md-3">
                          <label  style="font-weight: 800;">Nombre de places</label>
                          <select name="nbr_places" class="form-control">
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                          </select></div>
                      <br>
                      <div class="col-md-4">
                          <label  style="font-weight: 800;">Carburant</label>
                          <select name="carburant" class="form-control">
                              <option value="Diesel">Diesel</option>
                              <option value="Essence">Essence</option>
                              <option value="Électrique">Électrique</option>
                              <option value="Hybride">Hybride</option>
                          </select> </div>
                      <br>
                      <div class="col-md-6">
                          <label  style="font-weight: 800;">Choisir une image</label>
                          <input type="file" name="image[]" class="form-control" multiple>
                          <br>
                      </div>
                      <div class="col-md-4">
                          <input type="submit" value="Créer" class="btn btn-primary">
                      </div>
                  </div>
              </form>

          </div>

              <br><br>
      </div>
@endsection
