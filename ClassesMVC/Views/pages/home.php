<!DOCTYPE html>
<html>
<head>
	<title>Bem-vindo, <?php echo $_SESSION['nome']; ?></title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link href="<?php echo INCLUDE_PATH_STATIC ?>Styles/feed.css" rel="stylesheet">
</head>

<body>
	<section class="main-feed">
		<?php 
			include('includes/sidebar.php');
		?>
		</div><!--SIDEBAR-->
		<div class="feed">
			<div class="feed-wraper">
			<div class="feed-form">
				<form method="post">
					<textarea required name="postBody" placeholder="No que você está pensando?"></textarea>
					<input type="hidden" name="post_feed">
					<input type="submit" name="acao" value="Postar">
				</form>
			</div>

			<?php 
				$retrievePosts = \ClassesMVC\Models\HomeModel::retrieveFriendsPosts();
				
				foreach($retrievePosts as $key => $value){
			?>

			<div class="feed-single-post">
				<div class="feed-single-post-author">
					<div class="img-single-post-author">
						<!--Todo: COLOCAR IMG PLACEHOLDER-->
						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					</div><!--IMG-SINGLE-POST-AUTHOR-->
					<div class="feed-single-post-author-info">
						<?php if(isset($value['me'])){ ?>
							<h3><?php echo $_SESSION['nome'];?> (me)</h3>
						<?php }else{ ?>
							<h3><?php echo $value['usuario'];?></h3>
						<?php } ?>
						<p><?php echo date('d/m/Y H:i:s',strtotime($value['data'])); ?></p>
					</div><!--FEED-SINGLE-POST-AUTHOR-INFO-->
				</div><!--FEED-SINGLE-POST-AUTHOR-->
				<div class="feed-single-post-content">
					<?php echo $value['conteudo']; ?>
				</div><!--FEED-SINGLE-POST-CONTENT-->
			</div><!--FEED-SINGLE-POST-->

			<?php } ?>

		</div>
			<div class="friends-request-feed">
				<h4>Solicitações de amizade</h4>

				<?php
					foreach(\ClassesMVC\Models\UsuariosModel::requestsPendentes() as $key=>$value){
					$userInfo = \ClassesMVC\Models\UsuariosModel::getUsersById($value['enviou']);
				?>
				<div class="friend-request-single">
					<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<div class="friend-request-single-info">
						<h3><?php echo $userInfo['nome']; ?></h3>
						<p><a href="<?php echo INCLUDE_PATH ?>?aceitarAmizade=<?php echo $userInfo['id']; ?>">Aceitar</a> | <a href="<?php echo INCLUDE_PATH ?>?recusarAmizade=<?php echo $userInfo['id']; ?>">Recusar</a></p>
					</div><!--FRIEND-REQUEST-SINGLE-INFO-->
				</div><!--FRIEND-REQUEST-SINGLE-->
				<?php }?>
			</div><!--FRIENDS-REQUEST-FEED-->
		</div><!--FEED-->
	</section><!--MAIN-FEED-->
</body>

</html>