<?php
//rotas da aplicação
//a variável $uri já contém os dados da rota solicitada

switch ($uri) {
    
    case '/';

        $velhaController->index();
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

        $loginController->login();
        break;

    case '/register';

        $loginController->register();
        break;

    case '/post-register';

         $loginController->postRegister();
        break;
    
    default:
        die('Essa rota não é valida');
        break;
}
