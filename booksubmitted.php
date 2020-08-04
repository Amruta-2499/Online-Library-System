<html>
<head>
	<title>SubmittedBooks Page</title>
	
	<style>
	table{
		border:1px solid black;
		border-collapse:collapse;
		width:100%;
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


<table>	
	<tr>
		<th>Bookname</th>
		<th>Submitted On</th>
	</tr>

<?php

	session_start();
	$uname=$_SESSION['uname'];
	
	if(!isset($uname))
	{
		header('Location:./loginpage.php');
	}
	
	$conn = mysqli_connect("localhost","root","","librarydb");

	if (!$conn){
		die("Connection failed: ".mysqli_connect_error());
	}

	$sql = "SELECT bookname,submitdate FROM user where uname='$uname' and submitstatus='Yes'";
	
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
			echo "<tr><td>".$row['bookname']."</td><td>".$row['submitdate']."</td></tr>"; 
		}
		echo "</table>";
	}
			
	mysqli_close($conn);
?>

</table>
</body>
</html>

