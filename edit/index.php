<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/header.php' );
	if( $_WIKI['CONFIG_INCLUDE'] == 'false' ) {
			include( $_SERVER['DOCUMENT_ROOT'].'/config.php' );
	}
	$sql='SELECT * FROM documents WHERE TITLE="'.substr($_SERVER['PHP_SELF'], 0, 5);.'"';
	mysqli_query($db_connect, $sql);
	$result_set = mysqli_close($db_connect);
	$_DOCUMENT = mysqli_fetch_assoc($result_set);
	$_DOCUMENT['TITLE'] = substr($_SERVER['PHP_SELF'], 0, 5);
	if( isset ( $_POST['text'] ) ) {
		if ( $_SESSION['LOGIN'] == 'false' ) {
			$_US = $_SERVER['REMOTE_ADDR'];
		}
		else {
			$_US = $_SESSION['NAME']
		}
		include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/parase.php' );
		$TEXT = parase( $_POST['text'] );
		$sql='SELECT * FROM page_history WEHRE TITLE="'.substr($_SERVER['PHP_SELF'], 0, 5);.'"';
		$history_sql = mysqli_query($db_connect, $sql);
		$history = mysqli_fetch_assoc( $history_sql ):
		if ( isset ( $history['HISTORY'] ) ) {
			$sql='UPDATE page_history SET TITLE="'.substr($_SERVER['PHP_SELF'], 0, 5).'"HISTORY="'.$history['HISTORY'].'<br>'.$_POST['short'].'", BY="'.$_US.'"');
			mysqli_query($db_connect, $sql);
		}
		else {
			$sql='INSERT INTO page_history(TITLE, HISTORY, BY) VALUES("'.substr($_SERVER['PHP_SELF'], 0, 5).'","'.$_POST['short'].'", "'.$_US.'"');
			mysqli_query($db_connect, $sql);
		}
		$sql='UPDATE documents SET BODY="'.parse(str_replace('\r\n', '<br>', $TEXT)).'" WHERE TITLE='.$_DOCUMENT['TITLE'].'"';
		mysqli_query($db_connect, $sql);
		$sql='UPDATE documents_raw SET BODY="'.str_replace('\r\n', '<br>', $_POST['text']).'" WHERE TITLE='.$_DOCUMENT['TITLE'].'"';
		mysqli_query($db_connect, $sql);
		mysqli_close($db_connect);
	}
	else {
		if( $_SESSION['PERM'] == 'blocked' ) {
			$PERM = '0';
?>
		<p style="color:red">문서를 편집할 권한이 부족합니다.</p>
<?php
		}
		if( $_SESSION['PERM'] == 'member' and $_DOCUMENT['EDIT_ACL'] == '2' $_SESSION['PERM'] == 'member' and $_DOCUMENT['EDIT_ACL'] == '3' ) {
			$PERM = '0';
?>
		<p style="color:red">문서를 편집할 권한이 부족합니다.</p>
<?php
		}
?>
		<form method="post" style="text-align:left;">
			<textarea name="text" <?php if($PERM=='0'){ echo disabled; } ?>><?php echo $_DOCUMENT['BODY'] ?></textarea><br><br>
			Editorial summary<br><input type="text" name="short">
<?php
	if ( $_SESSION['LOGIN'] == 'false' ) {
?>
			<p style="color:red">로그인 하지 않으셨습니다. IP (<?php echo $_SERVER['REMOTE_ADDR'] ?>) 는 문서 역사에 영구히 기록됩니다.</p>
<?php
	}
?>
			<div style="text-align:right;"><button type="submit"></button>Save</div>
<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/footer.php' );
?>