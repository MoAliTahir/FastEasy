<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\Notifications\mailto;
use App\Notifications\NotifyReser;
use App\Reservation;
use App\User;
use Illuminate\Http\Request;
use App\CommentaireUser;
use App\Commentaire_voitures;
class AdminController extends Controller
{
    //bloquer un user
    public function bloquerUser($id)
    {
        $user=User::find($id);
        $user->history='1';
        $user->save();
        $message= "l'utilisateur bien bloquer";
        return view('homeAdmin', compact(['message']));

    }
    public function AfficherCommentaire($id)
       {
        $commentaire = CommentaireUser::find($id);
       
        $userto = User::find($commentaire->id_to);
        $userfrom = User::find($commentaire->id_from);
        return view('commentaireSignaler', ['commentaire' => $commentaire,'userto' => $userto,'userfrom' => $userfrom]);        
       }
       public function AfficherCommentaireV($id)
       {
        $commentaire = Commentaire_voitures::find($id);

        $userto = User::find($commentaire->id_to);
        $userfrom = User::find($commentaire->id_from);
        return view('commentaireSignalerV', ['commentaire' => $commentaire,'userto' => $userto,'userfrom' => $userfrom]);
       }
      public function  SupprimerCommentaire($id)
      {
        $CommentaireUser=CommentaireUser::find($id);
        $CommentaireUser->history='1';
        $CommentaireUser->save();
        $message= "commentaire bien supprimer";
        return view('homeAdmin', compact(['message']));
      }
      public function  SupprimerCommentaireV($id)
      {
        $CommentaireUser= Commentaire_voitures::find($id);
        $CommentaireUser->history='1';
        $CommentaireUser->save();
        $message= "commentaire bien supprimer";
        return view('homeAdmin', compact(['message']));
      }
}
