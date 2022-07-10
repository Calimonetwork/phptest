<?php
	$_WIKI_ASSETS['TITLE'] = substr($_SERVER['PHP_SELF'], 0, 3);
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/header.php' );
	if( $_WIKI['CONFIG_INCLUDE'] == 'false' ) {
			include( $_SERVER['DOCUMENT_ROOT'].'/config.php' );
	}
	$sql='SELECT * FROM documents WHERE TITLE="'.substr($_SERVER['PHP_SELF'], 0, 3).'"';
	mysqli_query($db_connect, $sql);
	$result_set = mysqli_close($db_connect);
	$_DOCUMENT = mysqli_fetch_assoc($result_set);
	$_DOCUMENT['TITLE'] = substr($_SERVER['PHP_SELF'], 0, 3);
	if( $_DOCUMENT['VIEW_ACL'] != '0' ) {
		if( $_DOCUMENT['VIEW_ACL'] == '1' ) {
			if( $_SESSION['PERM'] == 'ip' or $_SESSION['PERM'] == 'member' ) {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<h6>You don't have permission to see this document. Only admin can see this document.</h6>
<?php
			}
			elseif ( $_SESSION['PERM'] == 'admin' ) {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<button onclick="window.location.href='/edit/<?php echo substr($_SERVER['PHP_SELF'], 0, 3); ?>'">Edit / Add This Page</button><br><br>
		<p><?php $_DOCUMENT['BODY'] ?></p>
<?php
			}
		}
		elseif( $_DOCUMENT['VIEW_ACL'] == '1' ) {
			if( $_SESSION['PERM'] == 'ip' or $_SESSION['PERM'] == 'member' ) {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<h6>You don't have permission to see this document. Only admin can see this document.</h6>
<?php
			}
			elseif ( $_SESSION['PERM'] == 'admin' ) {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<button onclick="window.location.href='/edit/<?php echo substr($_SERVER['PHP_SELF'], 0, 3); ?>'">Edit / Add This Page</button><br><br>
		<p><?php $_DOCUMENT['BODY'] ?></p>
<?php
			}
		}
		elseif( $_DOCUMENT['VIEW_ACL'] == '2' ) {
			if( $_SESSION['PERM'] == 'ip' ) {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<h6>You don't have permission to see this document. Only logged in users can see this document.</h6>
<?php
			}
			elseif ( $_SESSION['PERM'] == 'admin' or $_SESSION['PERM'] == 'member' ) {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<button onclick="window.location.href='/edit/<?php echo substr($_SERVER['PHP_SELF'], 0, 3); ?>'">Edit / Add This Page</button><br><br>
		<p><?php $_DOCUMENT['BODY'] ?></p>
<?php
			}
		}
		elseif( $_DOCUMENT['VIEW_ACL'] == '0' ) {
			if( $_SESSION['PERM'] == 'owner' ) {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<button onclick="window.location.href='/edit/<?php echo substr($_SERVER['PHP_SELF'], 0, 3); ?>'">Edit / Add This Page</button><br><br>
		<p><?php $_DOCUMENT['BODY'] ?></p>
<?php
			}
			else
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<h6>You can't see this document. Only owner of this site can see this document.</h6>
<?php
			}
		}
	}
	else {
?>
		</h3><?php echo $_DOCUMENT['TITLE'] ?></h3><br><br>
		<button onclick="window.location.href='/edit/<?php echo substr($_SERVER['PHP_SELF'], 0, 3); ?>'">Edit / Add This Page</button><br><br>
		<p><?php $_DOCUMENT['BODY'] ?></p>
<?php
	}
	include( $_SERVER['DOCUMENT_ROOT'].'/package/inc/footer.php' );
?>