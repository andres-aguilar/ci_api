<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>API - <?php echo $title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	</head>
	<body>
		<div class='container'>
			<div class='header'>
				<header>
					<h1> <span class='logo'><i class="fab fa-wolf-pack-battalion"></i></span> Header</h1>
					<div class='header-menu'>
						<ul>
							<li><a href="#"><i class="fas fa-user-circle"></i>Usuario</a></li>
							<li><a href="#"><i class="fas fa-sign-out-alt"></i>Salir</a></li>
						</ul>
					</div>
				</header>
			</div>
			<div class='menu'> 
				<h4 class="navigation-title"></h4>
				<nav>
					<ul>
						<li><a href="#"><i class="fas fa-home"></i>Link 1</a></li>
						<li><a href="#"><i class="fab fa-angular"></i>Link 2</a></li>
						<li><a href="#"><i class="fab fa-android"></i>Link 3</a></li>
						<li><a href="#"><i class="fab fa-blogger"></i>Link 4</a></li>
						<li><a href="#"><i class="fab fa-github"></i>Link 5</a></li>
						<li><a href="#"><i class="fab fa-snapchat"></i>Link 6</a></li>
						<li><a href="#"><i class="fab fa-vuejs"></i>Link 7</a></li>
					</ul>
				</nav>
			</div>
			<div class='content'>
				<?php echo $content_for_layout; ?>
			</div>
		</div>
		<!-- Import Vue.js -->
	  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> <!-- Develop version -->
	  <!-- <script src="https://unpkg.com/vue@2.5.13/dist/vue.min.js"></script> -->
	  <!-- Include Axios -->
	  <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.0"></script>
		<script src="<?php echo base_url('assets/scripts/main.js') ?>"></script>
	</body>
</html>
