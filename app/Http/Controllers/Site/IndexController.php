<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use function App\Http\Controllers\filtrarDestaque;

class IndexController extends SiteController
{


    public function index()
    {
        // SEO
        $this->gerarSeo();

        // Campos
        $plugin = new PluginController();
        $plugin->setId(SiteController::PAGE_HOME);
        $home = $plugin->obterCampos();

        // Energia
        $plugin->setId(SiteController::PAGE_SERVICOS);

        $servicosHome = $plugin->obterCampos();
        
        // gera a URL da página de energia
        $servicosUrl = PluginController::obterUrl(SiteController::PAGE_SERVICOS);
       
        $servicosInterna = $plugin->obterInternas(['destaque'=>true], true, 0, false, 10, 0, ['ordem', 'ASC']);
        
       

        // Produtos
        $plugin->setId(SiteController::PAGE_PRODUTOS);
        $destaques = $plugin->obterInternas(['destaque'=>true], true, 0, false, 10, 0, ['ordem', 'ASC']);


        $produtos_destaques = [
            'todos' => $destaques,
            self::CATEGORIA_HOSPITALAR => [
                'titulo' => PluginController::obterTitulo(self::CATEGORIA_HOSPITALAR),
                'uri' => PluginController::obterUrl(self::CATEGORIA_HOSPITALAR),
                'listagem' => $litProdutos = self::filtrarDestaque(self::CATEGORIA_HOSPITALAR, $destaques),
                'qtd' => count($litProdutos),
                'categoria' => (new PluginController(self::CATEGORIA_HOSPITALAR))->obterCampos(),
            ],
            self::CATEGORIA_ODONTOLOGICA => [
                'titulo' => PluginController::obterTitulo(self::CATEGORIA_ODONTOLOGICA),
                'uri' => PluginController::obterUrl(self::CATEGORIA_ODONTOLOGICA),
                'listagem' => $litProdutos = self::filtrarDestaque(self::CATEGORIA_ODONTOLOGICA, $destaques),
                'qtd' => count($litProdutos),
                'categoria' => (new PluginController(self::CATEGORIA_ODONTOLOGICA))->obterCampos(),
            ],
            self::CATEGORIA_VETERINARIA => [
                'titulo' => PluginController::obterTitulo(self::CATEGORIA_VETERINARIA),
                'uri' => PluginController::obterUrl(self::CATEGORIA_VETERINARIA),
                'listagem' => $litProdutos = self::filtrarDestaque(self::CATEGORIA_VETERINARIA, $destaques),
                'qtd' => count($litProdutos),
                'categoria' => (new PluginController(self::CATEGORIA_VETERINARIA))->obterCampos(),
            ],
            self::CATEGORIA_INJETAVEIS => [
                'titulo' => PluginController::obterTitulo(self::CATEGORIA_INJETAVEIS),
                'uri' => PluginController::obterUrl(self::CATEGORIA_INJETAVEIS),
                'listagem' => $litProdutos = self::filtrarDestaque(self::CATEGORIA_INJETAVEIS, $destaques),
                'qtd' => count($litProdutos),
                'categoria' => (new PluginController(self::CATEGORIA_INJETAVEIS))->obterCampos(),
            ],
            self::CATEGORIA_ESTETICA => [
                'titulo' => PluginController::obterTitulo(self::CATEGORIA_ESTETICA),
                'uri' => PluginController::obterUrl(self::CATEGORIA_ESTETICA),
                'listagem' => $litProdutos = self::filtrarDestaque(self::CATEGORIA_ESTETICA, $destaques),
                'qtd' => count($litProdutos),
                'categoria' => (new PluginController(self::CATEGORIA_ESTETICA))->obterCampos(),
            ],
        ];

//        
        //Fornecedores
        $plugin->setId(SiteController::PAGE_FORNECEDORES);
        $fornecedores = $plugin->obterCampos();

        // Depoimentos
        $plugin->setId(SiteController::DEPOIMENTOS);
        $depoimentos = $plugin->obterInternas([], true, 0, false, 3, 0, ['ordem', 'ASC']);

        // Blog
        $plugin->setId(SiteController::PAGE_BLOG);
        $blog = $plugin->obterInternas([], true, 0, false, 3, 0, ['id', 'DESC']);

        return view('default.index', [
            'home' => $home,
            'url'=>$servicosUrl,
            'servicos' =>  $servicosInterna,
            'servicosHome' =>  $servicosHome,
            'produtos_destaques' => $produtos_destaques,
            'fornecedores' => $fornecedores,
            'blog' => $blog,
            'depoimentos' => $depoimentos,
        ]);
    }

    private static function filtrarDestaque($categoria, $destaques): array
    {

        return array_filter($destaques, function ($item) use ($categoria) {
            if ($item['categoria'] == $categoria) {
                return $item;
            }

        });
    }
}
