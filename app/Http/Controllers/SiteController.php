<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use Illuminate\Routing\Controller as BaseSiteController;
use App\Models\Admin\App_config;
use App\Models\Admin\App_conteudo_idioma;
use App\Models\Admin\App_idiomas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class SiteController extends BaseSiteController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /* CONSTANTES DE PÁGINAS */


    public const PAGE_TEST = 515;
    public const PAGE_TEST_CATEGORIAS = 524;


    public const PAGE_HOME = 60;

    public const PAGE_SOBRE = 463;

    public const PAGE_PRODUTOS = 413;
    public const PAGE_PRODUTOS_CATEGORIAS = 474;

    public const CATEGORIA_HOSPITALAR = 479;
    public const CATEGORIA_ODONTOLOGICA = 475;
    public const CATEGORIA_VETERINARIA = 477;
    public const CATEGORIA_INJETAVEIS = 478;
    public const CATEGORIA_ESTETICA = 476;

    public const MARCAS = 497;

    public const PAGE_FORNECEDORES = 492;

    public const DEPOIMENTOS = 470;

    public const PAGE_BLOG = 493;
    public const BLOG_CATEGORIAS = 508;

    public const PAGE_DUVIDAS = 119;
    public const PAGE_ORCAMENTO = 512;
    public const PAGE_PROGRAMA = 513;

    public const PAGE_POLITICA = 51;
    public const PAGE_TERMOS = 52;
    public const PAGE_CONTATO = 465;

    public const PAGE_CARRINHO = 514;


    // Configurações
    public static $config;
    public static $linguagem = 1;
    public static $seo;
    public static $menu;

    public function __construct()
    {
        // Carrinhu
        $this->middleware(function ($request, $next) {
            $carrinho = session()->get('carrinho', []);
            View::share('carrinho', $carrinho);
            return $next($request);
        });



        /*  Config e Menu   */
        self::$config = $this->getConfig();
        self::$config['menu'] = $this->gerarMenu();
        self::$config['rota-atual'] = URL::current();

        // Procedimentos
        $plugin = new PluginController();
        //Categorias
        $plugin->setId(SiteController::PAGE_PRODUTOS_CATEGORIAS);
        $categorias = self::$config['categorias'] = array_map(function ($categoria) {
            $categoria['url'] = route('produtos-categorias', ['uri' => $categoria['uri']]);
            return $categoria;
        }, PluginController::ordenarArray($this->obterCategorias(), 'ordem'));

        if (!empty(self::$config['unidades'])) {
            View::share('unidade', current(self::$config['unidades']));
        }

        HelpersController::$config = self::$config;

//        dd(self::$config);

        View::share('categorias', $categorias);
        View::share('config', self::$config);
        View::share('helpers', new HelpersController());
    }

    public function filtrarArray($array = [], $coluna = '', $valor = '')
    {
        return array_filter($array, function ($value) use ($coluna, $valor) {
            if (!isset($value[$coluna])) {
                return false;
            }
            if (is_array($value[$coluna])) {
                return in_array($valor, $value[$coluna]);
            } else {
                return $value[$coluna] == $valor;
            }
        });
    }

    public function obterCategorias($filtro = [])
    {
        $plugin = new PluginController(SiteController::PAGE_PRODUTOS_CATEGORIAS);
        $categorias_all = $plugin->obterInternas($filtro, true, 0, false, 10, 0, ['ordem', 'ASC']);

        $categorias = array_filter($categorias_all, function ($c) {
            return empty($c['categoria-pai']);
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($categorias as &$cat) {
            $cat['filhas'] = $this->filtrarArray($categorias_all, 'categoria-pai', $cat['id']);
        }

        return $categorias;
    }


    public function gerarMenu()
    {

        $menu = [];

        $menu[] = [
            'titulo' => 'Sobre',
            'url' => route('sobre')
        ];

        $menu[] = [
            'titulo' => 'Produtos',
            'url' => route('produtos')
        ];

        $menu[] = [
            'titulo' => 'Fornecedores',
            'url' => route('fornecedores')
        ];

        $menu[] = [
            'titulo' => 'Depoimentos',
            'url' => route('depoimentos')
        ];

        $menu[] = [
            'titulo' => 'Dúvidas',
            'url' => route('duvidas')
        ];

        $menu[] = [
            'titulo' => 'Blog',
            'url' => route('blog')
        ];

        $menu[] = [
            'titulo' => 'Orçamento',
            'url' => route('orcamento')
        ];

        $menu[] = [
            'titulo' => 'Fale Conosco',
            'url' => route('contato')
        ];

        $menu[] = [
            'titulo' => 'ASTHAMEDCARE',
            'url' => route('programa')
        ];

//        $menu[] = [
//            'titulo' => PluginController::obterPageIdioma(SiteController::PAGE_CONTATO)->titulo,
//            'url' => route('contato')
//        ];

        return $menu;
    }


    public function gerarSeo(int $page_id = null)
    {
        /*  Page id */
        if (!empty($page_id)) {
            $seoRow = App_conteudo_idioma::where('conteudo_id', $page_id)->get()->first();
        }

        $title = $seoRow->titulo ?? self::$config['titulo_site'];


        self::$seo = [
            'author' => self::$config['titulo_site'],
            'title' => Route::currentRouteName() == 'home' ? self::$config['titulo_home'] : $title . ' | ' . self::$config['titulo_site'],
            'site_name' => self::$config['titulo_site'],
            'url' => url(''),
            'image' => !empty($seoRow->seo_image) ? url('uploads/' . $seoRow->seo_image) : (!empty(self::$config['image_logo']['url']) ? url(self::$config['image_logo']['url']) : ''),
            'description' => !empty($seoRow->seo_description) ? $seoRow->seo_description : (!empty(self::$config['description']) ? self::$config['description'] : ''),
            'keywords' => !empty($seoRow->seo_keywords) ? $seoRow->seo_keywords : (!empty(self::$config['description']) ? self::$config['description'] : ''),
            'lang' => self::$linguagem == 1 ? 'pt_BR' : ($this->obterLinguagem(self::$linguagem)->sigla ?? 'no have'),
            'favicon' => !empty(self::$config['favicon']['url']) ? url('uploads/' . self::$config['favicon']['url']) : ''
        ];

        View::share('seo', self::$seo);
    }

    public function setTitle(string $title = '', $type = 'new')
    {


        if (!empty($title)) {

            switch ($type) {

                case 'new':

                    self::$seo['title'] = $title;
                    break;
                case 'prepend':
                    self::$seo['title'] = $title . ' | ' . (!empty(self::$seo['title']) ? self::$seo['title'] : '');
                    break;

                case 'append':
                    $titleArray = explode(' | ', self::$seo['title']);
                    array_push($titleArray, $title);
                    $penultimo = $titleArray[count($titleArray) - 2];
                    $titleArray[count($titleArray) - 2] = $titleArray[count($titleArray) - 1];
                    $titleArray[count($titleArray) - 1] = $penultimo;
                    self::$seo['title'] = implode(' | ', $titleArray);
                    break;
            }
        }
        View::share('seo', self::$seo);
    }


    public function getConfig()
    {
        $confAll = App_config::get()->toArray();

        $confArray = [];

        foreach ($confAll as $key => $item) {

            $confArray[$item['campo']] = $this->valorPadrao($item);

            /*  Telefone e Whatsapp */
            if ($item['campo'] == 'telefones') {
                $confArray['telefone'] = !empty(current($confArray[$item['campo']]['telefones'])) ? current($confArray[$item['campo']]['telefones']) : [];
                $confArray['whatsapp'] = !empty(current($confArray[$item['campo']]['whatsapps'])) ? current($confArray[$item['campo']]['whatsapps']) : [];
            }
        }

        return $confArray;
    }

    public function valorPadrao($obj)
    {


        switch ($obj['campo']) {


            case 'redes':
                $valor = json_decode($obj['valor'], true);

                $return = [];
                if (!empty($valor)) {
                    foreach ($valor as $key => $item) {

                        $return[strtolower($item['titulo'])] = !empty($item['valor']) ? $item['valor'] : '';
                    }
                }

                break;

            case 'unidades':

                $valor = json_decode($obj['valor'], true);

                $array = [];


                if (!empty($valor)) {

                    foreach ($valor as $item) {
                        $telefones = [];
                        $campos = [];
                        if (!empty($item['valor']['telefones']['value'])) {
                            foreach ($item['valor']['telefones']['value']['valor'] as $phone) {
                                $telefones[] = PluginController::campoPhone($phone);
                            }
                        }
                        if (!empty($item['valor']['redes']['value']['valor'])) {
                            foreach ($item['valor']['redes']['value']['valor'] as $campoRede) {
                                $campos[$campoRede['titulo']] = $campoRede['valor'];
                            }
                        }
                        $array[] = [
                            'unidade' => $item['unidade'] ?? '',
                            'telefones' => $telefones,
                            'cep' => $item['cep'] ?? '',
                            'cidade' => $item['cidade'] ?? '',
                            'estado' => $item['estado'] ?? '',
                            'endereco' => $item['endereco'] ?? '',
                            'iframe' => $item['iframe'] ?? '',
                            'link' => $item['link'] ?? '',
                            'campos' => $campos
                        ];
                    }
                }

                $return = $array;
                break;

            case 'telefones':

                $valor = json_decode($obj['valor'], true);


                $return = [
                    'telefones' => [],
                    'whatsapps' => []
                ];
                if (!empty($valor)) {
                    foreach ($valor as $key => $item) {


                        switch ($item['destino']) {

                            case 'telefone':
                                $return['telefones'][] = PluginController::campoPhone($item);

                                break;

                            case 'whatsapp':

                                $return['whatsapps'][] = PluginController::campoPhone($item);

                                break;
                        }
                    }
                }

                break;

            case 'image_logo':
            case 'image_rodape':

                $valor = json_decode($obj['valor'], true);
                $valor['url'] = 'uploads/' . $valor['url'];

                $return = $valor;

                break;

            default:

                $return = json_decode($obj['valor'], true);

                break;
        }

        return $return;
    }

    public function obterLinguagem(int $id = null)
    {

        if (!empty($id)) {
            $idiomaRow = App_idiomas::where('id', $id)->get()->first();
            return $idiomaRow;
        }
    }
}
