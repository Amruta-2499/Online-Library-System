<html>
<head>
	<title>Booksissued Page</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="../jquery.js"></script>
	<style>
	.design{
		background:#0ee8f0;
		border:2px solid black;
		border-radius:5px;
		width:70%;
		left:50%;
		color:black;
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
		border:1px solid black;
		border-collapse:collapse;
		background-color:#d96459;
		color:white;
	}
	tr:nyh-child(even){
		border:1px solid black;
		border-collapse:collapse;
		background:#0ee8f0;
	}
	td{
		border:1px solid black;
		border-collapse:collapse;
	}
	
	</style>
</head>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<table>	
	<tr>
		<th>Bookname</th>
		<th>Issue Date</th>
		<th>Due Date</th>
		<th>Link</th>
	</tr>

<?php
	session_start();
	
	$uname=$_SESSION['uname'];
	$bname="";
	$current_date = date("Y-m-d");
	
	
	if(!isset($_SESSION['uname']))
	{
		header('Location:./loginpage.php');
	}
	
	$conn = mysqli_connect("localhost","root","","librarydb");

	if (!$conn){
		die("Connection failed: ".mysqli_connect_error());
	}

	$sql = "SELECT * FROM user where uname='$uname' and submitstatus!='Yes'";
	
	if (mysqli_query($conn, $sql)) {
		$result = mysqli_query($conn, $sql);
	} 
	else {
		echo "Error <br>" . mysqli_error($conn);
	}
	
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{	
			echo "<tr><td>".$row['bookname']."</td><td>".$row['issuedate']."</td><td>".$row['duedate']."</td><td>".$row['booklink']."</td></tr>"; 
		}
		echo "</table>";
	}
			
	if(isset($_POST["submit"])){
		
		$bname=$_POST['bname'];
		$sql1 = "Update user set submitdate='$current_date' where uname='$uname' and bookname='$bname'";
				
		if(mysqli_query($conn, $sql1)){
			
		}
		else {
			echo "Error <br>" . mysqli_error($conn);
		}	
	
	
		$sql4 = "update user set submitstatus='Yes',finepaidstatus='Yes' where uname='$uname' and bookname='$bname'";
		if (mysqli_query($conn, $sql4)) {} 
		else {
			echo "Error <br>" . mysqli_error($conn);
		}
	}

	mysqli_close($conn);	

	
?>
</table>
<div class="container">
<br><br>
<form class="design" method="post">
	<div class="form-group">
		<label for="bookname" style='color:Black;margin-left:10px;padding-bottom:10px;Font-size:20px;'>Bookname:</label>
		<input type='text' class="form-control" name="bname" style="margin-right:20px;"><br>
		<center><input type='submit' class="btn btn-primary" style="background-color:Plum;color:Black;font-size:17px;padding:2px" value='Submit' name="submit"></center>
	</div>
		
</form>
</div>

</body>
</html>

