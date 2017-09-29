<?php
//declaração dos namespaces dos controladores e instanciação dos objetos

//declaração de inicio da sessão para que não seja criada mais de uma vez
session_start();

use Project\Controller\VelhaController;
$velhaController = new VelhaController();

use Project\Controller\LoginController;
$loginController = new LoginController();


//configuração do banco de dados. Neste projeto, não foram utilizadas
$_ENV['config'] = [
    'host' => 'localhost',
    'dbname' => 'bd',
    'user' => 'root',
    'password' => '',
];
