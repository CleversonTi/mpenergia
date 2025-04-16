<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_logs extends Model
{
    use HasFactory;
    protected $table = 'app_logs';
    protected $primaryKey = 'id';
    protected $fillable = ['id','usuario', 'conteudo', 'conteudo_id', 'idioma_id', 'tipo', 'created_at'];
    public $timestamps = true;
}
