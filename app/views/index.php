<!DOCTYPE html>
<html lang="en">

<head>
	<!-- Basic informations -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!-- Site informations -->
	<title>Jogo da velha</title>


	<!-- Fonts -->
	<link href="./public/css/bootstrap.css" rel="stylesheet">

	<link href="./public/index/fonts/webfont-raleway/webfont-raleway.css" rel="stylesheet" type="text/css">
	<link href="./public/index/fonts/webfont-font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">


	<!-- Stylesheets -->
	<link href="./public/index/css/global.css" type="text/css" rel="stylesheet" media="all">

</head>

<body>

	<!-- Some Helper Stuff -->
	<div id="start" class="start">&nbsp;</div>
	<div class="maxwidth1050">&nbsp;</div>

	<!-- Header -->
	<header class="header">
		<div class="header__wrapper">

			<a href="#start" class="header__title-wrapper  js-smooth-scroll">
				<div class="header__title-main">Jogo da Velha Online</div>
				<div class="header__title-sub">By Professor Binho</div>
			</a>
			<div class="header__social-icons">
				<form class="navbar-form " role="search" action="/login" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="email" placeholder="Email">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="senha" placeholder="Senha">
					</div>
					<button type="submit" class="btn btn-default">Entrar</button>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header -->

	

	<!-- First Fixed "Hero" Section -->
	<section id="hero" class="hero">
		<div class="hero__gradient">&nbsp;</div>
		<div class="hero__content">
			<div class="hero__content-wrapper">
				<div class="hero__title-wrapper">
					<div class="hero__title-large">Ola!</div>
					<div class="hero__title-small">Vamos jogar o Jogo da Velha?.</div>
				</div>
				<?php if($flash) { ?>
                <div class="alert alert-danger text-center" role="alert"><?= $flash ?></div>
            <?php } ?>
				<div class="hero__description">
					O jogo da velha, além de divertido, é um excelente exemplo para começar a desenvolver jogos. Esse foi feito para web! Confira
					fazendo seu cadastro!
				</div>
				<div class="hero__call-to-action">
					<a href="/register" class="hero__button  ghost-button  ghost-button--hero">Cadastrar</a>
				</div>
			</div>
		</div>
	</section>
	<!-- End First Fixed "Hero" Section -->

</body>

</html>