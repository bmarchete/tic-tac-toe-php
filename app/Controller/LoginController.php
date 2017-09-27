<?php
namespace Project\Controller;

use Project\Db\QueryBuilder;

class LoginController
{

    public function register()
    {

        $flash = false;
        // verifica se existe menssagem flash para sere impressa na view
        if( array_key_exists('flash', $_SESSION)){
             $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
        }

        require './app/views/register.php';
    }
    public function postRegister()
    {
        $dados['email'] = htmlentities($_POST['email'], ENT_QUOTES);
        $dados['password'] = htmlentities($_POST['senha'], ENT_QUOTES);
        $csenha = htmlentities($_POST['csenha'], ENT_QUOTES);

        
        if ($dados['password'] !== $csenha) {
            $_SESSION['flash'] = 'As senhas não conferem';
            header('Location: /register');
            exit;
        }

        $dados['password'] = crypt($dados['password'], '123456');
        //acessar o bd
        $q = new QueryBuilder();
        //cadastra usuário
        $cadastrado = $q->insert('users', $dados);
        

        if (!$cadastrado) {
            $_SESSION['flash'] = 'Dados inválidos';
            header('Location: /register');
            exit;
        }

        header('Location: /start');

    }

    public function login()
    {
        $dados['email'] = htmlentities($_POST['email'], ENT_QUOTES);
        $dados['password'] = htmlentities($_POST['senha'], ENT_QUOTES);

        $dados['password'] = crypt($dados['password'], '12345');
        $q = new QueryBuilder();
        $cadastrado = $q->select('users', ['email' => $dados['email'], 'password' => $dados['password']]);
       
        if (!$cadastrado) {
            $_SESSION['flash'] = 'Dados inválidos';
            header('Location: /');
            exit;
        }

        $_SESSION['user'] = $dados['email'];
        
        header('Location: /start');
    }
}