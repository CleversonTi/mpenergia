<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_crm_tarefas extends Model
{
    use HasFactory;

    protected $table = 'app_crm_tarefas';
    protected $primaryKey = 'id';
    protected $fillable = ['id','finalizada', 'rel_oportunidade', 'rel_usuario', 'interacao', 'assunto', 'anotacao', 'data','created_at', 'updated_at'];
    protected $dates = ['data', 'created_at', 'updated_at'];

}
