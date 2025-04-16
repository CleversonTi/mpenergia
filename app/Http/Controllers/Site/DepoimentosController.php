<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

class DepoimentosController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo(SiteController::DEPOIMENTOS);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::DEPOIMENTOS);
        $page = $plugin->obterCampos();

        // Home
        $plugin->setId(SiteController::PAGE_HOME);
        $home = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['depoimentos', route('depoimentos')]);


        // Depoimentos
        $plugin->setId(SiteController::DEPOIMENTOS);
        $depoimentos = $plugin->obterInternas([], true);

        return view('default.depoimentos', [
            'page' => $page,
            'home' => $home,
            'depoimentos' => $depoimentos,
        ]);
    }
}
