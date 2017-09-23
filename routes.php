<?php
//rotas da aplicação
//a variável $uri já contém os dados da rota solicitada

switch ($uri) {
    
    case '/';

        require './app/views/index.php';
        break;

    case '/start':
        $velhaController->start();
        break;
   
    case '/game':
        $velhaController->game();
       
        break;
   
    case '/jogada':

        $velhaController->jogada();

        break;

    case '/winner';
        die('winner');
        break;

    case '/login';

        require './app/views/login.php';
        break;

    case '/register';

        require './app/views/register.php';
        break;

    case '/post-register';

         $loginController->postRegister();
        break;
    
    default:
        die('Essa rota não é valida');
        break;
}
