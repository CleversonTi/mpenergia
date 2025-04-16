<?php

/*  DB  */

$modeDb = 'development';

if ($modeDb == 'development') {
    $debug = true;
    $host = "localhost";
    $porta = 3306;
    $user = "root";
    $db = "treinamento-raddar-2025";
    $password = "";
}

if ($modeDb == 'production') {
    $debug = false;
    $host = "asthamed.mysql.dbaas.com.br";
    $porta = 3306;
    $user = "asthamed";
    $db = "asthamed";
    $password = "Asth@2025";
}


/*
 *
 *  Após efetuar as alterações de DB, execute o comando:
 *  php artisan config:cache
 *
 *
 * */
