<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;

class CarrinhoController extends SiteController
{


    public function index(Request $request)
    {


        $plugin = new PluginController(SiteController::PAGE_CARRINHO);
        $page = $plugin->obterCampos();


        // SEO
        $this->gerarSeo(SiteController::PAGE_CARRINHO);

        //BREADCRUMB
        $plugin->addBreadCrumb(['Home', route('home')]);
        $plugin->addBreadCrumb(['carrinho']);

        //        dd($page);

        return view('default.carrinho', [
            'page' => $page,
            'returnUrl' => $request->returnUrl ?? route('produtos')
        ]);
    }

    public function dados()
    {
        $plugin = new PluginController(SiteController::PAGE_CARRINHO);
        $page = $plugin->obterCampos();

        $carrinho = session()->get('carrinho', []);
        if (empty($carrinho)) return redirect()->route('carrinho');


        // SEO
        $this->gerarSeo(SiteController::PAGE_CARRINHO);

        //BREADCRUMB
        $plugin->addBreadCrumb(['Home', route('home')]);
        $plugin->addBreadCrumb(['carrinho de orçamento']);

        //        dd($page);

        return view('default.carrinho-dados', [
            'page' => $page
        ]);
    }

    public function enviado()
    {
        $plugin = new PluginController(SiteController::PAGE_CARRINHO);
        $page = $plugin->obterCampos();

        $carrinho = session()->get('carrinho', []);
//        if (empty($carrinho)) return redirect()->route('carrinho');

        session()->put('carrinho', []);
        session()->save();

        // SEO
        $this->gerarSeo(SiteController::PAGE_CARRINHO);

        //BREADCRUMB
        $plugin->addBreadCrumb(['Home', route('home')]);
        $plugin->addBreadCrumb(['carrinho de orçamento']);

        //        dd($page);

        return view('default.carrinho-enviado', [
            'page' => $page
        ]);
    }

    public function funcoes(Request $request, $funcao = '')
    {

        // Obtem função da rota
        if (empty($funcao)) return redirect()->route('home');

        // Dados requisição post
        $data = json_decode($request->getContent(), true);
        if (!$data) return redirect()->route('home');
        $id = intval($data['id']);

        // Obtem carrinho da sessão
        $carrinho = session()->get('carrinho', []);

        switch ($funcao) {

                // Adicionar ao carrinho
            case 'adicionar':

                $produto = $this->obterProduto($id);

                if (!empty($produto)) {
                    if ($this->checarCarrinho($id, $carrinho)) {
                        $carrinho = $this->alterarCarrinho($id, $carrinho, 'aumentar');
                    } else {
                        $carrinho[] = $produto;
                    }
                }

                break;

                // Aumentar qtd
            case 'aumentar':

                $carrinho = $this->alterarCarrinho($id, $carrinho, 'aumentar');

                break;

                // Diminuir qtd
            case 'diminuir':

                $carrinho = $this->alterarCarrinho($id, $carrinho, 'diminuir');

                break;

                // Remover do carrinho
            case 'remover':

                $carrinho = $this->alterarCarrinho($id, $carrinho, 'remover');

                break;

                // Limpar carrinho
            case 'limpar':

                $carrinho = [];

                break;
        }

        session()->put('carrinho', $carrinho);
        session()->save();
        echo json_encode($carrinho);
    }

    public function obterProduto($id)
    {
        $produtosModel = new PluginController(SiteController::PAGE_PRODUTOS);
        $produto = $produtosModel->obterInterna($id, SiteController::PAGE_PRODUTOS, 'id');
        $result = [];
        if (!empty($produto)) {
            $valor = !empty($produto['preco']) ? str_replace(['.', ','], ['', '.'], $produto['preco']) : 0;
            $result = [
                'id' => $produto['id'],
                'titulo' => $produto['titulo'],
                'valor' => $valor,
                'quantidade' => 1,
                'total' => $valor,
                'imagem' => $produto['imagem'] ?? []
            ];
        }
        return $result;
    }

    public function checarCarrinho($id, $carrinho)
    {
        $resultado = false;
        foreach ($carrinho as $item) {
            if ($item['id'] == $id) {
                $resultado = true;
                break;
            }
        };
        return $resultado;
    }

    public function alterarCarrinho($id, $carrinho, $metodo)
    {
        $novoCarrinho = $carrinho;
        foreach ($carrinho as $key => $item) {
            if ($item['id'] == $id) {
                if ($metodo == 'aumentar') {
                    $novoCarrinho[$key]['quantidade'] += 1;
                    $novoCarrinho[$key]['total'] += $novoCarrinho[$key]['valor'];
                } elseif ($metodo == 'diminuir') {
                    if ($novoCarrinho[$key]['quantidade'] != 1) $novoCarrinho[$key]['quantidade'] -= 1;
                    $novoCarrinho[$key]['total'] -= $novoCarrinho[$key]['valor'];
                } elseif ($metodo == 'remover') {
                    unset($novoCarrinho[$key]);
                }
                break;
            }
        };
        return $novoCarrinho;
    }
}
