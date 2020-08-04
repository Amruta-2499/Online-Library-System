<?php
	session_start();
	
	$unameErr = $passErr = "";
	$uname = $pass = "";
	$flag=true;
	
	if(isset($_POST["submit"])){
		$uname = $_POST["uname"];
		$pass = $_POST["pass"];
		$_SESSION['uname'] = $uname;
		
		if (empty($_POST["uname"])){
			$unameErr = "Username is required";
			$flag=false;
		}
		elseif (!preg_match("/^.{6,}+$/",$uname)){
			$unameErr = "Username must contain atleast 6 characters";
			$flag = false;
		}
		if(empty($pass)){
			$passErr="Password is required";
			$flag=false;
		}
		elseif (!preg_match("/^.{6,}+$/",$pass)){
			$passErr = "Password must contain atleast 6 characters";
			$flag = false;
		}
			
		if($flag==true){
		$conn = mysqli_connect("localhost","root","", "librarydb");

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
			$flag = false;
		}

		$sql = "select uname from userinfo where uname='$uname' and pass='$pass'";
		if (mysqli_query($conn, $sql)) {
			$flag=true;
		} 
		else {
			echo "Error <br>" . mysqli_error($conn);
			$flag=false;
		}
			
		mysqli_close($conn);
	
		}
		
		if($flag==true){
			header('Location:./homepage.php');	
		}
			
	}
?>

<html lang="en">
<head><title>LOGIN Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style> 
	body{
		background-image:url("img1.jpg");
		background-repeat:no-repeat;
		background-size:cover;
	}

	.design{
		background:#0ee8f0;
		border:3px solid black;
		border-radius:5px;
		position:absolute;
		top:28%;
		width:30%;
		left:20%;
		color:black;
	}

	@media (min-width:1000px){
		.container{
			max-width: 700px;
		}
	}
</style>
</head>

<body>
<div>
<h1 style="color:blue;background:Plum;text-align:center;padding-bottom:15px;">Library Management System</h1>
</div>
<div class="container">
<br><br>

<form class="design" method="post">
<br><br><br>
	<div class="form-group">
		<label for="username" style='color:Black;margin-left:10px;Font-size:20px;'>Username:</label>
		<input type='text' class="form-control" name="uname" style="margin-right:10px;" placeholder="Enter username" /><span style="color:red"><?php echo $unameErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="password" style='color:Black;margin-left:10px;Font-size:20px;'>Password: </label>
		<input type='password' class="form-control" name="pass" style="margin-right:10px;" placeholder="Enter password"><span style="color:red"><?php echo $passErr; ?></span>
	</div>
	<br><br>
	<center><pre><input type='submit' class="btn btn-primary" style="background-color:Plum;color:Black;font-size:17px;padding:5px" value='Login' name="submit">       <input type='button' class="btn btn-primary" value="SignUp" style="background-color:Plum;color:Black;font-size:17px;padding:5px" onclick="window.location.href='registerpage.php'"></pre></center>
	<center><a href="resetpasspage.php" style="color:red;">forgotpassword?</a></center>
	<br>
</form></div>

</body>
</html>

