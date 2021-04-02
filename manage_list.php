<?php
	include 'include.php';
	
	if(!$_POST){
		$display_block = <<<END_OF_BLOCK
		<form method='post' action="$_SERVER[PHP_SELF]">
			<p><label for="email">Email : </label>
			<input type='email' name='email' size='40' maxlength='150'/></p><br />

			<input type='radio' value='sub' name='choice' checked />
			<label for ='choice'>Subscribe</label>
	
			<input type='radio' value='unsub' name='choice' />
			<label for= 'choice'>Unsubscribe</label><br /><br />

			<button type='submit' value='submit' name='submit'>Submit</button>
		</form>
		END_OF_BLOCK;
		}
	else if( ($_POST) && ($_POST['choice'] == 'sub')){
		if($_POST['email'] == ''){
			header('location: manage_list.php');
			exit();
		}
		else{
			connect_to_db();
			
			$ret =check_email_present($_POST['email']);
			
			if($ret == 0){
				$add_query = " INSERT INTO email_list VALUES('' , '". $safe_email ."');";

				$res2=mysqli_query($mysqli, $add_query) or die(mysqli_error($mysqli));
				$display_block = "<p> Thank you for signing up</p>";
			}
			else{
				$display_block = <<<END_OF_BLOCK
				<p><strong>Email is already present in database</strong></p>
				END_OF_BLOCK;
			}
		}
	}
	else if( ($_POST) AND ($_POST['choice'] == 'unsub')){
		if($_POST['email'] == ''){
			header("location: manage_list.php");
			exit();
		}
		else{
			connect_to_db();
			$ret=check_email_present($_POST['email']);

			if($ret == 0){
				$display_block = "<p>Email not present, no changes made </p>";
			}
			else{
				$del_query = "DELETE FROM email_list where id='" . $ret . "';";

				$res2=mysqli_query($mysqli,$del_query) or die(mysqli_error($mysqli));

				$display_block = "<p>Email removed from subscription list </p>";			
			}
		}
	}
			
?>
<!DOCTYPE html>
<html>
<head>
	<title>A's Mailing List</title>
</head>
<body>
	<h1>Subscribe / Unsubscribe to Mailing List</h1>
	<?php echo $display_block; ?>

	<h2>Admin Panel</h2>
	<form method="post" action="admin_panel.php"?>
		<label for='admin_pass'>Enter Admin Code</label>
		<input type='password' name='admin_pass' />
		<button type='submit' name='submit' id='submit'>Enter</button>
	</form>
</body>
</html>
