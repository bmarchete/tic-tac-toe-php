<?php
//rotas da aplicação
//a variável $uri já contém os dados da rota solicitada

switch ($uri) {
    
    case '/':
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
    
    default:
        die('Essa rota não é valida');
        break;
}
