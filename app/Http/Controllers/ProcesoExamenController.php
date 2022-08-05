<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProcesoExamenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // el usuario debe estar autenticado
    }
}
