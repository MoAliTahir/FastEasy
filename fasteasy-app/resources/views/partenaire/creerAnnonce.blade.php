@extends('layouts.template')
@section('style')
    <style>
        .btn5{
            background-color: #ffc107;
            color: white;
        }
        .btn5:hover{
            color: #2a3342;
        }

    </style>
@endsection
@section('menu')
    @include('layouts.menuPartenaire')
@endsection

@section('titre')
    Nouvelle Annonce
@endsection

@section('content')
    <div class="container" style="padding-top: 180px; background-color: #E2E1EB" >

   <a href="{{url('partenaire/formVoiture')}}">  <button class="btn btn-success" style="float: right;">Nouvelle Voiture</button></a>
    <br>

            <form action="{{url('partenaire/createAnnonce')}}" method="post" class="form-group">
        {{ csrf_field() }}
            <input type="hidden" name="id" value="{{Auth::user()->id}}">

                <div class="row">

                    <div class="col-md-6">

                        <label>Voiture</label>
                        <select class="form-control from-control-sm" name="id_voiture">
                            <option value="--">--</option>
                            @foreach($voiture as $v)
                                <option value="<?= $v['id'] ?>">
                                    <?= $v['type']." "; ?> <?= $v['marque']?>
                                </option>
                            @endforeach
                        </select>
                        <br>

                        <label>Ville</label>
                        <select name="ville" class="form-control">
                            <option value="Agadir">Agadir</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Fes">Fes</option>
                            <option value="Sidi Kacem">Sidi Kacem</option>
                            <option value="Sale">Sale</option>
                            <option value="Tetouan">Tetouan</option>
                            <option value="Tanger">Tanger</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Meknes">Meknes</option>
                            <option value="Essaouira ">Essaouira </option>
                            <option value="Dakhla">Dakhla</option>
                        </select>
                        <br>

                    </div>



                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label>DATE DE RETRAIT</label>
                                <input class="form-control from-control-sm" type="date" name="date_debut">
                                <br>

                                <label>DATE DE RETOUR</label>
                                <input class="form-control from-control-sm" type="date" name="date_fin">
                                <br>
                            </div>

                            <div class="col-md-6">
                                <label>HEURE DE RETRAIT</label>
                                <input class="form-control from-control-sm"  type="time" name="heure_Debut">
                                <br>

                                <label>HEURE DE RETOUR</label>
                                <input class="form-control from-control-sm" type="time" name="heure_fin">
                                <br>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">

                         <label  >Prix/Heure</label>
                         <input class="form-control from-control-sm" type="number" name="prix">
                         <br>
                         <input type="submit" value="Enregistrer" class="btn btn-primary">
                    </div>


                </div>

        </form>
            </div>
        <br><br><br>
@endsection
