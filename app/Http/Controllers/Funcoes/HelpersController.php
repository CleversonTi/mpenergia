<?php

namespace App\Http\Controllers\Funcoes;

use App\Http\Controllers\Controller;
use App\Models\Admin\App_conteudo_idioma;
use Illuminate\Support\Facades\Route;

class HelpersController extends Controller
{
    public static $config;

    public static function linkZap(string $titulo = '', string $action = 'gostaria de saber mais sobre o produto')
    {
        if (!empty(self::$config['whatsapp'])) {

            if (empty($titulo)) return self::$config['whatsapp']['link'];

            $link = strtok(self::$config['whatsapp']['link'], '?');
            return $link . '?text=' . urlencode('Olá, vim pelo site e ' . $action . ' *' . $titulo . '*.');
        }

        return '';
    }

    public static function filtrarArray(array $array, $key, $value)
    {
        $result = [];
        if (!empty($array)) {
            foreach (array_keys($array) as $col) {
                $temp[$col] = $array[$col][$key];
                if ($temp[$col] == $value) $result[$col] = $array[$col];
            }
        }
        return $result;
    }

    static function obterCategoria(int $conteudo_id, int $idioma_id = 1): object
    {

        $page = new App_conteudo_idioma();
        $page = $page->where('conteudo_id', $conteudo_id);
        $page = $page->where('idioma_id', $idioma_id);
        $page = $page->get()->first();
        if (!empty($page->uri)) {
            return $page;
        }
    }

    static function dividirItens(array $itens, int $colunas = 2)
    {
        return array_chunk($itens, ceil(count($itens) / $colunas));
    }

