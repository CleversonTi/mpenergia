<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class ProdutosController extends SiteController
{

    public function searchSuggestions(Request $request)
    {
        if (empty($request->q) || mb_strlen(trim($request->q)) <= 3) return response()->json([]);
        $plugin = new PluginController(SiteController::PAGE_PRODUTOS);
        $produtos = $plugin->obterInternas(['busca' => $request->q], false, 5, false, 10, 0, ['titulo', 'ASC']);
        return response()->json($produtos);
    }

    public function index(Request $request, $uri = '', $uri2 = '')
    {

        $plugin = new PluginController();

        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['produtos', route('produtos')]);

        $plugin->setId(SiteController::PAGE_PRODUTOS);
        $page = $plugin->obterCampos();

        $page['titulo'] = $plugin->obterTitulo(SiteController::PAGE_PRODUTOS);

        // SEO
        $this->gerarSeo(SiteController::PAGE_PRODUTOS);

        $filtro = [];

        // busca
        if (!empty($request->busca)) {
            $filtro['busca'] = $request->busca;
            $titulo = 'Busca por: ' . $request->busca;
        }

        if(!empty($request->marca)){
            $marca = $plugin->obterInterna($request->marca, SiteController::MARCAS);
            $marca_atual = $marca['id'];
            $filtro['marca'] = $marca['id'];
        }

        // categoria
        if (!empty($uri)) {
            $categoria = $plugin->obterInterna($uri, SiteController::PAGE_PRODUTOS_CATEGORIAS);
            if (!$categoria) return redirect()->route('produtos');

            // categoria principal como filtro
            $filtro['categoria'][] = $categoria['conteudo_id'];

            // subcategorias como filtros
            $plugin->setId(SiteController::PAGE_PRODUTOS_CATEGORIAS);
            $subs = $plugin->obterInternas(['categoria-pai' => $categoria['conteudo_id']]);

            $idSubs = array_column($subs, 'id');
            $filtro['categoria'] = array_merge($filtro['categoria'], $idSubs);

            // dados da categoria selecionada - p/ view
            $categoria_atual = $categoria['conteudo_id'];
            if (empty($uri2)) $this->setTitle($categoria['titulo'], 'prepend');
            $plugin->addBreadCrumb([mb_strtolower($categoria['titulo']), route('produtos-categorias', ['uri' => $categoria['uri']])]);
            $titulo = $categoria['titulo'];

            $categoria['filhas'] = $plugin->ordenarArray($subs, 'ordem');
        }

        if (!empty($uri2)) {
            $subcategoria = $plugin->obterInterna($uri2, SiteController::PAGE_PRODUTOS_CATEGORIAS);
            if (!$subcategoria) return redirect()->route('produtos');
            $filtro['categoria'] = $subcategoria['conteudo_id'];

            // dados p/ view
            $subcategoria_atual = $subcategoria['conteudo_id'];
            $this->setTitle($subcategoria['titulo'], 'prepend');
            $plugin->addBreadCrumb([mb_strtolower($subcategoria['titulo']), route('produtos-categorias', ['uri' => $subcategoria['uri']])]);
            $titulo = $subcategoria['titulo'];
        }

        // PAGINA ATUAL
        $paginaAtual = !empty($request->page) ? (int)$request->page : 1;

        // PRODUTOS
        $plugin->setId(SiteController::PAGE_PRODUTOS);
        $produtos = $plugin->obterInternas($filtro, true, 0, true, 32, $paginaAtual, ['titulo', 'ASC']);

        //marcas

        $plugin->setId(SiteController::MARCAS);
        $marcas = $plugin->obterInternas([], true);

        return view('default.produtos.produtos', [
            'page' => $page,
            'marcas'=>$marcas,
            'produtos' => $produtos,
            'marca' => $marca ?? '',
            'categoria' => $categoria ?? '',
            'subcategoria' => $subcategoria ?? '',
            'titulo' => $titulo ?? '',
            'categorias_selecionadas' => $filtro['categoria'] ?? [],
            'categoria_atual' => $categoria_atual ?? null,
            'subcategoria_atual' => $subcategoria_atual ?? null,
            'marca_atual' => $marca_atual ?? null,
            'busca' => $request->busca ?? ''
        ]);
    }

    public function interna($uri = '')
    {



        if (empty($uri)) {
            return redirect()->route('produtos');
        }

        $plugin = new PluginController();

        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['produtos', route('produtos')]);

        //INTERNA
        $interna = $plugin->obterInterna($uri, SiteController::PAGE_PRODUTOS);
        if (!$interna) {
            return redirect()->route('produtos');
        }

        // Page
        $plugin->setId(SiteController::PAGE_PRODUTOS);
        $page = $plugin->obterCampos();

        $plugin->addBreadCrumb([mb_strtolower($interna['titulo'])]);

        // SEO
        $this->gerarSeo($interna['conteudo_id']);
        $this->setTitle('Produtos', 'append');

        // coloca descricao header como título do produto
        $page['descricao'] = '<h1>'.$interna['titulo'].'</h1>';

        //Produtos relacionados com preferencia nas categorias relacionadas
        $filtros = [];
        if(!empty($interna['categoria'])){
            $filtros['categoria'][] = $interna['categoria'];
            $plugin->setId($interna['categoria']);
            $categoria = $plugin->obterCampos();
            if(!empty($categoria['categoria-pai'])){
                $filtros['categoria'][] = $categoria['categoria-pai'];
            }
        }

        $plugin->setId(SiteController::PAGE_PRODUTOS);
        $produtos = $plugin->obterInternas($filtros, true, 0, false, 12, 0, ['titulo', 'ASC']);

        return view('default.produtos.produto', [
            'produto' => $interna,
            'page' => $page,
            'produtos_relacionados'=> [
                'titulo' => 'Compre também: ',
                'uri' => route(!empty($interna['categoria']) ? 'produtos-categorias' : 'produtos', ['uri' => !empty($interna['categoria']) ? $plugin->obterUrl($interna['categoria']) : null]),
                'listagem' => $produtos,
                'qtd' => count($produtos),
                'categoria'=> $categoria ?? null
            ]
        ]);
    }


}
