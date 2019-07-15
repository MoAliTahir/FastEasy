<?php

namespace App\Http\Controllers;
use App\Notifications\mailto;
use App\Photo;
use App\Signalisation;
use App\Signalisationc;

use App\User;
use App\Annonce;
use App\Voiture;
use App\CommentaireUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Reservation;
use App\Notifications\NotifyReser;
use App\Notifications\NotifySignaler;
use App\Notifications\NotifySinalerC;

use App\Notification;
use App\CommentaireVoiture;

class ClientController extends Controller
{


    public function __construct()
    {
        $this->middleware("auth");
    }

    //
    public function listeAnnonce()
    {
        $v=Voiture::all();
        // $ann1=Annonce::all(); origin
        //  $ann1=Annonce -> orderBy('id', 'DESC')->get();
        $ann1= Annonce::all()->where('history','=',0)->where('statut','=','disponible');//limiter le nombre d'annonce a 3 selon la date de creation
        $P=User::all();
        return view('client/listAnnonces',['ann'=>$ann1,'Vr'=>$v,'Par'=>$P]);


    }

   public  function reserverAnnonce($idAnnonce){

        $ann=Annonce::find($idAnnonce);
        $idClient=Auth::user()->id;
        $resev=new Reservation();
        $resev->id_client=$idClient;
        $resev->id_annonce=$ann->id;

        $ann->statut='traitement';

        $ann->save();
        $resev->save();
        //$annonce =Annonce::find();
        $ann=Annonce::find($idAnnonce);
        User::find($ann->id_partenaire)->notify(new NotifyReser($resev));//$ann

        return view('/homeClient', ['message'=>'Demande de reservation enregistrée avec succès']);
    }

    public function Search()
    {
        $date_annonce = Input::get ( 'date_annonce' );
        //dd($date_annonce);
        $heureDebut = Input::get ( 'heureDebut');
        // dd($heureDebut);
        $marque = Input::get ( 'marque');
        //dd($marque);
        $ville = Input::get ( 'ville');
        $Res = Voiture::join('annonces','annonces.id_voiture','=','voitures.id')
            ->where('date_annonce','LIKE','%'.$date_annonce.'%')
            ->where('heureDebut','LIKE','%'.$heureDebut.'%')
            ->where('ville','LIKE','%'.$ville.'%')
            ->where('marque','LIKE','%'.$marque.'%')->get();
        if(count($Res) > 0)
            return view('resultatRechercher',['Resu'=>$Res])->withDetails($Res);
        else return view ('views/welcome')->withMessage('No Details found. Try to search again !');
    }

    public function tousAnnonce()
    {
        $v=Voiture::all();
        $an1=Annonce::all();
        $P=User::all();
        return view('TousAnnonce',['ann'=>$an1,'Vr'=>$v,'Par'=>$P]);
    }





    public function showReservationForm($id_annonce)
    {
        $annonce = Annonce::all()->where('id', $id_annonce);

        dd($annonce);
        $voiture = Voiture::all()->where('id', $annonce->id_voiture)->get(1);
        return view('reserver', ['annonce' => $annonce, 'voiture' => $voiture]);
    }


    ///////////////////////////////////////////////////////////////////
    public function getProfil(){
        $idUser=Auth::user()->id;

        $data=User::find($idUser); //info personnels

        if (Auth::user()->statut === "partenaire")
        {
            $annonces = Annonce::all()->where('id_partenaire', '=', Auth::user()->id)
                                        ->where('statut', '=', 'reservé');

            $reserv = new Collection();
            foreach ($annonces as $annonce)
            {
                $res = Reservation::all()->where('id_annonce', '=', $annonce->id)
                    ->where('confirmer', '=', 1)->first();


                $reserv->add($res);
            }




            $reservations = $reserv;
        }else
            $reservations=Reservation::all()->where('id_client','=',$idUser); //reservations effectues par ce personne

        $partenaires=User::all();  //qui ont commenter sur ce client

        return view('client/profil',compact(['data','reservations','partenaires']));
    }

    //Page Modifier mon profil
    public function modifierUser(){
        $idUser=Auth::user()->id;

        $data=User::find($idUser);

        return view('modifierProfil',compact(['data']));

    }
    //script pour modifier
    public function updateUser(Request $request){

        $idUser=Auth::user()->id;

        $user=User::find($idUser);

        $user->name=$request->input('name');
        $user->cin=$request->input('cin');
        $user->login=$request->input('login');
        $user->tel=$request->input('tel');
        $user->email=$request->input('email');
        $img = $request->imageurl;
        if (isset($img))
            $user->chemin_image=$img->store('images');

        $user->save();
        $data=User::find(Auth::user()->id);
        $comments=CommentaireUser::all()->where('id_to','=',Auth::user()->id);  //commentaire sur ce client
        $partenaires=User::all();//les partenaires qui ont commenter sur ce client

        return view('client/profil',compact(['data','comments','partenaires']));
    }


