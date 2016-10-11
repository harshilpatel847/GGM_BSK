<html>
	
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>
			<?php 
				if(isset($results['pageTitle'])){
					echo $results['pageTitle'];
				}else {
					echo "Gayatri Gyan Mandir Bal Sanskar Kendra";
				}
			?>
		</title>
	
		<link rel="stylesheet" href="css/master.css" type="text/css" media="screen">

		<link href="css/metro.css" rel="stylesheet">
		<link href="css/metro-icons.css" rel="stylesheet">
		<link href="css/metro-responsive.css" rel="stylesheet">
		<link href="css/metro-schemes.css" rel="stylesheet">

		<link href="css/docs.css" rel="stylesheet">

		<script src="js/jquery-2.1.3.min.js"></script>
		<script src="js/metro.js"></script>
		<script src="js/docs.js"></script>
		<script src="js/prettify/run_prettify.js"></script>
		<script src="js/ga.js"></script>

	</head>
	
	<body id="index" onload="">
		<div id="header">
			<h1>
			<?php echo ($results['pageTitle'] ?: "Gayatri Gyan Mandir Bal Sanskar Kendra"); ?>
			</h1>
			<hr>
		</div>