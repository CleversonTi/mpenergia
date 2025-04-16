<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_config extends Model
{
    use HasFactory;

    protected $table = 'app_config';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'campo', 'label', 'instrucao', 'valor'];
    public $timestamps = false;
}
