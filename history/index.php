<?php
	$_WIKI_ASSETS['TITLE'] = substr($_SERVER['PHP_SELF'], 0, 9);
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/header.php' );
	if( $_WIKI['CONFIG_INCLUDE'] == 'false' ) {
			include( $_SERVER['DOCUMENT_ROOT'].'/config.php' );
	}
	$sql='SELECT * FROM page_history WHERE TITLE="'.substr($_SERVER['PHP_SELF'], 0, 9);.'"';
	mysqli_query($db_connect, $sql);
	$result_set = mysqli_close($db_connect);
	$_DOCUMENT = mysqli_fetch_assoc($result_set);
	$_DOCUMENT['TITLE'] = substr($_SERVER['PHP_SELF'], 0, 9);
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<p><?php $_DOCUMENT['HISTORY'] ?></p>
<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/footer.php' );
?>