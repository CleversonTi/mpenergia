<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Funcoes\HelpersController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;

class FormularioEnviadoController extends SiteController
{
    public function index()
    {
        // SEO
        $this->gerarSeo();

        return view('default.formulario-enviado', [
            'titulo' => 'Formulário Enviado',
            'page'=>['descricao'=>'<h1>Formulário enviado!</h1>']
        ]);
    }
}
