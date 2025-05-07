<?php

namespace App\Http\Controllers;

use App\Models\Empresa;

class WelcomeController extends Controller
{
    public function index()
    {
        // Trae todas las empresas
        $companies = Empresa::all();

        // Pasa el array a la vista
        return view('welcome', compact('companies'));
    }
}
