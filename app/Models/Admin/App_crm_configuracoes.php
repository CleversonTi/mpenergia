<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model responsável pela tabela app_idiomas (idiomas da App).
 * @author Danilo Fernando
 * @author Gabriel Oliveira
 * @copyright © 2021 Raddar Digital
 */
class App_crm_configuracoes extends Model
{
    use HasFactory;

    protected $table = 'app_crm_configuracoes';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'tipo', 'usuarios_destino', 'usuario_registro', 'etapa_funil','contato_existente_opt_aberta','contato_existente_opt_fechada'];
    public $timestamps = false;
}
