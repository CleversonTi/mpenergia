<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_conteudo_valor extends Model
{
    use HasFactory;

    protected $table = 'app_conteudo_valor';
    protected $primaryKey = 'id';
    protected $fillable = ['id','conteudo_id', 'configuracao_id', 'valor', 'idioma_id', 'ordem_valor'];
    public $timestamps = false;


    static function retornarValor($conteudo_id = '', $configuracao_id = '', $idioma_id = '')
    {


        if ($conteudo_id) {

            return App_conteudo_valor::
                where('conteudo_id', $conteudo_id)
                ->where('configuracao_id', $configuracao_id)
                ->where('idioma_id', $idioma_id)
                ->get()->toArray();


        }
    }


}
