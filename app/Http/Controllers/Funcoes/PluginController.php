<?php

namespace App\Http\Controllers\Funcoes;

use App\Http\Controllers\Controller;
use App\Models\Admin\App_conteudo;
use App\Models\Admin\App_conteudo_campos;
use App\Models\Admin\App_conteudo_idioma;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PluginController extends Controller
{

    public static $id;
    public static $linguagem = 1;
    public static $breadcrumb = [];

    // Tipos de campos
    const CAMPO_TEXTO = 'text';
    const CAMPO_AREATEXTO = 'textarea';
    const CAMPO_SENHA = 'password';
    const CAMPO_DATA = 'date';
    const CAMPO_COR = 'color';
    const CAMPO_EDITOR = 'editor';
    const CAMPO_GALERIA = 'gallery';
    const CAMPO_ARQUIVO = 'file';
    const CAMPO_MULTIPLOS_ARQUIVOS = 'multiplefiles';
    const CAMPO_IMAGEM = 'image';
    const CAMPO_TELEFONE = 'phone';
    const CAMPO_TELEFONE_MULTIPLOS = 'multiplephones';
    const CAMPO_RELACIONAMENTO = 'relationship';
    const CAMPO_SEPARADOR = 'separator';
    const CAMPO_REPETIDOR = 'repeater';
    const CAMPO_REPETIDOR_SIMPLES = 'repeatertxt';
    const CAMPO_REPETIDOR_PERSONALIZADO = 'repeaterPersonalizado';
    const CAMPO_UNIDADES = 'unidades';
    const CAMPO_TAGS = 'tags';
    const CAMPO_SELECAO = 'selection';
    const CAMPO_VERDADEIRO_FALSO = 'truefalse';
    const CAMPO_DINHEIRO = 'money';
    const CAMPO_MESSAGEM = 'message';
    const CAMPO_NUMBER = 'number';
    const CAMPO_VIDEO = 'video';

    function __construct($id = '', $linguagem = '')
    {
        parent::__construct();

        if (!empty($id)) {
            self::$id = $id;
        }

        if (!empty($linguagem)) {
            self::$linguagem = $linguagem;
        }
    }

    public function setId($id)
    {
        if (!empty($id)) {
            self::$id = $id;
        }
    }


    /**
     * @param array $filtro
     * @param bool|array $camposPersonalizados
     * @param int $qtd
     * @param false $paginacao
     * @param int $qtdPage
     * @param int $paginaAtual
     * @param string[] $ordem
     * @return array
     *
     */

    public function obterInternas($filtro = array(), $camposPersonalizados = false, $qtd = 0, $paginacao = false, $qtdPage = 10, $paginaAtual = 0, $ordem = ['id', 'DESC'], $aleatorio = false, $exceto = null): array
    {

        $model = new App_conteudo();

        $sql = $model->join('app_conteudo_idioma', 'app_conteudo.id', '=', 'app_conteudo_idioma.conteudo_id');

        /*  Caso tenha Filtro   */
        if (!empty($filtro)) {


            /*  Join    */


            if (!empty($filtro['busca'])) {
                $sql->where('app_conteudo_idioma.titulo', 'like', '%' . str_replace(' ', '%', $filtro['busca']) . '%');
            }


            $i = 1;

            foreach ($filtro as $key => $item) {
                if ($key == 'busca') {
                    continue;
                }

                $sql->join("app_conteudo_valor as valor_$i", 'app_conteudo.id', '=', "valor_$i.conteudo_id")->whereIn("valor_$i.valor", (array)$item);
                $sql->join("app_conteudo_campos as campo_$i", "valor_$i.configuracao_id", '=', "campo_$i.id")->where("campo_$i.name", $key);

                $i++;
            }
        }
        /*  Ativos  */
        $sql->where('app_conteudo.status', 1);

        /*  Seleciona as colunas específicas*/
        $sql->select('app_conteudo.id', 'app_conteudo_idioma.conteudo_id', 'app_conteudo.ordem', 'app_conteudo.pai_id', 'app_conteudo_idioma.titulo', 'app_conteudo_idioma.uri', 'app_conteudo_idioma.seo_description', 'app_conteudo_idioma.seo_image', 'app_conteudo_idioma.seo_keywords');

        /*  Filtra o Pai*/
        $sql->where('app_conteudo.pai_id', self::$id);

        /*  Ordem   */
        if ($aleatorio) {
            $sql->orderBy(DB::raw('RAND()'));
        } else {
            if (!empty($ordem[0]) && !empty($ordem[1])) {
                $sql->orderBy($ordem[0], $ordem[1]);
            }
        }

        // Ignorar
        if (!empty($exceto)) {
            $sql->whereNotIn('app_conteudo.id', (array)$exceto);
        }

        /*  Limita a qtd    */
        if (!empty($qtd)) {
            $sql->limit($qtd);
        }

        /*Distintic*/
        $sql->distinct();

        /*  Caso Tenha Paginação*/
        if (!empty($paginacao) && !empty($qtdPage)) {

            /*  Página Atual*/
            if (!empty($paginaAtual)) {
                Paginator::currentPageResolver(function () use ($paginaAtual) {
                    return $paginaAtual;
                });
            }

            $result = $sql->paginate($qtdPage)->toArray();

            /*  Campos personalizados   */
            if (!empty($camposPersonalizados)) {
                $plugin = new PluginController();

                if (is_array($camposPersonalizados)) {
                    foreach ($result['data'] as $key => $item) {
                        $plugin->setId($item['id']);
                        foreach ($camposPersonalizados as $campo) {
                            $result['data'][$key][$campo] = $plugin->obterCampos($campo);;
                        }
                    }
                } else {
                    foreach ($result['data'] as $key => $item) {
                        $plugin->setId($item['id']);

                        foreach ($plugin->obterCampos() as $campo => $valor) {
                            $result['data'][$key][$campo] = $valor;
                        }
                    }
                }
            }
        } else {
            $result = $sql->get();
            $result = !empty($result) ? $result->toArray() : [];

            /*  Campos personalizados   */
            if (!empty($camposPersonalizados)) {
                $plugin = new PluginController();

                if (is_array($camposPersonalizados)) {
                    foreach ($result as $key => $item) {
                        $plugin->setId($item['id']);
                        foreach ($camposPersonalizados as $campo) {
                            $result[$key][$campo] = $plugin->obterCampos($campo);
                        }
                    }
                } else {
                    foreach ($result as $key => $item) {
                        $plugin->setId($item['id']);

                        foreach ($plugin->obterCampos() as $campo => $valor) {
                            $result[$key][$campo] = $valor;
                        }
                    }
                }
            }
        }


        return $result;
    }

    public function obterInterna($uri, $pai, $tipoCampo = 'uri'): array
    {

        $model = new App_conteudo();

        $sql = $model->join('app_conteudo_idioma', 'app_conteudo.id', '=', 'app_conteudo_idioma.conteudo_id');

        if ($tipoCampo == 'uri') {
            $sql->where('app_conteudo_idioma.uri', $uri);
        } else if ($tipoCampo == 'id') {
            $sql->where('app_conteudo.id', $uri);
        }

        $sql->where('app_conteudo_idioma.idioma_id', PluginController::$linguagem);

        if (!empty($pai)) {
            $sql->where('app_conteudo.pai_id', $pai);
        }

        $sql->where('app_conteudo.status', 1);

        $servico = $sql->get()->first();

        if (!empty($servico['conteudo_id'])) {
            $servico = $servico->toArray();

            $plugin = new PluginController($servico['conteudo_id']);
            $servico_campos = $plugin->obterCampos();
            $servico = array_merge($servico, $servico_campos);
        } else {
            $servico = [];
        }

        return $servico;
    }

    public function obterCampos($campo = '')
    {
        if (empty(self::$id)) {
            return '';
        }

        if (!empty($campo)) {

            $campo = App_conteudo_campos::join('app_conteudo_valor', 'app_conteudo_campos.id', '=', 'app_conteudo_valor.configuracao_id')->select('app_conteudo_valor.valor', 'app_conteudo_campos.name', 'app_conteudo_campos.type')->where('app_conteudo_valor.idioma_id', self::$linguagem)->where('app_conteudo_campos.name', $campo)->where('app_conteudo_valor.conteudo_id', self::$id)->get()->first();

            $campo = !empty($campo) ? $campo->toArray() : [];
            $valor = !empty($campo) ? $this->valorPadrao($campo['type'], $campo) : '';
        } else {


            $campos = App_conteudo_campos::join('app_conteudo_valor', 'app_conteudo_campos.id', '=', 'app_conteudo_valor.configuracao_id')->select('app_conteudo_valor.valor', 'app_conteudo_campos.name', 'app_conteudo_campos.type')->where('app_conteudo_valor.idioma_id', self::$linguagem)->where('app_conteudo_valor.conteudo_id', self::$id)->get();

            $campos = !empty($campos) ? $campos->toArray() : [];

            /*  Campos + valores - Herdados + configurações atuais*/
            $valor = [];
            foreach ($campos as $key => $campo) {

                $valor[$campo['name']] = $this->valorPadrao($campo['type'], $campo);
            }
        }

        return $valor;
    }


    public function valorPadrao($tipo, $valor)
    {
        if ($tipo !== self::CAMPO_VERDADEIRO_FALSO && empty($valor)) {
            return '';
        }

        switch ($tipo) {

            case self::CAMPO_TAGS:
            case self::CAMPO_REPETIDOR_SIMPLES:
            case self::CAMPO_REPETIDOR:
                $valor['valor'] = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);
                break;
            case self::CAMPO_REPETIDOR_PERSONALIZADO:
                $data = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);
                $array = [];

                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        foreach ($value as $keyIn => $valueIn) {
                            $array[$key][$valueIn['name']] = $this->valorPadrao($valueIn['type'], $valueIn['value']);
                        }
                    }
                }
                $valor['valor'] = $array;

                break;

            case self::CAMPO_VIDEO:
                $valor['valor'] = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);

                $url = $valor['valor']['url'] ?? '';
                $id = self::obterIDYoutube($url);
                $thumb = self::gerarThumbYoutube($id, $valor['valor']['thumb']['value']['valor'] ?? '');

                $array = [
                    'id' => $id,
                    'url' => $url,
                    'thumb' => $thumb
                ];
                $valor['valor'] = $array;
                break;

            case self::CAMPO_VERDADEIRO_FALSO:
                $valor['valor'] = (bool)!empty($valor['valor']) ? $valor['valor'] : 0;
                break;

            case self::CAMPO_COR:
                $valor['valor'] = !empty($valor['valor']) ? $valor['valor'] : '';
                break;

            case self::CAMPO_ARQUIVO:
                $valor['valor'] = !empty($valor['valor']) ? 'uploads/' . $valor['valor'] : '';
                break;

            case self::CAMPO_MULTIPLOS_ARQUIVOS:
                $valorAll['valor'] = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);
                $array = [];
                foreach ($valorAll['valor'] as $item) {
                    $array[] = !empty($item) ? 'uploads/' . $item : '';
                }
                $valor['valor'] = $array;
                break;

            case self::CAMPO_UNIDADES:

                $valorAll['valor'] = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);

                $array = [];
                foreach ($valorAll['valor'] as $item) {
                    $telefones = [];
                    if (!empty($item['valor']['telefones']['value'])) {
                        foreach ($item['valor']['telefones']['value']['valor'] as $phone) {
                            $telefones[] = self::campoPhone($phone);
                        }
                    }


                    $zap = current(array_filter($telefones, function ($val) {
                        return $val['destino'] == 'whatsapp';
                    }));

                    $telefone = current(array_filter($telefones, function ($val) {
                        return $val['destino'] == 'telefone';
                    }));

                    $array[] = [
                        'unidade' => $item['unidade'] ?? '',
                        'telefones' => $telefones,
                        'cep' => $item['cep'] ?? '',
                        'cidade' => $item['cidade'] ?? '',
                        'estado' => $item['estado'] ?? '',
                        'endereco' => $item['endereco'] ?? '',
                        'iframe' => $item['iframe'] ?? '',
                        'link' => $item['link'] ?? '',
                        'whatsapp' => $zap,
                        'telefone' => $telefone
                    ];
                }

                $valor['valor'] = $array;
                break;

            case self::CAMPO_TELEFONE:

                $json = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);
                $valor['valor'] = self::campoPhone($json);
                break;

            case self::CAMPO_TELEFONE_MULTIPLOS:
                $valorAll['valor'] = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);
                $array = [];

                if (!empty($valorAll['valor'])) {
                    foreach ($valorAll['valor'] as $key => $item) {

                        $array[] = self::campoPhone($item);
                    }
                }

                $valor['valor'] = $array;
                break;

            case self::CAMPO_IMAGEM:

                $valor['valor'] = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);
                $array = [
                    'url' => !empty($valor['valor']['url']) ? 'uploads/' . $valor['valor']['url'] : '',
                    'titulo' => !empty($valor['valor']['titulo']) ? $valor['valor']['titulo'] : '',
                    'descricao' => !empty($valor['valor']['descricao']) ? nl2br($valor['valor']['descricao']) : '',
                    'link' => !empty($valor['valor']['link']) ? $valor['valor']['link'] : '',
                    'alt' => !empty($valor['valor']['alt']) ? $valor['valor']['alt'] : '',
                    'status' => (bool)!empty($valor['valor']['status']) ? $valor['valor']['status'] : 0,
                    'destaque' => (bool)!empty($valor['valor']['destaque']) ? $valor['valor']['destaque'] : 0,
                    'blank' => (bool)!empty($valor['valor']['blank']) ? $valor['valor']['blank'] : 0
                ];
                $valor['valor'] = $array;

                break;

            case self::CAMPO_GALERIA:


                $valorAll['valor'] = is_array($valor['valor']) ? $valor['valor'] : json_decode($valor['valor'], true);


                $array = [];
                if (!empty($valorAll['valor'])) {
                    foreach ($valorAll['valor'] as $key => $item) {
                        $array[] = [
                            'url' => !empty($item['value']['valor']['url']) ? 'uploads/' . $item['value']['valor']['url'] : '',
                            'titulo' => !empty($item['value']['valor']['titulo']) ? $item['value']['valor']['titulo'] : '',
                            'descricao' => !empty($item['value']['valor']['descricao']) ? nl2br($item['value']['valor']['descricao']) : '',
                            'link' => !empty($item['value']['valor']['link']) ? $item['value']['valor']['link'] : '',
                            'alt' => !empty($item['value']['valor']['alt']) ? $item['value']['valor']['alt'] : '',
                            'status' => (bool)!empty($item['value']['valor']['status']) ? $item['value']['valor']['status'] : 0,
                            'destaque' => (bool)!empty($item['value']['valor']['destaque']) ? $item['value']['valor']['destaque'] : 0,
                            'blank' => (bool)!empty($item['value']['valor']['blank']) ? $item['value']['valor']['blank'] : 0
                        ];
                    }
                }

                $valor['valor'] = $array;


                break;

            case self::CAMPO_NUMBER:

                if ($valor['name'] == 'ordem') {
                    $valor['valor'] = !empty($valor['valor']) ? intval($valor['valor']) : 999;
                } else {
                    $valor['valor'] = (int)$valor['valor'];
                }

                break;

            case self::CAMPO_RELACIONAMENTO:


                $valor['valor'] = (int)$valor['valor'];


                break;

            case self::CAMPO_DATA:

                $time = strtotime($valor['valor']);

                $valor['valor'] = date('d/m/Y', $time);


                break;
        }


        return $valor['valor'];
    }

    public static function campoPhone($phone)
    {
        $link = '';
        if (!empty($phone['number']) && !empty($phone['destino'])) {
            if ($phone['destino'] == 'whatsapp') {
                if (!empty($phone['mensagem'])) {
                    $link = 'https://wa.me/55' . preg_replace('/[^0-9]/', '', $phone['number']) . '?text=' . urlencode($phone['mensagem']);
                } else {
                    $link = 'https://wa.me/55' . preg_replace('/[^0-9]/', '', $phone['number']);
                }
            } else {
                if (!empty($phone['tipo']) && $phone['tipo'] === 'noddd') {
                    $link = 'tel:' . preg_replace('/[^0-9]/', '', $phone['number']);
                } else {
                    $link = 'tel:+55' . preg_replace('/[^0-9]/', '', $phone['number']);
                }
            }
        }
        $array = [
            'numero' => !empty($phone['number']) ? $phone['number'] : '',
            'rotulo' => !empty($phone['label']) ? $phone['label'] : '',
            'mensagem' => !empty($phone['mensagem']) ? $phone['mensagem'] : '',
            'link' => $link,
            'destino' => $phone['destino'] ?? ''
        ];
        return $array;
    }

    public static function ordenarArray($conteudoArray, $coluna, $ordem = SORT_ASC)
    {

        if ((!empty($conteudoArray)) && (!empty($coluna))) {
            if (is_array($conteudoArray)) {

                foreach ($conteudoArray as $key => $row) {
                    $data_1[$key] = $row[$coluna] ?? 999;
                }

                array_multisort($data_1, $ordem, $conteudoArray);
            }
        }

        return $conteudoArray;
    }

    /** Função que retorna Url
     *
     * @param int $conteudo_id Id da Página
     * @param int $idioma_id Idioma da rota, padrão 1
     * @return string Page Uri
     *
     * */
    static function obterUrl(int $conteudo_id, int $idioma_id = 1): string
    {

        $page = new App_conteudo_idioma();
        $page = $page->where('conteudo_id', $conteudo_id);
        $page = $page->where('idioma_id', $idioma_id);
        $page = $page->get()->first();
        if (!empty($page->uri)) {
            return $page->uri;
        }
    }

    /** Função que retorna Url
     *
     * @param int $conteudo_id Id da Página
     * @param int $idioma_id Idioma da rota, padrão 1
     * @return Object Page Uri
     *
     * */
    static function obterPageIdioma(int $conteudo_id, int $idioma_id = 1): object
    {

        $page = new App_conteudo_idioma();
        $page = $page->where('conteudo_id', $conteudo_id);
        $page = $page->where('idioma_id', $idioma_id);
        $page = $page->get()->first();
        if (!empty($page->uri)) {
            return $page;
        }
    }

    static function obterTitulo($conteudo_id, $idioma_id = 1)
    {
        $page = new App_conteudo_idioma();
        $page = $page->where('conteudo_id', $conteudo_id);
        $page = $page->where('idioma_id', $idioma_id);
        $page = $page->get()->first();
        if (!empty($page->titulo)) {
            return $page->titulo;
        } else {
            return '';
        }
    }

    static function addBreadCrumb($page)
    {

        self::$breadcrumb[] = $page;
        View::share('breadcrumb', self::$breadcrumb);
    }

    static function obterIDYoutube($link = '')
    {
        if (!empty($link)) {
            preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link, $match);
            if (!empty($match[1])) {
                return $match[1];
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    static function gerarThumbYoutube($id = '', $thumb = [])
    {
        if (empty($thumb['url'])) {
            if (!empty($id)) {
                return 'https://img.youtube.com/vi/' . $id . '/0.jpg';
            } else {
                return '';
            }
        } else {
            return 'uploads/' . $thumb['url'];
        }
    }
}
