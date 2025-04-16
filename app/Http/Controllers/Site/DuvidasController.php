<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

class DuvidasController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_DUVIDAS);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_DUVIDAS);
        $page = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['dúvidas', route('duvidas')]);


        // Depoimentos
        $plugin->setId(SiteController::PAGE_DUVIDAS);
        $duvidas = $plugin->obterInternas([], true, 0, false, 0, 0, ['ordem', 'ASC']);

        return view('default.duvidas', [
            'page' => $page,
            'duvidas' => $duvidas,
        ]);
    }
}
