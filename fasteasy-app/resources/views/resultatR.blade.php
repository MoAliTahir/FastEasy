
@extends('layouts.template')
@section('titre')
    Acceuil
@endsection

@section('content')

    <div class="container" style="margin-top: 80px">
        <center>
            <h3>Bienvenue sur <b>FastEasy</b></h3><br>

            <div class="col flex-center">
                <form class="form-inline shadow-none" method='post' action='/chercher' class="form-inline" >
                    {{csrf_field()}}
                    <label for="ville" class="mr-sm-2">Ville</label>
                    <select name="ville" class="form-control mr-sm-4" id="ville" required="required">
                        <option value="null" <?php if($ville=="null") echo "selected='selected'" ?> >--</option>
                        <option value="Agadir"  <?php if($ville=="Agadir") echo "selected='selected'" ?> >Agadir </option>
                        <option value="Casablanca"  <?php if($ville=="Casablanca") echo "selected=selected" ?>>Casablanca</option>
                        <option value="Rabat"  <?php if($ville=="Rabat") echo "selected='selected'"?> >Rabat</option>
                        <option value="Fes"  <?php if($ville=="Fes") echo "selected='selected'" ?> >Fes</option>
                        <option value="Sale"  <?php if($ville=="Sale") echo "selected='selected'" ?> >Sale</option>
                        <option value="Tetouan"  <?php if($ville=="Tetouan") echo "selected='selected'" ?> >Tetouan</option>
                        <option value="Tanger"  <?php if($ville=="Tanger") echo "selected='selected'" ?> >Tanger</option>
                        <option value="Rabat"  <?php if($ville=="Rabat") echo "selected='selected'" ?> >Rabat</option>
                        <option value="Meknes"  <?php if($ville=="Meknes") echo "selected='selected'" ?> >Meknes</option>
                        <option value="Essaouira "  <?php if($ville=="Essaouira") echo "selected='selected'" ?> >Essaouira </option>
                        <option value="Dakhla"  <?php if($ville=="Dakhla") echo "selected='selected'" ?> >Dakhla</option>
                    </select>

                    <label for="marque" class="mr-sm-2">Marque</label>
                    <select name="marque" class="form-control mr-sm-4" id="marque" required="required">
                        <option value="null"  <?php if($marque=="null") echo "selected"?> >--</option>
                        <option value="Audi" <?php if($marque=="Audi") echo "selected" ;?>>Audi</option>
                        <option value="Range" <?php if($marque=="Range") echo "selected" ;?>>Range</option>
                        <option value="Mercedes" <?php if($marque=="Mercedes") echo "selected" ;?>>Mercedes</option>
                        <option value="Kia" <?php if($marque=="Kia") echo "selected";?>>Kia</option>
                        <option value="Dacia" <?php if($marque=="Dacia") echo "selected";?>>Dacia</option>
                        <option value=" Volkswagen" <?php if($marque=="Volkswagen") echo"selected" ;?>>   Volkswagen</option>
                        <option value="BM" <?php if($marque=="BM") echo "selected" ;?>>BM</option>
                        <option value="Firari" <?php if($marque=="Firari") echo "selected" ;?>>Firari</option>
                    </select>

                    <label for="date" class="mr-sm-2">Date de disponibilite</label>

                    <input type="date" name="date_debut" class="form-control mr-sm-4" required="required" value="<?php echo $date_debut?>" >


                    <button class="btn btn-outline-warning my-2 my-sm-0" type="submit" name="Rechercher">Rechercher</button>
                </form>
            </div>

        </center>
        <br><br><br>
                         <h3>Resultat de votre recherche :</h3>
        <div class="row" >
        @foreach ($Resu as $an)
                <?php if ($an->statut =='disponible') : ?>

            <?php  $v=\App\Voiture::find($an->id_voiture) ?><!--selectionner les info de voiture a l'aide de cle etrangere qui est dans annonce -->
                <?php   $Par=\App\User::find($an->id_partenaire) ?>
                <?php    $voiture_images2 = \App\Photo::all()->where("id_voiture", "=",$an->id_voiture)->first();?>

                <div class="col-md-4 zoom colonne " style="margin-bottom: 30px; " >
                    <div class="card" style="width: 18rem; height: 400px;border-radius: 5%;">

                        <img src="{{asset('storage/'.$voiture_images2->chemin)}}" class="card-img-bottom img-fluid" alt="" style="height: 200px;border-radius: 5%;">
                        <div class="card-body">
                            <h5 class="card-title text-dark">Annonceur : <a href="/ProfilPartenaire/{{$Par->id}}">{{$Par->login}}</a></h5>
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
            <?php endif; ?>
            @endforeach
        </div>

    </div>

@endsection



