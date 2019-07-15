<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Annonce;
use Illuminate\Support\Facades\View;

class PublicController extends Controller
{
    
    public function listerAnnonces()
    {
        return View('client/listAnnonces');
    }
}
