<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

class ProgramaController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo(SiteController::PAGE_PROGRAMA);

        // Conteúdo
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_PROGRAMA);
        $page = $plugin->obterCampos();

        //BREADCRUMB
        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['asthamedcare', route('programa')]);

        //produtos
        $plugin->setId(SiteController::PAGE_PRODUTOS);
        $produtos = $plugin->obterInternas([], true, 0, false, 12, 0, ['titulo', 'ASC']);

        return view('default.programa', [
            'page' => $page,
            'produtos_relacionados'=> [
                'titulo' => 'Confira os produtos',
                'uri' => route('produtos'),
                'listagem' => $produtos,
                'qtd' => count($produtos)
            ]
        ]);
    }
}
