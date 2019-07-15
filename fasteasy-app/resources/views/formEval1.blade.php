@extends('layouts.template')



        @section('menu')
            @include('layouts.menuPartenaire')
        @endsection

        @section('titre')
            Form d'evaluation
        @endsection

        @section('content')

            <div class="container" style="margin-top: 180px">

                @php
                    $client = \App\User::find($id_client);
                @endphp

                <form class="form-group" action="/addEvaluation1" method="post">
                    {{ csrf_field() }}

                    <h2>Formulaire d'evaluation du client: <b>{{ $client->login }}</b> </h2>
                        <legend>Noter le client</legend>

                        <div class="form-group">
                            <label for="note">Note /5</label>
                            <input type="number" required class="form-control" id="note" aria-describedby="noteHelp" name="note" min="1" max="5">
                            <small id="noteHelp" class="form-text text-muted">Entrer une valeur comprise entre <b>1</b> et <b>5</b>.</small>
                        </div>

                        <div class="form-group">
                            <label for="avisPositif">Avis Positif</label>
                            <input type="text" class="form-control" id="avisPositif" aria-describedby="avisPositifHelp" name="avisPositif">
                            <small id="avisPositifHelp" class="form-text text-muted">Ce que vous avez aimer chez <b>{{ $client->login }}</b>.</small>
                        </div>
                        <div class="form-group">
                            <label for="avisNegatif">Avis Negatif</label>
                            <input type="text" class="form-control" id="avisNegatif" aria-describedby="avisNegatifHelp" name="avisNegatif">
                            <small id="avisNegatifHelp" class="form-text text-muted">Ce que vous n'avez pas aimer chez <b>{{ $client->login }}</b>.</small>
                        </div>

                        <input type="hidden" name="id_client" value="{{ $id_client }}">
                        <input type="hidden" name="id_partenaire" value="{{ $id_partenaire }}">
                        <input type="hidden" name="id_reservation" value="{{ $id_reservation }}">

                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    <br><br><br><br><br>

                </form>

                </body>
                </html>

            </div>
        @endsection

