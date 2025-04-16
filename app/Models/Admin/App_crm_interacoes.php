<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_crm_interacoes extends Model
{
    use HasFactory;

    protected $table = 'app_crm_interacoes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'texto_registro', 'texto_acao', 'icone','created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
}