    public function getMesReservations(){

        $idClient=Auth::user()->id;
        $data=Reservation::all()->where('id_client','=',$idClient)->where('statut','=',0);

        return view('client/mesReservations',compact(['data']));

    }

    public function voirAnnonce($id){

        $an=Annonce::find($id);
        $v=Voiture::find($an->id_voiture);
        return view('client/voirAnnonce',compact(['an','v']));

    }
   
    public function updateReservation($id,$idAnnonce)
   {
    $ann=Annonce::find($idAnnonce);
    $res=Reservation::find($id);
    $res->confirmer='1';
    $ann->statut='reservé';
    $res->save();
    $ann->save();
    User::find($res->id_client)->notify(new NotifyReser($res));
    User::find($ann->id_partenaire)->notify(new mailto($res));
    $message= "Reservation confirmer avec succes";
    return view('homePartenaire', compact(['message']));

   }
   public function updateReservation1($id,$idAnnonce)
   {
       $ann=Annonce::find($idAnnonce);
       $res=Reservation::find($id);
       $res->confirmer='0';
       $ann->statut='disponible';
       $res->save();
       $ann->save();
       $message= "Reservation annuler avec succes";
       return view('homePartenaire', compact(['message']));

   }

    public  function Signaler($id_to){
        $idClient=Auth::user()->id;
        $signal=new Signalisation();
        $signal->id_from=$idClient;
        $signal->id_to=$id_to;
        $signal->save();

        $admins = User::all()->where('statut', '=', 'admin');

        foreach ($admins as $admin)
        {
            $admin->notify(new NotifySignaler($signal));
        }

        return redirect('/home');
    }
    public  function SignalerCommentaire($id_to){
        $idClient=Auth::user()->id;
        $signalC=new Signalisationc();
        $signalC->id_from=$idClient;
        $signalC->id_to=$id_to;
        $signalC->save();
        $admins = User::all()->where('statut', '=', 'admin');

        foreach ($admins as $admin)
        {
            $admin->notify(new NotifySinalerC($signalC));
        }

        return redirect('/home')->with('message', 'Signalisation effectuée avec succès');
    }
    public  function SignalerCommentaireV($id_to,$id_Admin){
        $idClient=Auth::user()->id;
        $signalCv=new Signalisationcv();
        $signalCv->id_from=$idClient;
        $signalCv->id_to=$id_to;
        $signalCv->save();
        User::find($id_Admin)->notify(new NotifySinalerCv($signalCv));
        return redirect('/home');
    }

    public function historique(){

        $id_user=Auth::user()->id;
        $comments1=CommentaireVoiture::all()->where('id_from','=',$id_user);
        $comments2=CommentaireUser::all()->where('id_from','=',$id_user);

        return view('/client/historique',compact('comments1','comments2'));
    }

    public function showEvaluation2($id_client, $id_partenaire, $id_reservation){
        return view('formEval2', compact(['id_client', 'id_partenaire', 'id_reservation']));
    }


    public function addEvaluation2(Request $request){


        //sur Le partenaire
        $evalPartenaire= new CommentaireUser();
        $evalPartenaire->id_from=$request->input('id_client');
        $evalPartenaire->id_to=$request->input('id_partenaire');
        $evalPartenaire->avisPositive = $request->input('avisPositif');
        $evalPartenaire->avisNegative = $request->input('avisNegatif');
        $evalPartenaire->note=$request->input('note');
        $evalPartenaire->id_reservation=$request->input('id_reservation');

        $evalPartenaire->save() ;



        //sur la voiture

        $evalVoiture= new CommentaireVoiture();
        $evalVoiture->id_from=$request->input('id_client');
        $evalVoiture->id_to=$request->input('id_voiture');
        $evalVoiture->note=$request->input('noteVoiture');
        $evalVoiture->history= '0';
        $evalVoiture->avisPositive = $request->input('avisPositifVoiture');
        $evalVoiture->avisNegative = $request->input('avisNegatifVoiture');

        $evalVoiture->save() ;


        return view('/homeClient', ['message' => 'Evaluation enregistrer avec succès']);
    }

}
