<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_crm_oportunidades extends Model
{
    use HasFactory;

    protected $table = 'app_crm_oportunidades';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'titulo', 'status','motivo_perda_id', 'avaliacao', 'valor_unico','valor_recorrente','rel_fonte', 'rel_contato', 'rel_usuario', 'rel_funil','origem', 'campos', 'data_criacao', 'data_fechamento', 'created_at', 'updated_at'];
    protected $dates = ['data_criacao', 'data_fechamento', 'created_at', 'updated_at'];
}
