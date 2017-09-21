<?php
namespace Project\Controller;

use Project\Db\QueryBuilder;

class VelhaController
{

    public function __construct()
    {
        session_start();
    }
    
    public function start()
    {
        $_SESSION['jogador'] = true;
        $_SESSION['vencedor'] = false;

        session_unset();

        header('Location: /game');
        
    }

    public function game()
    {
     
      $flash = false;
        // verifica se existe menssagem flash para sere impressa na view
        if( array_key_exists('flash', $_SESSION)){
             $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        // atribui os valores as devidas casas
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
        // TODO: melhorar essa logica

        $casa = 0;
        foreach ($_POST as $key => $value) {
            if(isset($value)){
                $casa = $key;
                break;
            }
        }
        
        // verifica se a casa já foi preenchida
        if(array_key_exists('n' . $casa, $_SESSION)){
            $_SESSION['flash'] = 'Esse campo já foi escolhido';
            header('Location: /game');
            exit;
        }


        // guarda jogada na sessão
        $_SESSION['n' . $casa] = $_SESSION['jogador'] ? 'X' : 'O';
        $_SESSION['jogador'] = !$_SESSION['jogador'];

          // verifica se ouve vencedor
        if( $this->hasVencedor() ){
            $_SESSION['flash'] = 'winner';
           
        }

        //volta ao tabuleiro
        header('Location: /game');

    }

    public function hasVencedor()
    {
        $v = $_SESSION;
      
      $branco = true;

      //verifica se todos estão brancos
      for ($i=1; $i <= 9; $i+= 3) { 
        $branco = !isset($v['n' . $i]) ;
        if(!$branco) break;
      }

      //se todos estiverem brancos, retorne sem vencedores
      if($branco) return false;

        // verfica colunas e linhas 
        for ($i=1; $i <= 9; $i+= 3) { 

            //verifica linhas
            // if(isset($v['n'. $i] ) && isset($v['n'  . ($i+1)]) && isset($v['n'. ($i+2)]) ){
          
                if($v['n' . $i] ==  $v['n' . ($i+1)]  && $v['n' . ($i+2)] == $v['n' . $i] && $v['n' . $i] != null){
                    die(); exit;
                    $_SESSION['vencedor'] = $v['n' . $i];
                    return true;
                }
                     
           // }

            //verifica colunas
            //if(isset($v['n'. $i] ) && isset($v['n'  . ($i+3)]) && isset($v['n'. ($i+6)]) ){
                
                if($v['n' . $i] == $v['n' . ($i+3)] && $v['n' . ($i+6)] == $v['n' . $i] && isset($v['n' . $i])){
                    
                    $_SESSION['vencedor'] = $v['n' . $i];
                    return true;
                }
           
            //}
        }

        // verifica diagonal direita-esquerda
       // if(isset($v['n1'] ) && isset($v['n5']) && isset($v['n9']) ){
                
                if($v['n1'] == $v['n5']  && $v['n1'] == $v['n9'] && isset($v['n1'])){
                    
                    $_SESSION['vencedor'] = $v['n1'];
                    return true;
                }
       // }

        // verifica diagonal esquerda-direita
       // if(isset($v['n3'] ) && isset($v['n5']) && isset($v['n7']) ){
              
                if($v['n3'] == $v['n5']  && $v['n7'] == $v['n3'] && isset($v['n3'])){
                    
                    $_SESSION['vencedor'] = $v['n3'] ;
                    return true;
                }
        //}

        return false;

    }
}