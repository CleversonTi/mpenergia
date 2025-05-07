<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;

class ErrorController extends SiteController
{
    public function index()
    {
        // SEO
        // $this->gerarSeo();

        echo '<h1>pagina não encontrada</h1>';
        exit;
        return redirect()->route('home');
        // return view('errors.404', []);
    }
}
