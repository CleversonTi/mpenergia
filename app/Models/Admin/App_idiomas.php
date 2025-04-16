<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_idiomas extends Model
{
    use HasFactory;
    protected $table = 'app_idiomas';
    protected $primaryKey = 'id';
    protected $fillable = ['id','titulo','sigla','thumb','fixo'];
    public $timestamps = false;
}
