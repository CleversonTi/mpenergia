<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_usuarios extends Model
{
    use HasFactory;

    protected $table = 'app_usuarios';
    protected $primaryKey = 'id';
    protected $fillable = ['id','nome','email','telefone','senha','cargo','listar','ler','editar','inserir','conf','users','messages','dev','permissao_geral','permissao_paginas','created_at','updated_at'];
}
