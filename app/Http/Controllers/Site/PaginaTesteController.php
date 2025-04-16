<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Request;


class PaginaTesteController extends SiteController
{


    public function index(Request $request)
    {

        // SEO
        $this->gerarSeo();


        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_TEST);
        $page = $plugin->obterCampos();
        $plugin->setId(SiteController::PAGE_TEST);
        $qtdPorPagina = 3;
        $paginaAtual = !empty($request->page) ? (int)$request->page : 1;
        $listagem = $plugin->obterInternas([], true, 0, true, $qtdPorPagina, $paginaAtual);


//
//        // Campos
//        $plugin = new PluginController();
//        $plugin->setId(SiteController::PAGE_HOME);
//        $home = $plugin->obterCampos();
//
//        // Produtos
//        $plugin->setId(SiteController::PAGE_PRODUTOS);
//        $destaques = $plugin->obterInternas(['destaque'=>true], true, 0, false, 10, 0, ['ordem', 'ASC']);
//
//
//        //Fornecedores
//        $plugin->setId(SiteController::PAGE_FORNECEDORES);
//        $fornecedores = $plugin->obterCampos();
//
//        // Depoimentos
//        $plugin->setId(SiteController::DEPOIMENTOS);
//        $depoimentos = $plugin->obterInternas([], true, 0, false, 3, 0, ['ordem', 'ASC']);
//
//        // Blog
//        $plugin->setId(SiteController::PAGE_BLOG);
//        $blog = $plugin->obterInternas([], true, 0, false, 3, 0, ['id', 'DESC']);

        return view('default.teste', [
            'page' => $page,
            'listagem' => $listagem,
        ]);
    }


}
