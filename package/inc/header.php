<?php
	if(!session_id()){
		session_name('N_WIKI_SET');
	}
	if(!isset($_WIKI)){
		include( $_SERVER['DOCUMENT_ROOT'].'/config.php' );
		$sql='SELECT * FROM config';
		$result_set = mysqli_query($db_connect, $sql);
		$_WIKI = mysqli_fetch_assoc($result_set);
		$_WIKI['CONFIG_INCLUDE'] = 'true';
	}
	$sql='SELECT * FROM documents WEHRE address="'.$_SERVER['PHP_SELF'].'"';
	$result_set = mysqli_query($db_connect, $sql);
	$_WIKI_ASSETS = mysqli_fetch_assoc($result_set);
	define('version','1.0.0');
	if(!isset($_WIKI['CONFIG_INCLUDE'])){
		$_WIKI['CONFIG_INCLUDE'] = 'false';
	}
	if(!isset($_SESSION['PERM'])){
		$_SESSION['PERM'] = 'ip';
	}
	mysqli_close($db_connect);
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $_WIKI['NAME'] ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="manifest" href="/assets/logo/manifest.json" crossorigin="anonymous">
		<link rel="shortcut icon" href="/assets/logo/favicon.ico" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="57x57" href="/assets/logo/apple-icon-57x57.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="60x60" href="/assets/logo/apple-icon-60x60.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="72x72" href="/assets/logo/apple-icon-72x72.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="76x76" href="/assets/logo/apple-icon-76x76.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="114x114" href="/assets/logo/apple-icon-114x114.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="120x120" href="/assets/logo/apple-icon-120x120.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="144x144" href="/assets/logo/apple-icon-144x144.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="152x152" href="/assets/logo/apple-icon-152x152.png" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="180x180" href="/assets/logo/apple-icon-180x180.png" crossorigin="anonymous">
		<link rel="icon" type="image/png" sizes="192x192"  href="/assets/logo/android-icon-192x192.png" crossorigin="anonymous">
		<link rel="icon" type="image/png" sizes="32x32" href="/assets/logo/favicon-32x32.png" crossorigin="anonymous">
		<link rel="icon" type="image/png" sizes="96x96" href="/assets/logo/favicon-96x96.png" crossorigin="anonymous">
		<link rel="icon" type="image/png" sizes="16x16" href="/assets/logo/favicon-16x16.png" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="/assets/css/style.css" crossorigin="anonymous">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/assets/logo/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
	</head>
	<body>
		<header>
			<button onclick="window.location.href='/'">Home</button>&nbsp;&nbsp;
<?php if( isset ( $_SESSION['LOGIN'] ) ) {
				$_SESSION['LOGIN'] = 'false';
			}
			if( $_SESSION['LOGIN'] == 'true' ) {
?>
			Hi, <?php echo $_SESSION['NAME'] ?>!&nbsp;&nbsp;
			<button onclick="window.location.href='/user/logout'">Logout</button>
<?php
				if( $_SESSION['PERM'] == 'admin' ) {
?>
			<button onclick="window.location.href='/admin/'">Admin Area</button>&nbsp;&nbsp;
<?php
				}
			}
			else {
				$_SESSION['PERM'] = 'ip';
?>
			<button onclick="window.location.href='/user/login'">Login</button>&nbsp;&nbsp;
			<button onclick="window.location.href='/user/register'">Register</button>&nbsp;&nbsp;
		</header>


	