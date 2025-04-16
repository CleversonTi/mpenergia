<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_crm_historico extends Model
{
    use HasFactory;

    protected $table = 'app_crm_historico';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'oportunidade_id', 'usuario_nome','interacao', 'anotacao', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];
}
