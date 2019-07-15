<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\CommentaireUser;
use App\CommentaireVoiture;
use App\Photo;
use App\RatingClient;
use App\RatingVoiture;
use App\Reservation;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Voiture;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check())
        {
            if (Auth::user()->statut === "admin")
                return view('homeAdmin');
            elseif (Auth::user()->statut === "partenaire")
                return view('homePartenaire');
            else
                return view('homeClient');
        }else
            return view('auth.login');

    }
       public function Search()
    {
           $date_debut = Input::get ( 'date_debut' );
           $marque = Input::get ( 'marque');
           $ville = Input::get ( 'ville');

     //$Res = Annonce::join('voitures','annonces.id_voiture','=','voitures.id')->where('date_debut','LIKE','%'.$date_debut.'%')->Where('ville','LIKE','%'.$ville.'%')->where('marque','LIKE','%'.$marque.'%')->get();
     $Res = DB::table('annonces')->join('voitures', 'annonces.id_voiture', '=', 'voitures.id')
         ->where('annonces.statut', '=', 'disponible')
         ->where('date_debut','LIKE','%'.$date_debut.'%')
         ->where('ville','LIKE','%'.$ville.'%')
         ->where('marque','LIKE','%'.$marque.'%')->get();


       if(count($Res) > 0)
        return view('resultatR',['Resu'=>$Res,'ville'=>$ville,'marque'=>$marque,'date_debut'=>$date_debut])->withDetails($Res);
       else {

           $Res = Annonce::join('voitures','annonces.id_voiture','=','voitures.id')
               ->where('annonces.statut', '=', 'disponible')
               ->where('date_debut','LIKE','%'.$date_debut.'%')
               ->orWhere('ville','LIKE','%'.$ville.'%')
               ->orwhere('marque','LIKE','%'.$marque.'%')->get();

           $Res=$Res->filter(
               function ($obj,$key){
               return $obj->statut='disponible';
           }
           );

           return view('resultatR',['Resu'=>$Res,'ville'=>$ville,'marque'=>$marque,'date_debut'=>$date_debut])->withDetails($Res);

       }

}

    public function ConsAnnonce($id)
    {
        $an1=Annonce::find($id);
        $v=Voiture::find($an1->id_voiture);
        $P=User::find($an1->id_partenaire);
        $comment=CommentaireVoiture::all()->where("id_to", "=",$an1->id_voiture)->where("history", "=",'0');
        $voiture_images = Photo::all()->where("id_voiture", "=",$an1->id_voiture);
        $voiture_images2 = Photo::all()->where("id_voiture", "=",$an1->id_voiture)->first();

        return view('consulterAnnonce',compact(['an1','v','P','comment','voiture_images','voiture_images2']));
    }

    public function ConsVoiture($id)
    {

        $v=Voiture::find($id);
        $comment=CommentaireVoiture::all()->where("id_to", "=",$id)->where("history", "=",'0');
        $voiture_images = Photo::all()->where("id_voiture", "=",$id);
        $voiture_images2 = Photo::all()->where("id_voiture", "=",$id)->first();

        return view('partenaire/consulterVoiture',compact(['v','comment','voiture_images','voiture_images2']));
    }






   /*  public function Search()
    {
        $date_debut = Input::get ( 'date_debut' );
        //dd($date_annonce);
        $marque = Input::get ( 'marque');

        $ville = Input::get ( 'ville');

        $idVoitures=Voiture::all()->where('marque','=','$marque');


//         if(!empty($date_debut) && !empty($marque) && !empty($ville)) {

             $Res = DB::table('annonces')->join('voitures', 'annonces.id_voiture', '=', 'voitures.id')
                 ->where('annonces.statut', '=', 'disponible')
                 ->where('date_debut', '=', $date_debut)
                 ->where('ville', '=', $ville)
                 ->where('marque', $marque)->get();

        return view('resultatRecherche',['Resu'=>$Res])->withDetails($Res);
//                dd($Res->count());
//             if($Res->count()!=0){
//                 return view('resultatRecherche',['Resu'=>$Res])->withDetails($Res);
//             }
//             else {
                 $Res = DB::table('annonces')->join('voitures', 'annonces.id_voiture', '=', 'voitures.id')->where('annonces.statut', '=', 'disponible')
                     ->orWhere('date_debut', '=', $date_debut)
                     ->orWhere('ville', '=', $ville)
                     ->orWhere('marque', $marque)->get();
                 return view('resultatRecherche',['Resu'=>$Res])->withDetails($Res);
//             }
//         }
//
//         if(empty($date_debut) || empty($marque) || empty($ville)){
//
//             $Res = DB::table('annonces')->join('voitures', 'annonces.id_voiture', '=', 'voitures.id')->where('annonces.statut', '=', 'disponible')
//                 ->orWhere('date_debut', '=', $date_debut)
//                 ->orWhere('ville', '=', $ville)
//                 ->orWhere('marque', $marque)->get();
//             return view('resultatRecherche',['Resu'=>$Res])->withDetails($Res);
//         }


    }*/

}

// $idVoitures=Voiture::find($marque);

//dd($idVoitures);
//        $Res=DB::table('annonces')->where('statut','=','disponible')
//                                        ->where('history','=',0)
//                            ->where('date_debut','=',$date_debut)
//                            ->orWhere('ville','=',$ville)
//                            ->orWhereIn('id_voiture',$idVoitures)->get();

//        $Res = Voiture::join('annonces','annonces.id_voiture','=','voitures.id')
//            ->where('date_debut','LIKE','%'.$date_debut.'%')
//            ->where('ville','LIKE','%'.$ville.'%')
//            ->where('marque','LIKE','%'.$marque.'%')->get();
