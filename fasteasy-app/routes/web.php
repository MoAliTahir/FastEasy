<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Notifications\NotifyReser;
use App\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {

    $v=\App\Voiture::all();
    $ann= \App\Annonce::all()->where('history','=',0)->where('statut','=','disponible');//limiter le nombre d'annonce a 3 selon la date de creation
    $Par=\App\User::all();
    return view('welcome',compact(['v','ann','Par']));
});

Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
Route::any('/chercher','HomeController@Search');

Route::get('partenaire/register', 'Auth\RegisterPartenaireController@showRegistrationPartenaireForm')->name('registerPartenaire');
Route::post('partenaire/register/submit', 'Auth\RegisterPartenaireController@register')->name('partenaireSubmit');


Route::get('/profil','ClientController@getProfil');
Route::get('/modifier','ClientController@modifierUser');
Route::put('/update','ClientController@updateUser');
Route::get('/modifierclient','PartenaireController@editProfilclient');
Route::put('/updateclient','PartenaireController@updateProfilclient');
Route::get('/whoComments/{id}',function ($id){
    $partennaire=\App\User::find($id);

    $comments=\App\CommentaireUser::all()->where('id_to','=',$partennaire->id)->where('history','=','0');;  //commentaire sur ce partenaire

    $clients=\App\User::all(); //LES CLIENTS QU ONT COMMENTES SUR LE PARTENAIRES

    return view('/whoComments',compact(['partennaire','clients','comments']));
});

Route::get('/consulterAnnonce/{id}','HomeController@ConsAnnonce');
Route::get('/consulterVoiture/{id}','HomeController@ConsVoiture');


Route::get('/reserverAnnonce/{idAnnonce}','ClientController@reserverAnnonce')->middleware('auth')->name('reserver');
//notification
Route::get('/confirmer/{id}/{idAnnonce}', 'ClientController@updateReservation');
Route::get('/Annuler/{id}/{idAnnonce}','ClientController@updateReservation1');
//fin
Route::group(['prefix'=>'client'], function(){
    Route::get('mesReservations', 'ClientController@getMesReservations')->middleware('auth');
    Route::get('mesReservations/voirAnnonce/{idAnnonce}','ClientController@voirAnnonce');
    Route::get('listAnnonces', 'ClientController@listeAnnonce')->middleware('auth');
    Route::get('historique', 'ClientController@historique')->middleware('auth');

});

Route::group(['prefix'=>'partenaire'], function(){
    Route::get('monProfil','PartenaireController@monProfil')->name('profil');
    Route::get('listAnnonce','PartenaireController@listAnnonce')->name('Annonce');
    Route::get('nouvelAnnonce','PartenaireController@formAnnonce')->name('nouvelAnnonce');
    Route::post('createAnnonce','PartenaireController@creerAnnonce');

    Route::get('listVoiture','PartenaireController@formVoiture')->name('listVoiture');
    Route::get('formVoiture','PartenaireController@addVoiture');
    Route::post('createVoiture','PartenaireController@creerVoiture');

    //Modification d'une annonce
    Route::put('modifierAnnonce/{id}','PartenaireController@updateAnnonce');
    Route::get('modifierAnnonce/{id}','PartenaireController@editAnnonce');
    Route::put('suppressionAnnonce/{id}','PartenaireController@destoryAnnonce');
    Route::put('updateVoiture/{id}','PartenaireController@updateVoiture');
    Route::get('modifierVoiture/{id}','PartenaireController@editVoiture');
    Route::put('suppressionVoiture/{id}','PartenaireController@destoryVoiture');



});
/*Route::group(['prefix'=>'Admin'], function() {
    Route::get('bloquer/{id}', 'AdminController@bloquerUser');
});*/


//Evaluations

Route::get('/evaluateClient/{id_partenaire}/{id_client}/{id_reservation}', 'PartenaireController@showEvaluation1');
Route::get('/evaluatePartenaire/{id_client}/{id_partenaire}/{id_reservation}', 'ClientController@showEvaluation2');

Route::post('/addEvaluation1','PartenaireController@addEvaluation1');
Route::post('/addEvaluation2','ClientController@addEvaluation2');






Route::get('/Signaler/{id_to}','ClientController@Signaler');
Route::get('/bloquer/{id}', 'AdminController@bloquerUser');
Route::get('/SignalerCommentaire/{id_to}','ClientController@SignalerCommentaire');
Route::get('/CommentaireSignaler/{id}','AdminController@AfficherCommentaire');
Route::get('SupprimerCommentaire/{id}','AdminController@SupprimerCommentaire');
Route::get('SupprimerCommentaireV/{id}','ClientController@SignalerCommentaireV');
Route::get('/CommentaireSignalerv/{id}','AdminController@AfficherCommentaire');


//mark notif as read

Route::get('/read/{notif_id}', function ($notif_id){

    Auth::user()->unreadNotifications()->find($notif_id)->markAsRead();
});

Route::get('/notifyForm', function (){

       $reservations = \App\Reservation::all()->where('confirmer', '=', 1)->where('notified', '=', 0);


       foreach ($reservations as $reservation)
       {

           $annonce = \App\Annonce::find($reservation->id_annonce);

           $time = $annonce->date_fin . " " . $annonce->heureFin;

            if ($time <= now())
            {

                $client = User::find($reservation->id_client);
                $partenaire = User::find($annonce->id_partenaire);


                $client->notify(new NotifyReser($reservation, ['val'=>'/evaluateClient/'.$client->id.'/'.$partenaire->id]));
                $partenaire->notify(new NotifyReser($reservation, ['val'=>'/evaluatePartenaire/'.$partenaire->id.'/'.$client->id]));

                $reservation->notified = 1;
                $reservation->save();

            }
       }

});
