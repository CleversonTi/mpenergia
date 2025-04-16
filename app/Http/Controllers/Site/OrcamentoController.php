<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

class OrcamentoController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_ORCAMENTO);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_ORCAMENTO);
        $page = $plugin->obterCampos();

        // Home
        $plugin->setId(SiteController::PAGE_HOME);
        $home = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['orçamento', route('orcamento')]);


        $home['quer-saber-mais-formulario'] = $page['texto-formulario'];

        return view('default.orcamento', [
            'page' => $page,
            'home' => $home,
        ]);
    }
}
