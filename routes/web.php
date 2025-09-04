<?php


/*  Controladores   */


use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\CarrinhoController;
use App\Http\Controllers\Site\DepoimentosController;
use App\Http\Controllers\Site\DuvidasController;
use App\Http\Controllers\Site\ErrorController;
use App\Http\Controllers\Site\FornecedoresController;
use App\Http\Controllers\Site\OrcamentoController;
use App\Http\Controllers\Site\PaginaTesteController;
use App\Http\Controllers\Site\ProdutosController;
use App\Http\Controllers\Site\ProgramaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\FormularioEnviadoController;
use App\Http\Controllers\Site\PoliticaTermosController;
use App\Http\Controllers\Funcoes\PluginController;

use App\Http\Controllers\Funcoes\ApiController;
use App\Http\Controllers\Funcoes\UploadController;
use App\Http\Controllers\Site\ContatoController;
use App\Http\Controllers\Site\SobreController;
use App\Http\Controllers\Site\EventosController;
use App\Http\Controllers\Site\PortifolioController;
use App\Http\Controllers\Site\ServicosController;

/*  Index   */

Route::namespace('Site')->group(function () {



    /*  PAGE TESTE  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_TEST).'/{categoria?}', [PaginaTesteController::class, 'index'])->name('teste');


    
    /* Servicos  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_SERVICOS), [ServicosController::class, 'index'])->name('sobre');
    /* Eventos  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_EVENTOS), [EventosController::class, 'index'])->name('sobre');
    /*Portifolio  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_PORTIFOLIO), [PortifolioController::class, 'index'])->name('sobre');













    /*  Página Inicial  -  NÃO ALTERAR   */
    Route::get('/', [IndexController::class, 'index'])->name('home');

    /*  Sobre  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_SOBRE), [SobreController::class, 'index'])->name('sobre');

    /*  Produtos    */
    $url_produtos = PluginController::obterUrl(SiteController::PAGE_PRODUTOS);

    /*  Produtos - listagem    */
    Route::get($url_produtos, [ProdutosController::class, 'index'])->name("produtos");

    /*  Produtos - categoria/subcategoria    */
    Route::get($url_produtos . '/{uri}/{uri2?}', [ProdutosController::class, 'index'])->name("produtos-categorias");

    /*  Produto - interna    */
    Route::get('produto/{uri}', [ProdutosController::class, 'interna'])->name("produto");

    /*  Fornecedores    */
    Route::get(PluginController::obterUrl(SiteController::PAGE_FORNECEDORES), [FornecedoresController::class, 'index'])->name("fornecedores");

    /*  Depoimentos  */
    Route::get(PluginController::obterUrl(SiteController::DEPOIMENTOS), [DepoimentosController::class, 'index'])->name('depoimentos');

    /*  Dúvidas  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_DUVIDAS), [DuvidasController::class, 'index'])->name('duvidas');

    /*  Blog  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_BLOG) . '/{categoria?}', [BlogController::class, 'index'])->name("blog");

    /*  Blog interna */
    Route::get(PluginController::obterUrl(SiteController::PAGE_BLOG) . '/post/{uri}', [BlogController::class, 'interna'])->name("blog-interna");

    /*  Orçamento  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_ORCAMENTO), [OrcamentoController::class, 'index'])->name('orcamento');

    /*  Contato  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_CONTATO), [ContatoController::class, 'index'])->name('contato');

    /*  Programa ASTHAMEDCARE  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_PROGRAMA), [ProgramaController::class, 'index'])->name('programa');

    /*  Política de Privacidade  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_POLITICA), [PoliticaTermosController::class, 'politica'])->name('politica-de-privacidade');

    /*  Termos de Uso  */
    Route::get(PluginController::obterUrl(SiteController::PAGE_TERMOS), [PoliticaTermosController::class, 'termos'])->name('termos-de-uso');

    /*  Formulário Enviado  */
    Route::get('formulario-enviado', [FormularioEnviadoController::class, 'index'])->name('formulario-enviado');

    /* Carrinho */
    Route::get('carrinho', [CarrinhoController::class, 'index'])->name("carrinho");

    /* Carrinho — Dados */
    Route::get('carrinho/dados', [CarrinhoController::class, 'dados'])->name("carrinho-dados");

    /* Carrinho — Enviado */
    Route::get('carrinho/enviado', [CarrinhoController::class, 'enviado'])->name("carrinho-enviado");

    /* Carrinho — Funções */
    Route::post('carrinho/funcoes/{funcao}', [CarrinhoController::class, 'funcoes'])->name("carrinho-funcoes");

    /*  App v5.0.0*/
    Route::get('app/{any?}', function () {
        return redirect('app-raddar');
    });

    /*  Page 404    */
    Route::get('404', [ErrorController::class, 'index'])->name('404');
});


Route::namespace('Funcoes')->group(function () {

    /*  Upload Image    */
    Route::match(['post', 'put', 'get'], 'file-upload/{type?}', [UploadController::class, 'upload'])->name('file.upload.post');


    /*  Send Mail   */
    Route::match(['post', 'get'], 'enviar-email', [ApiController::class, 'enviarEmail']);
});
