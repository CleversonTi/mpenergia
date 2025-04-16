<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_crm_contatos extends Model
{
    use HasFactory;
    protected $table = 'app_crm_contatos';
    protected $primaryKey = 'id';
    protected $fillable = ['id','empresa','nome','telefone','email','endereco','cidade','estado','cep','adicional','created_at','updated_at'];
    protected $dates = ['created_at', 'updated_at'];
}
