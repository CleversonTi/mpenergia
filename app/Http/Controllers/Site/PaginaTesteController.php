<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;


class PaginaTesteController extends SiteController
{


    public const PORTUGUES_ID = 1;
    public const ENGLISH_ID = 2;
    public const SPAIN_ID = 3;

    public function index(Request $request)
    {

        // SEO
        $this->gerarSeo();


        // Exemplo de obtenção de campos com multiidioma
        $plugin = new PluginController(SiteController::PAGE_TEST, self::PORTUGUES_ID);
        $page = $plugin->obterCampos();


        //Exemplo paginação
        $plugin->setId(SiteController::PAGE_TEST);
        $qtdPorPagina = 3;
        $paginaAtual = !empty($request->page) ? (int)$request->page : 1;
        $listagem = $plugin->obterInternas([], true, 0, true, $qtdPorPagina, $paginaAtual);


        $filtro = [];

        //Listando categorias
        $plugin->setId(SiteController::PAGE_TEST_CATEGORIAS);
        $categorias = $plugin->obterInternas(['categoria-pai' => 0], true);

        foreach ($categorias as &$cat) {
            $plugin->setId(SiteController::PAGE_TEST_CATEGORIAS);
            $cat['subcategorias'] = $plugin->obterInternas(['categoria-pai' => $cat['id']], true);
        }


        //Exemplo de como obter a categoria através do URI (URL)
        $categoria_uri = $request->categoria ?? '';
        if (!empty($categoria_uri)) {

            $plugin = new PluginController();
            $categoria = $plugin->obterInterna($categoria_uri, SiteController::PAGE_TEST_CATEGORIAS);

            $categoria_principal = current(self::filtrarArray($categorias, 'id', $categoria['id']));

            if (!empty($categoria_principal)) {
                $filtro['categoria'] = array_map(function ($item) {
                    return $item['id'];
                }, $categoria_principal['subcategorias']);
            }

            $filtro['categoria'][] = $categoria['id'];

        }

        $busca = $request->busca ?? '';
        if (!empty($busca)) {
            $filtro['busca'] = $busca;
        }

        //Exemplo sem paginação
        $plugin->setId(SiteController::PAGE_TEST);
        $itens = $plugin->obterInternas($filtro, true);


        return view('default.teste', [
            'page' => $page,
            'listagem' => $listagem,
            'itens' => $itens,
            'busca' => $busca,
            'categorias' => $categorias
        ]);
    }


}
