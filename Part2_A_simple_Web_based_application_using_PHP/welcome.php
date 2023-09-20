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
	<h2 style="color:purple;">Welcome Page</h2> <br>
	<h3 style="color:black;">Hello, <?php echo $_SESSION['login_user']; ?></h3> 
	<label for="lab1">Here are the companies you have applied to:</label><br><br>
	
	<table class="center" style="width:30%">
		<tr>
		<th>Company ID</th>
		<th>Company Name</th>
		<th>Quota</th>
		<th>Cancel Application</th>
		</tr>
	
		<?php
			$id = $_SESSION['id'];
			$query = "SELECT * FROM company WHERE cid IN (SELECT cid FROM apply WHERE sid='$id')";
			$result = $mysqli->query( $query );
			
			$number_of_companies = $result->num_rows;
			
			while ( $index = mysqli_fetch_assoc($result) ) 
			{ 
				echo "<tr>";
				$cid = $index['cid'];
				echo "<td>".$index['cid']."</td><td>".$index['cname']."</td><td>".$index['quota']."</td>";
				
				echo "<form method=\"post\">";
				echo "<td><input name=\"$cid\" type=\"submit\" style=\"color:red;\" class=\"linkButton\" value=\"X\"/>";
				echo "</form>";
				
				if(isset($_POST[$cid])) 
				{
					$_SESSION['cancellation_cid'] = $cid;
					header( "location: cancellation.php" );
				}
				echo "</tr>";
			}
		?>
	</table>
	
	<br><br><br>
				
	<form method="post">
		<input type="submit" name="applynew" style="margin:10px" value="Apply For New Internship"/><br>
		<input type="submit" name="Logout" style="margin:10px" value="Log out"/>
	</form>
	
<?php
	if( isset( $_POST['applynew'] ) ) 
	{
		if ( $number_of_companies != 3 )
		{
			header( "location: application.php" );
		}
		else
		{
			echo "WARNING: Cannot apply to more than 3 companies.";
		}
	}
	
	if( isset( $_POST['Logout'] ) ) 
	{
		header( "location: index.php" );
	}
?>
</body>
</html>