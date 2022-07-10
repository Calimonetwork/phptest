<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/header.php' );
	if( $_SESSION['LOGIN'] == 'true' ) {
?>
		<h3>이미 로그인되어 있습니다!</h3>
<?php
	}
	elseif ( isset( $_POST['id'] ) ) {
		if( $_WIKI['CONFIG_INCLUDE'] == 'false' ) {
			include( $_SERVER['DOCUMENT_ROOT'].'/config.php' );
		}
		$sql='SELECT * FROM users WEHRE id="'.$_POST['id'].'"';
		$result_set = mysqli_query($db_connect, $sql);
		$_USERS = mysqli_fetch_assoc($result_set);
		if ( isset ( $_USERS['PW'] ) ) {
			if ( password_verify ( $_POST['pw'], $_USERS['PW'] ) ) {
				$_SESSION['PERM'] = $_USERS['PERM'];
				$_SESSION['NAME'] = $_USERS['NAME'];
				header('Location: /');
			}
			else {
				$_SESSION['LOGIN_ERROR'] = 'true';
			}
		}
		else {
			$_SESSION['LOGIN_ERROR'] = 'true';
		}
		mysqli_close($db_connect);
	}
	else {
		if ( $_SESSION['LOGIN_ERROR'] == 'true' ) {
?>
		<p style="color:red"><b>Wrong ID or Password.</b></p>
<?php
?>
		<form method="post">
			ID : <input type="text" name="id" placeholder="Enter ID Here." autocomplete="off"><br>
			Password : <input type="password" name="pw" placeholder="Enter Password Here." autocomplete="off"><br><br><br>
			<button type="submit">Log In</button>
		</form>
<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/footer.php' );
?>