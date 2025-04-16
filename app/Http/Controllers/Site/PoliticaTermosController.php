<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Funcoes\PluginController;

class PoliticaTermosController extends SiteController
{
    public function politica()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_POLITICA);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_POLITICA);
        $page = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['política de privacidade']);

        return view('default.politica-termos', [
            'page' => $page,
            'titulo' => 'Política de Privacidade'
        ]);
    }

    public function termos()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_TERMOS);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_TERMOS);
        $page = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['termos de uso']);

        return view('default.politica-termos', [
            'page' => $page,
            'titulo' => 'Termos de Uso'
        ]);
    }
}
