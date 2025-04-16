<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

class ContatoController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_CONTATO);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_CONTATO);
        $page = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['contato', route('contato')]);

        return view('default.contato', [
            'page' => $page,
        ]);
    }
}
