<?php
	include( "config.php" );
	session_start();
?> 

<!DOCTYPE html> 
<html> 
      
	<head> 
		<title> 
			Internship Application
		</title> 
	</head> 
	  
	<body style="text-align:center;"> 
		  
		<h1 style="color:blue;">Internship Application</h1> 
		<h2 style="color:purple;">Log-in Page</h2><br><br>
		
		<form method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username">
			<br><br>
			<label for="password">Password:</label>
			<input type="password" id="id" name="id">
			<br><br>
			<input type="submit" name="login" style="margin:8px" value="Log in"/> 
		</form>
		
		<?php
			if( isset( $_POST['login'] ) ) 
			{
				$id = $_POST['id'];				
				$username = $_POST['username'];

				$query = "SELECT * FROM student WHERE (sname LIKE '$username') AND (sid='$id')";
				
				if ( empty($username) ) 
				{
					echo "\nWARNING: Did not enter a username.";
				}
				
				elseif ( empty($id) ) 
				{
					echo "\nWARNING: Did not enter a password.";
				}
				
				else
				{
					if ( $result = $mysqli->query($query) ) 
					{
						if ( $result->num_rows != 1 ) 
						{
							echo "\nWARNING: Entered incorrect log-in information.";
						} 
						else 
						{
							$_SESSION['id'] = $id;
							$_SESSION['login_user'] = $username;
							header( "location: welcome.php" );
						}
					} 
					
					else
					{
						echo "\nWARNING: Query has failed.";
					} 
				}
			}
		?>
		  
	</body> 
  
</html> 