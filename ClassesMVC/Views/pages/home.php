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
			<div class="feed-single-post">
				<div class="feed-single-post-author">
					<div class="img-single-post-author">
						<!--Todo: COLOCAR IMG PLACEHOLDER-->
						<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					</div><!--IMG-SINGLE-POST-AUTHOR-->
					<div class="feed-single-post-author-info">
						<h3>Pedro Moreira</h3>
						<p>9:15 01/04/2021</p>
					</div><!--FEED-SINGLE-POST-AUTHOR-INFO-->
				</div><!--FEED-SINGLE-POST-AUTHOR-->
				<div class="feed-single-post-content">
					<p>Isto é apenas um teste de como ficará o conteúdo dos posts.</p>
					<img src="<?php echo INCLUDE_PATH_STATIC ?>images/code-source.jpg">
				</div><!--FEED-SINGLE-POST-CONTENT-->
			</div><!--FEED-SINGLE-POST-->
			<div class="friends-request-feed">
				<h4>Solicitações de amizade</h4>
				<div class="friend-request-single">
					<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<div class="friend-request-single-info">
						<h3>Joãozinho boca louca</h3>
						<p><a href="">Aceitar</a> | <a href="">Recusar</a></p>
					</div><!--FRIEND-REQUEST-SINGLE-INFO-->
				</div><!--FRIEND-REQUEST-SINGLE-->
				<div class="friend-request-single">
					<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<div class="friend-request-single-info">
						<h3>Joãozinho boca louca</h3>
						<p><a href="">Aceitar</a> | <a href="">Recusar</a></p>
					</div><!--FRIEND-REQUEST-SINGLE-INFO-->
				</div><!--FRIEND-REQUEST-SINGLE-->
				<div class="friend-request-single">
					<img src="<?php echo INCLUDE_PATH_STATIC ?>images/avatar.jpg" />
					<div class="friend-request-single-info">
						<h3>Joãozinho boca louca</h3>
						<p><a href="">Aceitar</a> | <a href="">Recusar</a></p>
					</div><!--FRIEND-REQUEST-SINGLE-INFO-->
				</div><!--FRIEND-REQUEST-SINGLE-->
			</div><!--FRIENDS-REQUEST-FEED-->
		</div><!--FEED-->
	</section><!--MAIN-FEED-->
</body>

</html>