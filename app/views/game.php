<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./public/css/bootstrap.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            vertical-align: center;
            flex-wrap: wrap;
            align-content: center;

            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(to top, #222, #333);
        }


        .ticTacToe {
            display: flex;
            justify-content: space-between;

            width: 400px;
            height: 400px;
            padding: 5px;
            /*border  : 1px solid #e4e4e4;*/
        }


        .column {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        button, input[type="submit"], input[type="reset"] {
            background: none !important;
            color: inherit;
            border: none;
            padding: 0! important;
            font: inherit;
            cursor: pointer;
            outline: inherit !important;
        }
        .square {
            display: block;
            width: 125px;
            height: 125px;
            border: 1px solid #e4e4e4;

            color: #e4e4e4;
            font-size: 5em;
            font-weight: 100;
            text-align: center;
            padding: 20px;
          
        }
    </style>
</head>

<body>
    <div class="container">
      <p style="color: white;"><?= $flash? $flash : ''?></p>
    </div>
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