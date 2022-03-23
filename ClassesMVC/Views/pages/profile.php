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
			<div class="change-profile">
				<h2>Hello, <?php echo $_SESSION['nome']?></h2>
				<?php 
					if(isset($_SESSION['img']) && $_SESSION['img'] == null){
						echo '<img src="'.INCLUDE_PATH_STATIC.'images/avatar.jpg" />';
					}else{
						echo '<img src="'.INCLUDE_PATH.'uploads/'.$_SESSION['img'].'" />';
					}
				?>
				<br /> 
				<form method="post" enctype="multipart/form-data">
					<input type="text" name="nome" value="<?php echo $_SESSION['nome'];?>">
					<input type="password" name="senha" placeholder="Sua nova senha...">
					<input type="file" name="file">
					<input type="hidden" name="update" value="update">
					<input type="submit" name="acao" value="Send!">
				</form>

			</div>
		</div><!--FEED-->
	</section><!--MAIN-FEED-->
</body>

</html>