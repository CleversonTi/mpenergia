<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_crm_funil extends Model
{
    use HasFactory;

    protected $table = 'app_crm_funil';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nome', 'descricao', 'etapa', 'created_at', 'updated_at'];
}
