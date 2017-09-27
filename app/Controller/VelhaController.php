<?php
namespace Project\Controller;

use Project\Db\QueryBuilder;

class VelhaController
{

    public function __construct()
    {
        session_start();
    }

    public function index()
    {
        $flash = false;
        // verifica se existe menssagem flash para sere impressa na view
        if( array_key_exists('flash', $_SESSION)){
             $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        require './app/views/index.php';
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
      
        // verfica colunas
        for ($i=1; $i <= 9; $i+= 3) { 
             if(isset($v['n'. $i] ) && isset($v['n'  . ($i+1)]) && isset($v['n'. ($i+2)]) ){
               
                if($v['n' . $i] == 'X' && $v['n' . ($i+1)] == 'X' && $v['n' . ($i+2)] == 'X'){
                   
                    $_SESSION['vencedor'] = 'X';
                    return true;
                }

                if($v['n' . ($i)] == 'O' && $v['n' . ($i+1)] == 'O' && $v['n' . ($i+2)] == 'O'){
                    $_SESSION['vencedor'] = 'O';
                    return true;
                }         
                   
            }
        }
        
        //verifica linhas
        for ($i=1; $i <= 3; $i++) { 

            if(isset($v['n'. $i] ) && isset($v['n'  . ($i+3)]) && isset($v['n'. ($i+6)]) ){
               
                if($v['n' . $i] == 'X' && $v['n' . ($i+3)] == 'X' && $v['n' . ($i+6)] == 'X'){
                    
                    $_SESSION['vencedor'] = 'X';
                    return true;
                }

                if($v['n' . ($i)] == 'O' && $v['n' . ($i+3)] == 'O' && $v['n' . ($i+6)] == 'O'){
                    
                    $_SESSION['vencedor'] = 'O';
                    return true;
                }         
                
            }
           
        }

        // verifica diagonal direita-esquerda
        if(isset($v['n1'] ) && isset($v['n5']) && isset($v['n9']) ){
                //  echo '<p style="color:white;">aqui</p>';
                if($v['n1'] == 'X' && $v['n5'] == 'X' && $v['n9'] == 'X'){
                    
                    $_SESSION['vencedor'] = 'X';
                    return true;
                }

                if($v['n1'] == 'O' && $v['n5'] == 'O' && $v['n9'] == 'O'){
                    
                    $_SESSION['vencedor'] = 'O';
                    return true;
                }         
        }

        // verifica diagonal esquerda-direita
        if(isset($v['n3'] ) && isset($v['n5']) && isset($v['n7']) ){
                //  echo '<p style="color:white;">aqui</p>';
                if($v['n3'] == 'X' && $v['n5'] == 'X' && $v['n7'] == 'X'){
                    
                    $_SESSION['vencedor'] = 'X';
                    return true;
                }

                if($v['n3'] == 'O' && $v['n5'] == 'O' && $v['n7'] == 'O'){
                    
                    $_SESSION['vencedor'] = 'O';
                    return true;
                }         
        }

        return false;

    }
}