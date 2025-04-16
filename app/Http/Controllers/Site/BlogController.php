<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class BlogController extends SiteController
{


    public function index(Request $request)
    {
        $plugin = new PluginController();

        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['blog', route('blog')]);

        $plugin->setId(SiteController::PAGE_BLOG);
        $page = $plugin->obterCampos();

        $page['titulo'] = $plugin->obterTitulo(SiteController::PAGE_BLOG);

        // SEO
        $this->gerarSeo(SiteController::PAGE_BLOG);

        $filtro = [];

        if (!empty($request->categoria)) {
            $categoria = $plugin->obterInterna($request->categoria, SiteController::BLOG_CATEGORIAS);
            if (!$categoria) {
                return redirect()->route('blog');
            }
            $filtro['categoria'] = $categoria['conteudo_id'];
            $categoria_atual = $categoria['conteudo_id'];
            $this->setTitle($categoria['titulo'], 'prepend');
            $plugin->addBreadCrumb([mb_strtolower($categoria['titulo']), route('blog', ['uri' => $categoria['uri']])]);
        }

        // BUSCA
        if (!empty($request->busca)) {
            $busca = $filtro['busca'] = $request->busca;
        }

        // PAGINA ATUAL
        $paginaAtual = !empty($request->page) ? (int)$request->page : 1;

        // BLOG
        $plugin->setId(SiteController::PAGE_BLOG);
        $blog = $plugin->obterInternas($filtro, true, 0, true, 5, $paginaAtual);

        //CATEGORIAS
        $plugin->setId(SiteController::BLOG_CATEGORIAS);
        $categorias = $plugin->obterInternas([], true, 0, false, 10, 0, ['titulo', 'ASC']);

//        dd($blog);

        return view('default.blog.blog', [
            'page' => $page,
            'blog' => $blog,
            'categorias_blog' => $categorias,
            'categoria_atual' => $categoria_atual ?? '',
            'busca' => $busca ?? '',
        ]);
    }

    public function interna($uri = '')
    {
        if (empty($uri)) {
            return redirect()->route('blog');
        }

        $plugin = new PluginController();

        $plugin->addBreadCrumb(['home', route('home')]);
        $plugin->addBreadCrumb(['blog', route('blog')]);

        //POST
        $filtro = [];
        $post = $plugin->obterInterna($uri, SiteController::PAGE_BLOG);
        if (!$post) {
            return redirect()->route('blog');
        }

        //CATEGORIA
        if (!empty($post['categoria'])) {
            $categoria = $plugin->obterInterna($post['categoria'], SiteController::BLOG_CATEGORIAS, 'id');
            if (!empty($categoria)) {
                $filtro['categoria'] = $categoria['id'];
                $plugin->addBreadCrumb([mb_strtolower($categoria['titulo']), route('blog', ['uri' => $categoria['uri']])]);
            }
        }

        //CATEGORIAS
        $plugin->setId(SiteController::BLOG_CATEGORIAS);
        $categorias = $plugin->obterInternas([], true, 0, false, 10, 0, ['titulo', 'ASC']);

        // Page
        $plugin->setId(SiteController::PAGE_BLOG);
        $page = $plugin->obterCampos();

        $page['titulo'] = $post['titulo'];
        $page['descricao'] = '<h1>'.$post['titulo'].'</h1>';

        $plugin->addBreadCrumb([mb_strtolower($post['titulo']), route('blog-interna', ['uri' => $post['uri']])]);

        // RELACIONADOS
        $plugin->setId(SiteController::PAGE_BLOG);
        $blog = $plugin->obterInternas($filtro, true, 2, false, 10, 0, ['id', 'DESC'], true, $post['id']);

        // SEO
        $this->gerarSeo($post['conteudo_id']);

        return view('default.blog.interna', [
            'post' => $post,
            'categoria' => $categoria ?? '',
            'categoria_atual' => $categoria['id'] ?? '',
            'page' => $page,
            'blog' => $blog,
            'categorias_blog' => $categorias,
        ]);
    }
}
