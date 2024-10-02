<?php

namespace App\Http\Controllers;

use App\Models\AksesNaskah;
use Illuminate\Http\Request;

class AksesNaskahController extends Controller
{
    public function index()
    {
        $askes_naskahs = AksesNaskah::all();
        return $this->sendResponse($askes_naskahs, 'susscess');
    }
}
