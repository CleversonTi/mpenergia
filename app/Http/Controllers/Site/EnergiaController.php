<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

class EnergiaController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_SOBRE);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_SOBRE);
        $page = $plugin->obterCampos();

        // Home
        $plugin->setId(SiteController::PAGE_HOME);
        $home = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['sobre nós', route('sobre')]);

        // Fornecedores
        $plugin->setId(SiteController::PAGE_FORNECEDORES);
        $fornecedores = $plugin->obterCampos();

        // Depoimentos
        $plugin->setId(SiteController::DEPOIMENTOS);
        $depoimentos = $plugin->obterInternas([], true, 0, false, 10, 0, ['ordem', 'ASC']);

        return view('default.sobre', [
            'page' => $page,
            'home' => $home,
            'fornecedores' => $fornecedores,
            'depoimentos' => $depoimentos,
        ]);
    }
}
