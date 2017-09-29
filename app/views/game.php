<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./public/css/game.css">
</head>

<body>
   
    <?php if($flash == 'winner'){ ?>
        <div class="panel">
            <h4>Temos um Vencedor: <?= $_SESSION['vencedor']?> !</h4> 
            <a href="/start">Reiniciar partida</a>
        </div>
    
    <?php }elseif($flash == 'velha'){ ?>   
        <div class="panel">
            <p>Ichii, deu velha</p>
            <a href="/start">Reiniciar partida</a>
                
        </div>
        
    <?php }elseif($flash){ ?>   
        <div class="panel">
                <p><?= $flash ?></p>
        </div>
        
    <?php } ?>

    <div class="logout"> <a href="/logout">Logout</a> </div>

    <form method="post" action="/jogada">
        <div class="ticTacToe">
            <?php for ($i=1; $i < 9; $i+= 3) { ?>
                <div class="column">
                    <button class="square"  name="<?= $i ?>"><?= $valores[$i] ?></button>
                    <button class="square"  name="<?= $i+1 ?>"><?= $valores[$i+1] ?></button>
                    <button class="square"  name="<?= $i+2 ?>"><?= $valores[$i+2] ?></button>
                </div>
            <?php } ?>
                
        </div>
    </form>
     

</body>

</html>