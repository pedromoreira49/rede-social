<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>Styles/styles.css" rel="stylesheet">
</head>
<body>
	<div class="sidebar"></div>

	<div class="form-container-login">
		<div class="logo">
			<img src="<?php echo INCLUDE_PATH_STATIC ?>images/logo-redesocial.png">
			<p>Junte-se a outras pessoas e venha fazer parte deste mar de conhecimentos.</p>
		</div><!--LOGO-->

		<div class="form-login">
			<form method="post">
				<input type="text" name="email" placeholder="E-mail...">
				<input type="password" name="senha" placeholder="Senha...">
				<input type="submit" name="acao" value="Logar!">
			</form>
			<p><a href="<?php echo INCLUDE_PATH ?>registrar">Criar Conta</a></p>
		</div><!--FORM-LOGIN-->

	</div><!--FORM-CONTAINER-LOGIN-->
</body>
</html>