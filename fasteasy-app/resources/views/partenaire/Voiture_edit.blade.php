@extends('layouts.template')
@section('menu')
    @include('layouts.menuPartenaire')
@endsection
@section('content')
    <div style="margin-top: 130px; padding-top:20px;background-color: #E2E1EB; height: 100% ">
    <div class="container">

        <h3 class="text-center">Modification de la voiture</h3>

         <div class="row">
             <div class="col-md-2"></div>
             <div class="col-md-6">
        <form action="{{url('partenaire/updateVoiture/'.$Voiture->id)}}" method="post" class="form-group">
                <input type="hidden" name="_method" value="PUT">
                {{csrf_field()}}

            <label>Type</label>
            <select name="type" class="form-control">
                <option value="Coupé" <?php if($Voiture->type=='Coupé') echo 'selected=selected'?>>Coupé</option>
                <option value="Familiale"  <?php if($Voiture->type=='Familiale') echo 'selected=selected'?>>Familiale</option>
                <option value="Cabriolet"  <?php if($Voiture->type=='Cabriolet') echo 'selected=selected'?>>Cabriolet</option>
                <option value="Pickup"  <?php if($Voiture->type=='Pickup') echo 'selected=selected'?>>Pickup</option>
            </select>
            <br>
            <label>Marque</label>
              <select name="marque" class="form-control">
                <option value="Range"  <?php if($Voiture->marque=='Range') echo 'selected=selected'?>>Range</option>
                <option value="Mercedes"  <?php if($Voiture->marque=='Mercedes') echo 'selected=selected'?>>Mercedes</option>
                <option value="Kia"  <?php if($Voiture->marque=='Kia') echo 'selected=selected'?>>Kia</option>
                <option value="Dacia"  <?php if($Voiture->marque=='Dacia') echo 'selected=selected'?>>Dacia</option>
                <option value="BM"  <?php if($Voiture->marque=='BM') echo 'selected=selected'?>>BM</option>
                <option value="Firari"  <?php if($Voiture->type=='Firari') echo 'selected=selected'?>>Firari</option>
                <option value="Audi"  <?php if($Voiture->type=='Audi') echo 'selected=selected'?>>Audi</option>
             </select>
            <br>
            <label>Nombre de places</label>
            <select name="nbr_places" class="form-control">
                <option value="2" <?php if($Voiture->nbr_places=='2') echo 'selected=selected'?>>2</option>
                <option value="3" <?php if($Voiture->nbr_places=='3') echo 'selected=selected'?>>3</option>
                <option value="4" <?php if($Voiture->nbr_places=='4') echo 'selected=selected'?>>4</option>
                <option value="5" <?php if($Voiture->nbr_places=='5') echo 'selected=selected'?>>5</option>
                <option value="6" <?php if($Voiture->nbr_places=='6') echo 'selected=selected'?>>6</option>
            </select>
            <br>
            <label>Carburant</label>
            <select name="carburant" class="form-control">
                <option value="Diesel"  <?php if($Voiture->carburant=='Diesel') echo 'selected=selected'?>>Diesel</option>
                <option value="Essence"  <?php if($Voiture->carburant=='Essence') echo 'selected=selected'?>>Essence</option>
                <option value="Électrique"  <?php if($Voiture->carburant=='Électrique') echo 'selected=selected'?>>Électrique</option>
                <option value="Hybride" <?php if($Voiture->carburant=='Hybride') echo 'selected=selected'?> >Hybride</option>
            </select>
            <br>

            <input type="submit" value="Enregistrer" class="btn btn-success">
        </form>
         </div>
         </div>
    </div>
    </div>
@endsection
