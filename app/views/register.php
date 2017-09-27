<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./public/css/bootstrap.css" rel="stylesheet">
    <link href="./public/css/register.css" rel="stylesheet">
</head>

<body>

  <div class="container">



        <div class="card card-container">

            <?php if($flash) { ?>
                <div class="alert alert-danger text-center" role="alert"><?= $flash ?></div>
            <?php } ?>

            <form class="form-signin" method="post" action="/post-register">
            <h1 class="text-center">Registrar</h1>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
                <input type="password" id="inputPassword" name="csenha" class="form-control" placeholder="Confirmar Senha" required>
                
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Cadastrar</button>
            </form><!-- /form -->
           
        </div><!-- /card-container -->
    </div><!-- /container -->
   
</body>

</html>