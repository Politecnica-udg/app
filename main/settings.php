<?php
    global $conf_host;

    $activate = TRUE;
    
    $data_base = TRUE;
        $type_db = ""; //MySQL
        define('host', 'localhost');
        define('user', 'root');
        define('pw', 'norman95');
        define('db', 'app');
    $INSTALLED_APPS = [
        "general",
        "alumnos",
        "maestros",
        "admon",
        "empresas",
    ];
    $conf_host = [
      'host' => 'http://localhost/Otros/app/',
      'lang' => 'es'
    ];
   if ($data_base) {
     require_once 'db.php';
   }
   login_app($INSTALLED_APPS);
  $objects = [
        "poli" => new poli(),
        "alumnos" => new alumnos(),
        "maestros" => new maestros(),
        "admon" => new admon(),
        "empresas" => new empresas(),
   ];
    if ($activate) {
      require_once 'url.php';
    }else{
      $objects['principal']->system_off();
    }
?>