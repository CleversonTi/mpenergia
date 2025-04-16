<?php

namespace App\Http\Controllers\Funcoes;


use App\Models\Admin\App_config;
use App\Models\Admin\App_conteudo_valor;
use App\Models\Admin\App_idiomas;
use App\Models\Admin\App_upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller as BaseSiteController;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\URL;

//use Intervention\Image\ImageManager;


class UploadController extends BaseSiteController
{
    //
    public function upload(Request $request, $type = 'Não definido')
    {

        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,doc,docx,pdf,rtf|max:5000',
        ]);

        $request->file->getClientOriginalName();

        $nome_final = $this->checarExistencia($request->file->getClientOriginalName());


        $request->file->move(public_path('uploads/arquivos'), $nome_final);

        if ($nome_final) {
            echo json_encode(array('file' => $nome_final, 'file_url' => URL::to('uploads/arquivos/' . $nome_final)));
        }

        exit;


    }

    public function checarExistencia($name = '')
    {


        if (!empty($name)) {
            $file_extension = pathinfo($name, PATHINFO_EXTENSION);
            $newName = 'arquivo_' . date('dmYHms') . '.' . $file_extension;
            return $newName;
        }


    }

}
