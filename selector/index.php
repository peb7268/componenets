<?php 
	
	/**
	 * 
	 *	Fetch the Select options from the server.
	 *  Then feed some of those options to the JS file. 
	 * 
	 * 
	 * 
	 */

?>
<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="ie6"> <![endif]-->
<!--[if IE 7]>         <html class="ie7"> <![endif]-->
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html>         <!--<![endif]-->

<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Option Slider Component</title>
	
	<link rel="stylesheet" href="./styles/styles.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" href="./styles/jqtransform.css" type="text/css" media="screen" title="no title" charset="utf-8">
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="./js/mock.js"></script>
	<script type="text/javascript" src="./js/jqtransform.js"></script>
	<script type="text/javascript" src="js/global.js" charset="utf-8"></script>
</head>
<body>

<div id="filter" class="clearfix">
	<form action="#" method="get">
		<p id="nameTag">Select an organization</p>
		<ul>
			<li id="organization" data-type="organization">
				<select name="" id="">
					<option value="">CARE</option>
					<option value="">Save The Children</option>
					<option value="">World Vision</option>
				</select>
			</li>
			<li id="country" class="inactive" data-type="country">
				<select name="" id="">
					<option value="">USA</option>
					<option value="">Ghana</option>
					<option value="">Peru</option>
					<option value="">Kenya</option>
					<option value="">Ethiopia</option>
				</select>
			</li>
			<li id="branch" class="inactive" data-type="branch">
				<select name="" id="">
					<option value="">Atlanta</option>
					<option value="">Lima</option>
					<option value="">Roswell</option>
					<option value="">Sandy Springs</option>
					<option value="">Congo</option>
				</select>
			</li>
		</ul>
	</form>
	<a href="#" id="go"><span class="triangle"></span></a>
</div><!-- #filter -->

</body>
</html>