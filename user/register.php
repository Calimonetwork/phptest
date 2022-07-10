<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/header.php' );
	if( $_SESSION['LOGIN'] == 'true' ) {
?>
		<h3>You're Already Logged In!</h3>
<?php
	}
	elseif ( isset( $_POST['id'] ) ) {
		if( $_WIKI['CONFIG_INCLUDE'] == 'false' ) {
			include( $_SERVER['DOCUMENT_ROOT'].'/config.php' );
		}
		$sql='SELECT * FROM users WEHRE id="'.$_POST['id'].'"';
		$result_set = mysqli_query($db_connect, $sql);
		$_USERS = mysqli_fetch_assoc($result_set);
		if ( !isset ( $_USERS['pw'] ) ) {
			$sql='INSERT INTO users(ID, PW, NAME, PERM) VALUES("'.$_POST['id'].'", "'..$_POST['pw'].'", "'..$_POST['name'].'", "member")';
			mysqli_query($db_connect, $sql);
			$sql='INSERT INTO log_user(ID, NAME, IP, ACTIVITY) VALUES("'.$_POST['id'].'", "'..$_POST['name'].'", "'..$_SERVER['REMOTE_ADDR'].'", "register")';
			mysqli_query($db_connect, $sql);
		}
		else {
			$_SESSION['LOGIN_ERROR'] = 'ID Already Exist.';
		}
		mysqli_close($db_connect);
	}
?>
	<p style="color:red"><b><?php echo $_SESSION['REGISTER_ERROR'] ?></b></p>
<?php
?>
		<form method="post" id="register">
			ID : <input type="text" name="id" placeholder="Enter ID Here." autocomplete="off"><br>
			Name : <input type="text" name="name" placeholder="Enter Username Here." autocomplete="off"><br>
			Password : <input type="password" name="pw" placeholder="Enter Password Here." autocomplete="off"><br><br><br>
			<button type="submit">Register</button>
		</form>
        });
    </script>
<?php
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/footer.php' );
?>