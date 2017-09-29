<?php
namespace Project\Controller;

use Project\Db\QueryBuilder;
use Project\Util\Flash;

class LoginController
{

    //esse método retorna a página de registro
    public function register()
    {
        // recebe qualquer mensagem flash disparada anteriormente
        $flash = Flash::getFlash();

        //mostra a view de registro
        require './app/views/register.php';
    }

    // esse método recebe os dados para registrar um usuário
    public function postRegister()
    {
        //recebe os dados de email e senha
        $dados['email'] = htmlentities($_POST['email'], ENT_QUOTES);
        $dados['password'] = htmlentities($_POST['senha'], ENT_QUOTES);
        $csenha = htmlentities($_POST['csenha'], ENT_QUOTES);

        //compara os dois campos de senha, devolvendo uma mensagem flash caso sejam diferentes
        if ($dados['password'] !== $csenha) {
            Flash::setFlash('As senhas não conferem');
            header('Location: /register');
            exit;
        }

        // criptografa a senha para guardar no banco de dados. 
        // a sequencia que passei é bem fraca, mas é um exemplo de salt
        $dados['password'] = crypt($dados['password'], '123456');

        $q = new QueryBuilder();
        $cadastrado = $q->insert('users', $dados);
        
        // se não foi possivel realizar o cadastro, como por exemplo, email repetido
        // dispara um mensagem flash
        if (!$cadastrado) {
            Flash::setFlash('Dados inválidos');
            header('Location: /register');
            exit;
        }

        // guarda o email do usuario na session
        $_SESSION['user'] = $dados['email'];

        //chama o método de configuração inicial do jogo
        header('Location: /start');

    }

    //metodo para realizar o login do usuário
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
       
        // se o usuário não foi encontrado no banco de dados
        // emite uma mensagem de erro
        if (!$cadastrou) {
            Flash::setFlash('Dados inválidos');
            header('Location: /');
            exit;
        }

        // autentica o usuário
        $_SESSION['user'] = $dados['email'];
        
        header('Location: /start');
    }

    public function logout()
    {
        //remove todas variáveis criadas de sessão
        session_unset();

        //devolve para a página inicial
        header('Location: /');
    }

    

    
}