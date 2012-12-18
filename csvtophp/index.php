<?php require_once('./lib/config.php'); ?>
<?php $survey = new Survey($config); 
	//echo json_encode($survey->config->User);
	//echo '<pre>'; var_dump($survey); echo '</pre>';
?>

<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="ie6"> <![endif]-->
<!--[if IE 7]>         <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html>         <!--<![endif]-->
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Page Title</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
		var care = {};
		care.cache 			= <?php echo $survey->result; ?>;
		care.user 			= care.cache.user;
		care.info			= care.cache.info;
		care.data 			= care.cache.data;

		delete care.cache; //Just doing some DOM cleanup 
		console.log(care);
	</script>
</head>
<body>

</body>
</html>