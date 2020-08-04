<?php
	session_start();
	$uname=$_SESSION['uname'];
	
	if(!isset($_SESSION['uname']))
	{
		header('Location:./loginpage.php');
	}
	

	$conn = mysqli_connect("localhost","root","","librarydb");

	if (!$conn){
		die("Connection failed: ".mysqli_connect_error());
	}

	$sql = "SELECT * FROM userinfo WHERE uname='$uname'";
	
	if (mysqli_query($conn, $sql)) {
		$result = mysqli_query($conn, $sql);
	} 
	else {
		echo "Error <br>" . mysqli_error($conn);
	}
			
	mysqli_close($conn);
	
		
?>
		
	
<html>
<head>
<title>Homepage</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="./jquery.js"></script>
<style> 
	#maindiv{
		background:#fffffa;
		border:3px solid black;
		border-radius:5px;
		position:absolute;
		left:25%;
		width:40%;
	}
	
	table{
		border:1px solid black;
		border-collapse:collapse;
		width:100%;
		top:30%;
		color:#588c7e;
		font-family:monospace;
		font-size:20px;
		text-align:left;
	}
	th{
		
		border-collapse:collapse;
		background-color:#d96459;
		color:white;
	}
	tr:nyh-child(even){
		
		border-collapse:collapse;
		background:#0ee8f0;
	}
	td{
		
		border-collapse:collapse;
	}
	#logout{
		background-color:Plum;
		color:Black;
		font-size:17px;
		padding:5px;
	}
	
</style>

</head>
<body><br>
<table>
	<tr><th style="color:white;font-size:50px;width:90%;font-family:Timesnewroman;background:#bcbdc4;"><center>Welcome <?php echo "".$uname; ?></center></th><td style="background:#bcbdc4;"><a href="logoutpage.php"><input type='button' class="btn btn-light" value="LOGOUT" id="logout" style="margin:20px;"></a></td></tr>
</table>

<br>
<div class="container" id="maindiv" onsubmit="return alertmsg()">
<br>
<?php
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_array($result))
		{	
				echo "<b>";
				echo "Username:"."    ".$row['uname']."<br><br>";
				echo "Name:"."       ".$row['fname'] ."  ".$row['mname']."  ".$row['lname']."<br><br>";
				echo "Gender:"."     ".$row['gender']."<br><br>";
				echo "Email-Id:"."   ".$row['email']."<br><br>";
				echo "Mobile no:"."  ".$row['phone']."<br><br>";
				echo "Address:"."    ".$row['addr']."<br>";
				
		}
	}

?>
<br><br><br><br><br>
<pre>  <input type='button' class="btn btn-light" value="Search Book" style="background-color:Plum;color:Black;font-size:17px;padding:5px" onclick="window.location.href='searchbook.php'">  <input type='button' class="btn btn-light" value="Book Issued" style="background-color:Plum;color:Black;font-size:17px;padding:5px" onclick="window.location.href='bookissued.php'">  <input type='button' class="btn btn-light" value="Book Submitted" style="background-color:Plum;color:Black;font-size:17px;padding:5px" onclick="window.location.href='booksubmitted.php'">  <a href="logoutpage.php"><input type='button' class="btn btn-light" value="LOGOUT" id="logout"></a></pre>
<br>
</div>
<script>
	$(document).ready(function(){
		$("#logout").click(function(){
			alert("Want to leave?");			
		});
	});
</script>

</body>
</html>