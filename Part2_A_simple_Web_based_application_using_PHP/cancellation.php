<?php
	include("config.php");
	session_start();
	
	if( isset( $_POST['goback']) ) 
	{
		header( "location: welcome.php" );
	}
	
	if( isset( $_POST['Logout']) ) 
	{
		header( "location: index.php" );
	}
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
	<h2 style="color:purple;">Cancellation Page</h2><br><br>

	<?php
		$sid = $_SESSION['id'];
		$cid = $_SESSION['cancellation_cid'];
		
		$query = "DELETE FROM apply WHERE sid='$sid' AND cid='$cid'";
		
		if ( $result = $mysqli->query($query) ) 
		{
			$query = "SELECT quota FROM company WHERE cid='$cid'";
			$result = $mysqli->query( $query );
			$index = mysqli_fetch_assoc( $result );

			$quota = $index['quota'] + 1;
			$query = "UPDATE company SET quota='$quota' WHERE cid='$cid'";
			$result = $mysqli->query( $query );
			
			echo "Cancellation Successful";
		} 
		else 
		{
			echo "Cancellation Failed";
		}
		$_SESSION['cancellation_cid'] = "";
	?>
	
	<br><br>
	<form method="post">
		<input type="submit" name="goback" style="margin:10px" value="Go Back"/><br>
		<input type="submit" name="Logout" style="margin:10px" value="Log out"/>
	</form>
	
</body>
</html>