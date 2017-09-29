<?php
namespace Project\Controller;

use Project\Db\QueryBuilder;
use Project\Util\Flash;
use Project\Util\Login;

class VelhaController
{
    //esse método é chamado quando a página inicial é acionada
    public function index()
    {

        // se estiver logado, vai para o começo do jogo
        if(Login::isLogged()){
            header('Location: /start');
            exit;
        }

        //caso haja alguem disparando uma mensagem flash, recebe a mensagem
        $flash = Flash::getFlash();

        //chama a página principal
        require './app/views/index.php';
    }
    
    //esse método é chamado toda vez que o jogo precisa ser iniciado ou reiniciado
    public function start()
    {
        //só permite continuar o jogo se a pessoa estiver logada
        if(!Login::isLogged()){
            header('Location: /');
            exit;
        }

        //essas variáveis definem se o jogardor é X ou O (0 ou 1//true ou false)
        //e que ainda não existem vencedores
        $_SESSION['jogador'] = true;
        $_SESSION['vencedor'] = false;

       // esse trecho tira toda tentativa anterior de jogadas da sessão
       for ($i=1; $i <= 9; $i++) { 
            if(array_key_exists('n' . $i, $_SESSION)){
                unset($_SESSION['n' . $i]);
            }
        }

        //redireciona para o método que apresenta o tabuleiro
        header('Location: /game');
        
    }

    //esse método é chamado toda vez que o tabuleiro precisa ser mostrado
    public function game()
    {

        //se a pessoa não estiver logada, não pode jogar
        if(!Login::isLogged()){
            header('Location: /');
            exit;
        }

        //recebe possíveis mensagens para imprimir na view
        $flash = Flash::getFlash();
     
        // esse trecho cria o array $valores que é impresso na view
        //se existem as chaves com as posições devidas na Session,
        //ele atribui. Senão, ele atribui vazio.
        //Desse modo, basta percorrer esse array imprimindo os valores na view
        for ($i=1; $i <= 9; $i++) { 
            if(array_key_exists('n' . $i, $_SESSION)){
                $valores[$i] = $_SESSION['n' . $i];
            }else{
                $valores[$i] = '';
            }
        }
      
        
        require './app/views/game.php';

    }

    public function jogada()
    {

        // percorre o vetor $_POST procurando a chave válida. 
        // Como cada botão tem um nome diferente, precisamos saber qual deles foi clicado
        // Quando encontramos, atribuimos o nome do botão à variável casa
        // que vai ser usada mais adiante para definir as casas da Session
        $casa = 0;
        foreach ($_POST as $key => $value) {
            if(isset($value)){
                $casa = $key;
                break;
            }
        }
        
        // verifica se a casa escolhida em $casa já foi clicada anteriormente
        if(array_key_exists('n' . $casa, $_SESSION)){
            Flash::setFlash('Esse campo já foi escolhido');
            header('Location: /game');
            exit;
        }


        // guarda jogada na sessão
        //a variável casa compoe o nome da sessão, que não pode ser apenas um numero
        //pois precisa ser um array associado. Por exemplo: n3
        $_SESSION['n' . $casa] = $_SESSION['jogador'] ? 'X' : 'O';
        $_SESSION['jogador'] = !$_SESSION['jogador'];

          // verifica se ouve vencedor ou deu velha
        if( $this->hasVencedor() ){
            Flash::setFlash('winner');
           
        } else  if( $this->hasVencedor() == 'velha'){
            Flash::setFlash('velha');
           
        }

        //volta ao tabuleiro
        header('Location: /game');

    }

    private function hasVencedor()
    {
        $v = $_SESSION;
      
        // verfica as casas que representam as colunas perguntando se estao preenchidas.
        // se estiverem, verifica se todas tem o mesmo valor. Caso sim, retorna o valor
        // de uma das casas do array
        for ($i=1; $i <= 9; $i+= 3) { 
             if(isset($v['n'. $i] ) && isset($v['n'  . ($i+1)]) && isset($v['n'. ($i+2)]) ){
               
                if($v['n' . $i] == $v['n' . ($i+1)] && $v['n' . ($i+2)] == $v['n' . $i]){
                   
                    $_SESSION['vencedor'] = $v['n' . $i];
                    return true;
                }

            }
        }
        
        // verfica as casas que representam as linhas perguntando se estao preenchidas.
        // se estiverem, verifica se todas tem o mesmo valor. Caso sim, retorna o valor
        // de uma das casas do array
        for ($i=1; $i <= 3; $i++) { 

            if(isset($v['n'. $i] ) && isset($v['n'  . ($i+3)]) && isset($v['n'. ($i+6)]) ){
               
                if($v['n' . $i] == $v['n' . ($i+3)] && $v['n' . ($i+6)] == $v['n' . $i]){
                    
                    $_SESSION['vencedor'] = $v['n' . $i];
                    return true;
                }

            }
           
        }

        // verifica diagonal direita-esquerda
        if(isset($v['n1'] ) && isset($v['n5']) && isset($v['n9']) ){
                //  echo '<p style="color:white;">aqui</p>';
                if($v['n1'] == $v['n5'] && $v['n9'] == $v['n1']){
                    
                    $_SESSION['vencedor'] = $v['n1'];
                    return true;
                }
        }

        // verifica diagonal esquerda-direita
        if(isset($v['n3'] ) && isset($v['n5']) && isset($v['n7']) ){
                //  echo '<p style="color:white;">aqui</p>';
                if($v['n3'] == $v['n5'] && $v['n7'] == $v['n3']){
                    
                    $_SESSION['vencedor'] = $v['n3'];
                    return true;
                }
        }

        //verfica se todos foram preenchidos mas não houve vitória (velha)
        if(isset($v['n1'] ) && isset($v['n2']) && isset($v['n3']) &&
           isset($v['n4'] ) && isset($v['n5']) && isset($v['n6']) &&
           isset($v['n7'] ) && isset($v['n8']) && isset($v['n9'])
           ){ return 'velha';}


        // se nenhuma das regras acima foi satisfeita, retorna false indicando
        // que o jogo ainda não terminou
        return false;

    }
}