    static function ulToArray($ul)
    {
        if (is_string($ul)) {
            // encode ampersand appropiately to avoid parsing warnings
            $ul = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $ul);
            if (!$ul = simplexml_load_string($ul)) {
                trigger_error("Syntax error in UL/LI structure");
                return FALSE;
            }
            return self::ulToArray($ul);
        } else if (is_object($ul)) {
            $output = array();
            foreach ($ul->li as $li) {
                $output[] = (isset($li->ul)) ? self::ulToArray($li->ul) : (string) $li;
            }
            return $output;
        } else return FALSE;
    }

    static function gerarImg($img, $webp = true, $class = '', $gerarLink = true, $abrirModal = false)
    {
        
        if (is_array($img)) {
            $link = !empty($img['link']) ? $img['link'] : '';
            $url = !empty($img['url']) ? $img['url'] : '';
            $urlWebp = !empty($img['url']) ? self::urlWebp($img['url']) : '';
            $url_directory = !empty($img['url']) ? public_path($img['url']) : '';
            $urlWebp_directory = !empty($img['url']) ? public_path($urlWebp) : '';
            $alt = !empty($img['alt']) ? $img['alt'] : '';
            $blank = !empty($img['blank']) ? 'target="_blank"' : '';;
            $status = !empty($img['status']) ? true : false;

            if (empty($url)) {
                return;
            }
        } else {
            $link = '';
            $url = $img;
            $urlWebp = '';
            $alt = $img;
            $blank = '';;
            $status = true;

            if ($webp) {
                $url = $img;
                $urlWebp = self::urlWebp($img);
                $url_directory = public_path($img);
                $urlWebp_directory = public_path($urlWebp);
            }
        }


        if (empty($status)) {
            return;
        }


        $html = '<img src="##url##" class="##class##" alt="##alt##">';


        /*  Webp    */
        if (!empty($webp) && !empty($urlWebp) && file_exists($url_directory)) {

            if (!file_exists($urlWebp_directory)) {
                if (function_exists('imagewebp')) {
                    self::saveWebp($url_directory, $urlWebp_directory);
                }
            }

            if (file_exists($urlWebp_directory)) {
                $html = '<picture><source srcset="##urlWebp##" type="image/webp">' . $html . '</picture>';
            }
        }


        /*  Link    */
        if (!empty($link) && !empty($gerarLink) && empty($abrirModal)) {
            $html = '    <a href="##link##"  ##blank## >' . $html . '</a>';
        }

        /*  Abrir Modal*/
        if (!empty($abrirModal)) {
            $html = '    <a href="" data-bs-toggle="modal" data-bs-target="#' . $abrirModal . '" >' . $html . '</a>';
        }

        $html = str_replace('##link##', $link, $html);
        $html = str_replace('##url##', $url, $html);
        $html = str_replace('##urlWebp##', $urlWebp, $html);
        $html = str_replace('##alt##', $alt, $html);
        $html = str_replace('##blank##', $blank, $html);
        $html = str_replace('##class##', $class, $html);

        return $html;
    }

    static function saveWebp($url_directory, $urlWebp_directory)
    {


        // Create and save

        $type = pathinfo($url_directory, PATHINFO_EXTENSION);
        $allowedTypes = array(
            'gif',  // [] gif
            'jpg',  // [] jpg
            'jpeg', // [] jpeg
            'png',  // [] png
            'bmp'   // [] bmp
        );
        if (!in_array($type, $allowedTypes)) {
            return false;
        }
        switch ($type) {
            case 'gif':
                $img = imageCreateFromGif($url_directory);
                break;
            case 'jpg':
            case 'jpeg':
                $img = imageCreateFromJpeg($url_directory);
                break;
            case 'png':
                $img = imageCreateFromPng($url_directory);
                break;
            case 'bmp':
                $img = imageCreateFromBmp($url_directory);
                break;
        }

        if (!empty($img)) {
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
            imagewebp($img, $urlWebp_directory, 80);
            imagedestroy($img);
        }
    }


    static function urlWebp($urlImage = '')
    {

        if (!empty($urlImage)) {
            $name = pathinfo($urlImage, PATHINFO_FILENAME);
            $extesion = pathinfo($urlImage, PATHINFO_EXTENSION);
            $nameImage = $name . '.' . $extesion;


            /*  Gerando caminho webp    */
            $nameWebp = $name . $extesion;
            $nameWebp = str_replace(' ', '', $nameWebp);
            $nameWebp = str_replace('%20', '', $nameWebp) . '.webp';

            $urlWebp = str_replace($nameImage, '', $urlImage) . $nameWebp;


            return $urlWebp;
        }
    }

    public function obterID($link = '', $site = 'instagram.com')
    {

        $replace = str_replace('https://', '', $link);
        $replace = str_replace('http://', '', $replace);
        $replace = str_replace('www.', '', $replace);
        $replace = str_replace($site, '', $replace);
        $replace = str_replace('/', '', $replace);

        return $replace;
    }

    public function urlAmigavel($string, $semtraco = false)
    {
        $table = array(
            '?' => 'S',
            '?' => 's',
            '?' => 'Dj',
            '?' => 'dj',
            '?' => 'Z',
            '?' => 'z',
            '?' => 'C',
            '?' => 'c',
            '?' => 'C',
            '?' => 'c',
            'À' => 'A',
            'Á' => 'A',
            'Â' => 'A',
            'Ã' => 'A',
            'Ä' => 'A',
            'Å' => 'A',
            'Æ' => 'A',
            'Ç' => 'C',
            'È' => 'E',
            'É' => 'E',
            'Ê' => 'E',
            'Ë' => 'E',
            'Ì' => 'I',
            'Í' => 'I',
            'Î' => 'I',
            'Ï' => 'I',
            'Ñ' => 'N',
            'Ò' => 'O',
            'Ó' => 'O',
            'Ô' => 'O',
            'Õ' => 'O',
            'Ö' => 'O',
            'Ø' => 'O',
            'Ù' => 'U',
            'Ú' => 'U',
            'Û' => 'U',
            'Ü' => 'U',
            'Ý' => 'Y',
            'Þ' => 'B',
            'ß' => 'Ss',
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'æ' => 'a',
            'ç' => 'c',
            'è' => 'e',
            'é' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'ì' => 'i',
            'í' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ð' => 'o',
            'ñ' => 'n',
            'ò' => 'o',
            'ó' => 'o',
            'ô' => 'o',
            'õ' => 'o',
            'ö' => 'o',
            'ø' => 'o',
            'ù' => 'u',
            'ú' => 'u',
            'û' => 'u',
            'ý' => 'y',
            'ý' => 'y',
            'þ' => 'b',
            'ÿ' => 'y',
            '?' => 'R',
            '?' => 'r',
        );

        #Traduz os caracteres em $string, baseado no vetor $table
        $string = strtr($string, $table);

        #Converte para minúsculo
        $string = strtolower($string);

        #Remove caracteres indesejáveis (que não estão no padrão)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

        #Remove múltiplas ocorrências de hífens ou espaços
        $string = preg_replace("/[\s-]+/", " ", $string);

        #Transforma espaços e underscores em hífens
        $returnString = preg_replace("/[\s_]/", "-", $string);

        if ($semtraco) {
            $returnString = str_replace("-", "", $returnString);
        }

        return $returnString;
    }

    static function getCurrent()
    {


        $aa = Route::currentRouteName();

        echo '<pre>';
        print_r($aa);
        exit;

        dd($aa);
    }
     /**
     * Função que verifica se existe imagem webp, caso exista retorna o caminho dela
     * caso não exista retorna o caminho da imagem original
     * @param string $imageUrl
     * @return string
     */
    static function getImage(string $imageUrl = ''): string
    {
        if (empty($imageUrl)) {
            return '';
        }

        $fileName = pathinfo($imageUrl, PATHINFO_FILENAME);
        $fileName = str_replace(' ', '', $fileName);
        $fileExtension = pathinfo($imageUrl, PATHINFO_EXTENSION);
        $path = public_path("uploads/". $fileName.$fileExtension.'.webp');
        if (file_exists($path)) {
            return "uploads/". $fileName.$fileExtension.'.webp';
        }
        return $imageUrl;
    }
}
