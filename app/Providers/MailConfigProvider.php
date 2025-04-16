<?php

namespace App\Providers;

use App\Models\Admin\App_config;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class MailConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // get email view data in provider class
//        $configMail = self::appconfig();
//
//
//        $config = array(
//            'driver' => 'smtp',
//            'host' => $configMail['smtp_host'],
//            'port' => $configMail['smtp_porta'],
//            'username' => $configMail['smtp_email'],
//            'password' => $configMail['smtp_senha'],
//            'encryption' => $configMail['smtp_certificado'],
//            'from' => array('address' => $configMail['smtp_email'], 'name' => $configMail['titulo_site']),
//        );
//        Config::set('mail', $config);
    }

    static function appconfig()
    {


        $confAll = App_config::
        where('campo', 'smtp_host')
            ->orWhere('campo', 'smtp_porta')
            ->orWhere('campo', 'smtp_email')
            ->orWhere('campo', 'smtp_senha')
            ->orWhere('campo', 'smtp_certificado')
            ->orWhere('campo', 'titulo_site')
            ->get()
            ->toArray();

        $confArray = [];

        foreach ($confAll as $key => $item) {
            $confArray[$item['campo']] = json_decode($item['valor'], true);
        }

        return $confArray;

    }
}
