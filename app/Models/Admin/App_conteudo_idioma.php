<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_conteudo_idioma extends Model
{
    use HasFactory;
    protected $table = 'app_conteudo_idioma';
    protected $primaryKey = 'id';
    protected $fillable = ['id','conteudo_id','titulo','uri','idioma_id','seo_description','seo_image','seo_description_manual','seo_image_manual','seo_keywords'];
    public $timestamps = false;
}
