<!DOCTYPE html>
<html>
<head>
	<!--ALTERAR TITULO-->
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>Styles/feed.css" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>Styles/comunidade.css" rel="stylesheet">


</head>

<body>

	<section class="main-feed">
		<?php 
			include('includes/sidebar.php'); 
		?>
		<div class="feed">
			<div class="comunidade">
			<div class="container-comunidade">
					<h4>Amigos</h4>
					<div class="container-comunidade-wraper">
						<?php 
							foreach(\ClassesMVC\Models\UsuariosModel::listarAmigos() as $key => $value){
						?>

						<div class="container-comunidade-single">
							<div class="img-comunidade-user-single">
								<?php 
									if($value['img'] == ''){
								?>
								<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
							<?php }else{ ?>
								<img src="<?php echo INCLUDE_PATH ?>uploads/<?php echo $value['img']; ?>" />
							<?php } ?>
							</div>
							<div class="info-comunidade-user-single">
								<h2><?php echo $value['nome']; ?></h2>
								<p><?php echo $value['email'];?></p>
							</div>

						</div>
						
					<?php } ?>

					</div>
			</div>
			<br/>

				<div class="container-comunidade">
					<h4>Comunidade</h4>
					<div class="container-comunidade-wraper">

						<?php
							$comunidade = \ClassesMVC\Models\UsuariosModel::listarComunidade();

							foreach ($comunidade as $key => $value) {
								$pdo = \ClassesMVC\Mysql::connect();
								$verificarRequest = $pdo->prepare("SELECT * FROM amizades WHERE (enviou = ? AND recebeu = ? AND status = 1) OR (enviou = ? AND recebeu = ? AND status = 1)");
								$verificarRequest->execute(array($value['id'],$_SESSION['id'],$_SESSION['id'],$value['id']));

								if($verificarRequest->rowCount() == 1){
									continue;
								}

								if($value['id'] == $_SESSION['id']){
									continue;
								}
							
						?>

						<div class="container-comunidade-single">
							<div class="img-comunidade-user-single">
								<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
							</div>
							<div class="info-comunidade-user-single">
								<h2><?php echo $value['nome']; ?></h2>
								<p><?php echo $value['email']; ?></p>
							<div class="btn-solicitar-amizade">
								<?php
									if(\ClassesMVC\Models\UsuariosModel::exiteFriendRequest($value['id'])){
								?>
								<a href="<?php echo INCLUDE_PATH ?>comunidade?solicitarAmizade=<?php echo $value['id']; ?>">Solicitar Amizade</a>
								<?php }else { ?>

									<a href="javascript:void(0)" style="border:0; color: orange;">Pedido Pendente!</a>
								<?php } ?>
							</div>
							</div>
							

						</div>
						<?php } ?>
					</div>
			</div>
			</div>
		</div><!--feed-->
	</section>


</body>


</html>