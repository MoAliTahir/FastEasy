<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\Photo;
use App\Reservation;
use App\User;
use App\Voiture;
use App\CommentaireUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PartenaireController extends Controller
{
    public function monProfil()
    {
        $profil = Auth::user();
        $commentaire = CommentaireUser::all()->where('id_to', $profil->id);
        //$c=User::all();
        //,'commentaire'=>$commentaire,'client'=>$c
        //,'client'=>$c
        return view('profil', ['data' => $profil, 'comments' => $commentaire]);

    }

    public function listProfilclient($id_client)
    {
        $client = User::all()->where('id', $id_client);
        $commentaire = CommentaireUser::all()->where('id_to', $id_client);
        return view('ProfilClient', ['profil' => $client, 'commentaire' => $commentaire]);
    }

    public function listProfilParetenaire($id_partenaire)
    {
        $profils = User::all()->where('id', $id_partenaire);
        $commentaire = CommentaireUser::all()->where('id_to', $id_partenaire);
        // $c=User::all();
        return view('ProfilPartenaire', ['profil' => $profils, 'commentaire' => $commentaire]);
    }

    public function listAnnonce()
    {

        $annonce = Annonce::all()->where('id_partenaire', Auth::user()->id)->where('history','=',0);
        //$voiture = Voiture::all();

        return view('partenaire/mesAnnonces', ['annonces' => $annonce]);

    }

    public function creerVoiture(Request $request)
    {
        $voiture = new Voiture();

        $voiture->carburant=$request->input('carburant');
        $voiture->marque = $request->input('marque');
        $voiture->nbr_places =$request->input('nbr_places');
        $voiture->type = $request->input('type');
        $voiture->id_partenaire = $request->input('id');

        $voiture->save();


        $idVoiture= Voiture::orderby('id', 'desc')->first()->id;

        
        if ($request->hasFile('image')) {
          $tab= $request->image;

          for($i=0;$i<sizeof($tab);$i++){
              $pic = new Photo();

              $pic->chemin=$tab[$i]->store('images');
              $pic->id_voiture=$idVoiture;

              $pic->save();
          }

        }

        //$request->session()->flash('id_partenaire',$request->input('id_partenaire'));
        return redirect('partenaire/listVoiture');


        //$voiture=Voiture::all()->where('id_partenaire',$id_partenaire);

    }

    public function creerAnnonce(Request $request)
    {
        $annonce = new Annonce();


        $annonce->id_voiture = $request->input('id_voiture');
        $annonce->id_partenaire = $request->input('id');
        $annonce->date_debut =$request->input('date_debut');
        $annonce->date_fin = $request->input('date_fin');
        $annonce->ville =  $request->input('ville');
        $annonce->heureFin = $request->input('heure_fin');
        $annonce->heureDebut = $request->input('heure_Debut');
        $annonce->prix = $request->input('prix');

        $annonce->save();
        return redirect('partenaire/listAnnonce');


        //$voiture=Voiture::all()->where('id_partenaire',$id_partenaire);

    }

    public function formVoiture()
    {
        $id = Auth::user()->id;
        $voiture = Voiture::all()->where('id_partenaire', $id)->where('history','=',0);

        return view('partenaire/mesVoitures', ['voiture'=>$voiture]);
    }

    public function addVoiture(){
        $id = Auth::user()->id;
        return view('partenaire/creerVoiture');
    }

    public function formAnnonce()
    {
        $voiture = Voiture::all()->where('id_partenaire', Auth::user()->id)->where('history','=',0);
        return view('partenaire/creerAnnonce', ['voiture' => $voiture]);
    }

    public function destoryAnnonce(Request $request, $idAnnonce)
    {
        $annonce = Annonce::find($idAnnonce);
        $id_partenaire=$annonce->id_partenaire;
        $annonce->history=$request->input('history');
        $annonce->save();
        return redirect('partenaire/listAnnonce');
    }
    public function editAnnonce($id)
    {
        $annonce= Annonce::find($id);
        $voiture=Voiture::all();

        return view('partenaire/modifierAnnonce',['annonce'=>$annonce,'voiture'=>$voiture]);
    }
    public  function updateAnnonce(Request $request,$id)
    {
        $annonce = Annonce::find($id);
        $annonce->date_debut= $request->input('date_debut');
        $annonce->date_fin = $request->input('date_fin');
        $annonce->heureDebut= $request->input('heureDebut');
        $annonce->heureFin = $request->input('heureFin');
        $annonce->prix = $request->input('prix');
        $annonce->id_voiture = $request->input('id_voiture');
        $annonce->save();
        $id_partenaire=$annonce->id_partenaire;
        return redirect('partenaire/listAnnonce');
    }
    public function editProfilclient()
    {
        $idUser=Auth::user()->id;
        $data=User::find($idUser);
        return view('client/modifierProfil',['data'=>$data]);
    }
    public  function updateProfilclient(Request $request)
    {
        $idUser=Auth::user()->id;
        $profil = User::find($idUser);
        $profil->name=$request->input('name');
        $profil->cin=$request->input('cin');
        $profil->login=$request->input('login');
        $profil->tel=$request->input('tel');
        $profil->email=$request->input('email');
        $img = $request->imageurl;
        $profil->chemin_image=$img->store('images');
        $profil->save();
        return redirect('/home');
    }

    public function editVoiture($id)

    {
        $Voiture = Voiture::find($id);
        return view('partenaire/Voiture_edit',['Voiture'=>$Voiture]);
    }

    public  function updateVoiture(Request $request,$id)
    {
        $Voiture = Voiture::find($id);
        $Voiture->type= $request->input('type');
        $Voiture->marque = $request->input('marque');
        $Voiture->carburant = $request->input('carburant');
        $Voiture->nbr_places = $request->input('nbr_places');
        $Voiture->save();
        $id_partenaire=$Voiture->id_partenaire;
        return redirect('partenaire/listVoiture');
    }

    public function destoryVoiture(Request $request, $id)
    {


        // return $request->all();
        $Voiture = Voiture::find($id);
//        $id_partenaire=$Voiture->id_partenaire;
        $Voiture->history=$request->input('history');

        $Voiture->save();
        return redirect('partenaire/listVoiture');



    }


    public function showEvaluation1($id_partenaire, $id_client, $id_reservation){
        return view('formEval1', compact(['id_partenaire', 'id_client', 'id_reservation']));
    }


    public function addEvaluation1(Request $request){

        //sur Le client
        $evalClient= new CommentaireUser();
        $evalClient->id_from       = $request->input('id_partenaire');
        $evalClient->id_to         = $request->input('id_client');
        $evalClient->avisPositive  = $request->input('avisPositif');
        $evalClient->avisNegative  = $request->input('avisNegatif');
        $evalClient->note          = $request->input('note');
        $evalClient->id_reservation= $request->input('id_reservation');

        $evalClient->save();

        return view('/homePartenaire', ['message' => 'Evaluation enregistrer avec succès']);

    }


}
