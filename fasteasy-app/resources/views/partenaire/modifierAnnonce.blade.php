@extends('layouts.template')
@section('style')
    <style>
        .btn1{
            background-color: #ffc107;
            color: white;
        }

    </style>
@endsection
@section('menu')
    @include('layouts.menuPartenaire')
@endsection
@section('content')
    <div style="margin-top: 130px; background-color:  #E2E1EB; height: 100%; padding-top: 30px;">

    <div class="container ">
         <h2 style="margin-left: 300px;">Modifier l'annonce</h2>
          <div class="row">
              <div class="col-md-2"></div>
               <div class="col-md-7">
            <form action="{{url('partenaire/modifierAnnonce/'.$annonce->id)}}" method="post" class="form-group" style="margin-left: 100px;">
            <input type="hidden" name="_method" value="PUT">
            {{csrf_field()}}

                <label>DATE DE RETRAIT</label>
                <input class="form-control" type="date" name="date_debut" value="{{$annonce->date_debut}}">
                <br>
                <label>HEURE DE DEBUT</label>
                <input class="form-control" type="time" name="heureDebut" value="{{$annonce->heureDebut}}">
                <br>
                <label>DATE DE RETOUR</label>
                <input class="form-control" type="date" name="date_fin" value="{{$annonce->date_fin}}">
                <br>
                <label>HEURE DE RETOUR</label>
                <input class="form-control" type="time" name="heureFin" value="{{$annonce->heureFin}}">
                <br>
                <label>prix</label>
                <input class="form-control" type="number" name="prix" value="{{$annonce->prix}}">
                <br>

                <select name="id_voiture" class="form-control">

                    @foreach($voiture as $v)
                        <?php if($v['id'] == $annonce->id_voiture) { ?>
                        <option value="<?= $v['id'] ?>" selected>
                            <?= $v['type']." "; ?> <?= $v['marque']?>
                        </option>
                            <?php }  else {?>
                            <option value="<?= $v['id'] ?>">
                            <?= $v['type']." "; ?> <?= $v['marque']?>
                                <?php } ?>
                            </option>
                    @endforeach
                </select>
            <br>
                <input type="submit" value="Enregistrer" class="btn btn-success">
        </form>
          </div>
          </div>
    </div>

    </div>
@endsection
