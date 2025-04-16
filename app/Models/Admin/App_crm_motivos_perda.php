<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_crm_motivos_perda extends Model
{
    use HasFactory;

    protected $table = 'app_crm_motivos_perda';
    protected $primaryKey = 'id';
    protected $fillable = ['id','titulo', 'descricao', 'status', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

}
