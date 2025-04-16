<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_conteudo extends Model
{
    use HasFactory;

    protected $table = 'app_conteudo';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'pai_id',
        'status',
        'conf_pagina',
        'conf_internas',
        'conf_bloquear',
        'conf_nao_excluir',
        'filho_pagina',
        'filho_internas',
        'filho_nao_excluir'
    ];



    static function obterConteudo($id, $array = false)
    {

        $dados = App_conteudo::all()->where('status', 1);

        if ($array && !empty($dados)) {

            $dados = $dados->toArray();
        }

        return $dados;

    }



}
