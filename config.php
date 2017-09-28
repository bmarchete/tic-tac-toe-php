<?php
//declaração dos namespaces dos controladores e instanciação dos objetos
session_start();

use Project\Controller\VelhaController;
$velhaController = new VelhaController();

use Project\Controller\LoginController;
$loginController = new LoginController();


//configuração do banco de dados
$_ENV['config'] = [
    'host' => 'localhost',
    'dbname' => 'bd',
    'user' => 'root',
    'password' => '',
];
