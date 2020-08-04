<?php
	session_start();
	$uname=$_SESSION['uname'];
?>
<html>
<head>
	<title>SearchBooks Page</title>
	<script src="./jquery.js"></script>
	
	<style>
	.design{
		background:#0ee8f0;
		border:2px solid black;
		border-radius:5px;
		left:20%;
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

<div class="container">

<br><br>
<form name="form1" class="design" method="post" onsubmit>
	<div class="form-group">
		<label for="bookname" style='color:Black;margin-left:10px;padding-bottom:10px;Font-size:20px;'>Bookname:</label>
		<input type='text' class="form-control" name="bname" style="margin-left:10px;margin-right:20px;width:60%;">
		<input type='submit' class="btn btn-primary" style="background-color:Plum;color:Black;font-size:17px;padding:2px;" value='Get book' name="Submit">
	</div>
</form>
</div>


<table>	
	<tr>
		<th>Bookname</th>
		<th>Author</th>
		<th>Publication</th>
		<th>Price</th>
	</tr>

<?php
	$bname="";
	$link="";
	
	$current_date = date("Y-m-d");
	
	if(!isset($_SESSION['uname']))
	{
		header('Location:./loginpage.php');
	}
	
	$conn = mysqli_connect("localhost","root","","librarydb");

	if (!$conn){
		die("Connection failed: ".mysqli_connect_error());
	}

	$sql = "SELECT * FROM bookinfo";
	
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
			echo "<tr><td>".$row['bookname']."</td><td>".$row['author']."</td><td>".$row['publication']."</td><td>".$row['price']."</td></tr>"; 
		}
		echo "</table>";
	}
			
	if(isset($_POST["Submit"])){
		$bname = $_POST['bname'];
		$ddate = date("Y-m-d",strtotime("$current_date + 15 days"));
		
		$sql2 = "select * from bookinfo where bookname='$bname'";
		if(mysqli_query($conn,$sql2)){
				$result1 = mysqli_query($conn,$sql2);
		}	
		else {
			echo "Error <br>" . mysqli_error($conn);
		}
		
		if(mysqli_num_rows($result1) > 0){
			while($row1 = mysqli_fetch_assoc($result1)){
				$link=$row1['link'];
											
				
					$sql1 = "insert into user(uname,bookname,issuedate,duedate,booklink) values('$uname','$bname','$current_date','$ddate','$link')";
		
					if (mysqli_query($conn, $sql1)) {
					} 
					else {
						echo "Error <br>" . mysqli_error($conn);
					}
				
				
			}
		}	
	}

	mysqli_close($conn);	
?>
</table>

<script>
function alertmsg() {
  var x = document.forms["form1"]["bname"].value;
  if (x == "") {
    alert("Provide bookname");
    return false;
  }
}
</script>
</body>
</html>

