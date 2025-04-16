<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_conteudo_campos extends Model
{
    use HasFactory;

    protected $table = 'app_conteudo_campos';
    protected $primaryKey = 'id';
    protected $fillable = ['id','conteudo_id', 'filho', 'type', 'rel','options','label', 'name', 'seo','default_value', 'instruction', 'ordem', 'status'];
    public $timestamps = false;

}
