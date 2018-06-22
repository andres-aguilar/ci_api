<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Chinchibei - <?php echo $title ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">

	</head>
	<body>
		<?php
      /* Aqui se mete el codigo de la nueva vista */
      echo $content_for_layout;
    ?>
		<script src="<?php echo base_url('assets/scripts/main.js') ?>"></script>
	</body>
</html>
