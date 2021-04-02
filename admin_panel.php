<?php
	include('include.php');

	if(isset($_POST['admin_pass'])){
		$input=$_POST['admin_pass'];

		if($input == 'admin_portal'){
			$display_block=<<<END_OF_BLOCK
				<form method="post" action="$_SERVER[PHP_SELF]">
					<label for="subject">Subject : </label>
					<input type="text" name="subject" size="40" /><br />
					<label for="message">Message : </label><br />
					<textarea name="message" value="" cols="50" rows="10"></textarea><br />

					<button type="submit" name="submit" value="submit">Send</button>
				</form>
			END_OF_BLOCK;

		}
		else{
			header("location: manage_list.php");
		}
	}
	else{
		if(($_POST['message'] != "") && ($_POST['subject'] != "")){
			connect_to_db();

			$display_block="";
			$fetch_query="SELECT email FROM email_list";

			$result=mysqli_query($mysqli, $fetch_query) or die(mysqli_error($mysqli));

			$mailheaders= "From: A's Weekly Newsletter <abc@example.com>";
			
			while($email = mysqli_fetch_array($result)){
				set_time_limit(0);
				$id=$email['email'];
				mail("$id" , stripslashes($_POST['subject']),stripslashes($_POST['message']),$mailheaders);

				$display_block .= "Newsletter sent to: ".$id . " <br />";
			}
				
		}

		else{
			header("location: manage_list.php");
			exit();
		}
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel of Email Subscription List</title>
</head>
<body>
	<?php echo $display_block; ?>
</body>
</html>