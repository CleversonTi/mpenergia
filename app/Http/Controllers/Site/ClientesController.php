<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Funcoes\PluginController;
use App\Http\Controllers\SiteController;

class ClientesController extends SiteController
{
    private $plugin;
    public function setPlugin(PluginController $plugin)
    {
        $this->plugin = $plugin;
    }
    public function index()
    {
        $this->setPlugin(new PluginController);
        $page = $this->getBudgetPage();
        $this->getSeoAndBreadCrumb();

        $plugin = new PluginController();
        $plugin->setId(SiteController::BENEFICIOS);
        $beneficios = $plugin->obterCampos();

        return view('layout.pages.' . 'index.index', [
            'page' => $page,
            'beneficios' => $beneficios,
        ]);
    }

    public function getBudgetPage()
    {
        $this->plugin->setId(SiteController::CLIENTES);
        return $this->plugin->obterCampos();
    }

    public function getSeoAndBreadCrumb()
    {
        $this->gerarSeo();
        $this->plugin->addBreadCrumb(['home', route('home')]);
        $this->plugin->addBreadCrumb(['clientes', route('clientes')]);
    }
}
