<?php
namespace Project\Controller;

use Project\Db\QueryBuilder;
use Project\Util\Flash;

class LoginController
{

    public function register()
    {
        $flash = Flash::getFlash();
        require './app/views/register.php';
    }

    public function postRegister()
    {
        $dados['email'] = htmlentities($_POST['email'], ENT_QUOTES);
        $dados['password'] = htmlentities($_POST['senha'], ENT_QUOTES);
        $csenha = htmlentities($_POST['csenha'], ENT_QUOTES);

        
        if ($dados['password'] !== $csenha) {
            Flash::setFlash('As senhas não conferem');
            header('Location: /register');
            exit;
        }

        $dados['password'] = crypt($dados['password'], '123456');

        $q = new QueryBuilder();
        $cadastrado = $q->insert('users', $dados);
        

        if (!$cadastrado) {
            Flash::setFlash('Dados inválidos');
            header('Location: /register');
            exit;
        }


        $_SESSION['user'] = $dados['email'];
        header('Location: /start');

    }

    public function login()
    {
        $dados['email'] = htmlentities($_POST['email'], ENT_QUOTES);
        $dados['password'] = htmlentities($_POST['senha'], ENT_QUOTES);

        $dados['password'] = crypt($dados['password'], '12345');
        $q = new QueryBuilder();
        $cadastrou = $q->select('users', [
            'email' => $dados['email'], 
            'password' => $dados['password']
        ]);
       
        if (!$cadastrou) {
            Flash::setFlash('Dados inválidos');
            header('Location: /');
            exit;
        }

        $_SESSION['user'] = $dados['email'];
        
        header('Location: /start');
    }

    
}