<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_recuperarSenha extends Model
{
    use HasFactory;
    protected $table = 'app_recuperarsenha';
    protected $primaryKey = 'id';
    protected $fillable = ['id','usuario_id','usuario_email','token','data'];
    public $timestamps = false;
}
