<?php
	session_start();

	$unameErr = $passErr = $conpassErr = "";
	$uname = $pass = $conpass = "";
	$flag=true;
	
	if(isset($_POST["submit"])){
		$uname = $_POST["uname"];
		$pass = $_POST["pass"];
		$conpass = $_POST["conpass"];
				
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

		if(empty($conpass)){
			$conpassErr="Confirm your password";
			$flag=false;
		}

		if ($pass==$conpass){	

			$conn = mysqli_connect("localhost","root","", "librarydb");

			if (!$conn){
				die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "Update userinfo set pass='$pass' where uname='$uname'";
	
			if (mysqli_query($conn, $sql)) {
				echo "Password resetted successfully.";
			} 
			else {
				echo "Error <br>" . mysqli_error($conn);
				$flag=false;
			}
		
			mysqli_close($conn);
		}
		else{
			$conpassErr = "Invalid Password";
			$flag = false;
		}
	
		if($flag==true){
		header('Location:./loginpage.php');	
		}
		
	
		
		
	}
?>

<html>
<head><title>Reset-Password Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="./jquery.js"></script>

<style>
	
.design{
	background:linear-gradient(rgba(159,128,255,0.4),rgba(191,128,255,0.6),rgba(255,128,223,0.5),rgba(255, 51, 204,0.4));
	border:3px solid black;
	border-radius:5px;
	position:absolute;
	top:10%;
	left:30%;
	color:black;
}

@media (min-width: 1000px){
    .container{
        max-width: 700px;
    }
}

</style>
</head>

<body>
<div class="container">
<br><br>
<form class="design" method="post">
<br><br>
	<div class="form-group">
		<label for="fname" style='color:Black;margin-left:10px;Font-size:20px;'>Username:</label>
		<input type='text' class="form-control" name="uname" style="margin-left:69px;" placeholder="Enter username"><span style="color:red"><?php echo $unameErr; ?></span>
	</div>
	<div class="form-group">
		<label for="password" style='color:Black;margin-left:10px;Font-size:20px;'>New Password:</label>
		<input type='password' class="form-control" name="pass" style="margin-left:30px;" placeholder="Enter New password"><span style="color:red"><?php echo $passErr; ?></span>
	</div>
	<div class="form-group">
		<label for="password" style='color:Black;margin-left:10px;Font-size:20px;'>Confirm Password:</label>
		<input type='password' class="form-control" name="conpass" placeholder="Confirm your password"><span style="color:red"><?php echo $conpassErr; ?></span>
	</div>
	<br>
	<center><pre><input type='submit' name="submit" class="btn btn-primary" style="color:black;background-color:#fffcca;;padding:5px"></center> 
	<br>
</form></div>
</body>
</html>

