<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App_upload extends Model
{
    use HasFactory;

    protected $table = 'app_upload';
    protected $primaryKey = 'id';
    protected $fillable = ['id','file','type'];
    public $timestamps = false;




}
