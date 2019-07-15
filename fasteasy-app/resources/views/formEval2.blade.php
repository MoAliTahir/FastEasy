@extends('layouts.template')



@section('menu')
    @include('layouts.menuClient')
@endsection

@section('titre')
    Form d'evaluation
@endsection


@section('content')

    <div class="container" style="margin-top: 180px">

        @php
            $partenaire = \App\User::find($id_partenaire);

            $reservation = \App\Reservation::find($id_reservation);
            $annonce = \App\Annonce::find($reservation->id_annonce);
            $voiture = \App\Voiture::find($annonce->id_voiture);
        @endphp

        <form class="form-group" action="/addEvaluation2" method="post">
            {{ csrf_field() }}

            <h2>Formulaire d'evaluation du partenaire: <b>{{ $partenaire->login }}</b> </h2>

            <br><br>

            <div class="row">
                <div class="col-md-6">
                    <fieldset>
                        <legend>Evaluer la voiture: <b>{{ $voiture->type .' '. $voiture->marque }}</b> </legend>

                        <div class="form-group">
                            <label for="noteVoiture">Noter /5 l'etat de la voiture</label>
                            <input type="number" required class="form-control" id="noteVoiture" aria-describedby="noteHelp" name="noteVoiture" min="1" max="5">
                            <small id="noteVoitureHelp" class="form-text text-muted">Entrer une valeur comprise entre <b>1</b> et <b>5</b>.</small>
                        </div>

                        <div class="form-group">
                            <label for="avisPositifVoiture">Avis Positif</label>
                            <input type="text" class="form-control" id="avisPositifVoiture" aria-describedby="avisPositifVoitureHelp" name="avisPositifVoiture">
                            <small id="avisPositifVoitureHelp" class="form-text text-muted">Ce que vous avez aimer.</small>
                        </div>
                        <div class="form-group">
                            <label for="avisNegatifVoiture">Avis Negatif</label>
                            <input type="text" class="form-control" id="avisNegatifVoiture" aria-describedby="avisNegatifVoitureHelp" name="avisNegatifVoiture">
                            <small id="avisNegatifVoitureHelp" class="form-text text-muted">Ce que vous n'avez pas aimer.</small>
                        </div>


                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset>
                        <legend>Evaluer le partenaire: <b>{{ $partenaire->login }}</b></legend>

                        <div class="form-group">
                            <label for="note">Note /5</label>
                            <input type="number" required class="form-control" id="note" aria-describedby="noteHelp" name="note" min="1" max="5">
                            <small id="noteHelp" class="form-text text-muted">Entrer une valeur comprise entre <b>1</b> et <b>5</b>.</small>
                        </div>

                        <div class="form-group">
                            <label for="avisPositif">Avis Positif</label>
                            <input type="text" class="form-control" id="avisPositif" aria-describedby="avisPositifHelp" name="avisPositif">
                            <small id="avisPositifHelp" class="form-text text-muted">Ce que vous avez aimer chez <b>{{ $partenaire->login }}</b>.</small>
                        </div>
                        <div class="form-group">
                            <label for="avisNegatif">Avis Negatif</label>
                            <input type="text" class="form-control" id="avisNegatif" aria-describedby="avisNegatifHelp" name="avisNegatif">
                            <small id="avisNegatifHelp" class="form-text text-muted">Ce que vous n'avez pas aimer chez <b>{{ $partenaire->login }}</b>.</small>
                        </div>


                    </fieldset>
                </div>
            </div>



            <input type="hidden" name="id_client" value="{{ $id_client }}">
            <input type="hidden" name="id_partenaire" value="{{ $id_partenaire }}">
            <input type="hidden" name="id_reservation" value="{{ $id_reservation }}">
            <input type="hidden" name="id_voiture" value="{{ $voiture->id }}">

            <button type="submit" class="btn btn-primary">Envoyer</button>
            <br><br><br><br><br>

        </form>

        </body>
        </html>

    </div>
@endsection

