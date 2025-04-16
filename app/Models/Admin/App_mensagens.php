<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_mensagens extends Model
{
    use HasFactory;
    protected $table = 'app_mensagens';
    protected $primaryKey = 'id';
    protected $fillable = ['id','form_name','nome','email','telefone','campos','idioma','created_at','updated_at'];
}
