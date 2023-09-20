<?php
	include("config.php");
	session_start();
?>

<!DOCTYPE html>
<html>

<head> 
    <title> 
        Internship Application
    </title> 
	<style>
		table, th, td { border: 1px solid black; }
		table.center { margin-left: auto; margin-right: auto; }
	</style>
</head> 

<body style="text-align:center;">

	<h1 style="color:blue;">Internship Application</h1> 
	<h2 style="color:purple;">Application Page</h2><br><br>
	<label for="lab1">Here are the companies you can apply to:</label><br><br>
	
	<table class="center" style="width:40%">
		<tr>
		<th>Company ID</th>
		<th>Company Name</th>
		<th>Quota</th>
		</tr>
	
		<?php
			$cid = "";
			$id = $_SESSION['id'];
			$query = "SELECT * FROM company WHERE cid NOT IN (SELECT cid FROM apply WHERE sid='$id') AND quota>0";
			$result = $mysqli->query( $query );
			
			while ( $index = mysqli_fetch_assoc( $result ) ) 
			{
				echo "<tr><td>".$index['cid']."</td><td>".$index['cname']."</td><td>".$index['quota']."</td></tr>";
			}
		?>
	</table>
	
	
	<form method="post">
		<br>
		<label for="cid_input">Enter company ID to apply:</label>
		<input type="text" name="cid_input" />
		<input type="submit" name="application" value="Submit" style="margin:8px"/><br><br>
		<input type="submit" name="goback" style="margin:8px" value="Go Back"/><br>
		<input type="submit" name="Logout" style="margin:8px" value="Log out"/>
	</form>
	
	<?php
	if( isset($_POST['application']) ) 
	{
		$cid = $_POST['cid_input'];
		$_SESSION['post-application_cid'] = $cid;
		header( "location: post-application.php" );
	}
	
	if( isset($_POST['goback']) ) 
	{
		header( "location: welcome.php");
	}
	
	if( isset($_POST['Logout']) ) 
	{
		header( "location: index.php");
	}
?>
	
</body>
</html>