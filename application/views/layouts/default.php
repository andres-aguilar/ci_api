<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Chinchibei - <?php echo $title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
	</head>
	<body>
		<div class='container'>
			<div class='header'></div>
			<div class='menu'></div>
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
