<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

class FornecedoresController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_FORNECEDORES);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_FORNECEDORES);
        $page = $plugin->obterCampos();


        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['fornecedores', route('fornecedores')]);


//        dd($page);

        return view('default.fornecedores', [
            'page' => $page,
        ]);
    }
}
