<?php

namespace App\Controllers;

/**
* BaseController
*/
class BaseController
{

    public function __construct()
    {
    }
    
    public function __destruct()
    {
    }

    public function test()
    {
        echo 'server:';
        var_dump($_SERVER);
        echo 'request:';
        var_dump($_REQUEST);
        echo 'get:';
        var_dump($_GET);
        echo 'post';
        var_dump($_POST);
        echo 'cookie';
        var_dump($_COOKIE);
        echo 'file:';
        var_dump($_FILES);
    }
}
