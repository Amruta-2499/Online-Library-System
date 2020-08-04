<?php
		
	$fname = $mname = $lname = $email = $phone = $addr = $gender = $photo = $uname = $pass = $conpass = "";
	$fnameErr = $mnameErr = $lnameErr = $emailErr = $phoneErr = $addrErr = $photoErr = $unameErr = $passErr = $conpassErr = "";
	$flag=true;
	
	if(isset($_POST["submit"])){
		$fname = $_POST["fname"];
		$mname = $_POST["mname"];
		$lname = $_POST["lname"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
		$addr = $_POST["addr"];
		$gender = $_POST["gender"];
		$uname = $_POST["uname"];
		$pass = $_POST["pass"];
		$conpass = $_POST["conpass"];
		
/*		$photo=addslashes($_FILES["photo"]["name"]);
		$tempfilename=addslashes(file_get_contents($_FILES["photo"]["tmp_name"]));
		$filetype=addslashes($_FILES["photo"]["type"]);
		$array=array('jpg','jpeg');
		$ext=pathinfo($filename,PATHINFO_EXTENSION);
		move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $_FILES["photo"]["name"]); 
      				//echo "Stored in: " . "uploads/" . $_FILES["photo"]["name"]; 
		if(!empty($filename))
		{
			if (in_array($ext,$array))
			{
			}
			else{
				echo "unsupproted format";
			}
		}
		
	*/	
		
		
		if (empty($fname)){
			$fnameErr = "Firstname is required";
			$flag=false;
		}
		elseif (!preg_match("/^[a-zA-Z]*$/",$fname)){
			$unameErr = "Firstname must contain only alphabets";
			$flag = false;
		}
		
		if (empty($mname)){
			$mnameErr = "Middlename is required";
			$flag=false;
		}
		elseif (!preg_match("/^[a-zA-Z]*$/",$mname)){
			$mnameErr = "Middlename must contain only alphabets";
			$flag = false;
		}
	
		if (empty($lname)){
			$lnameErr = "Lastname is required";
			$flag=false;
		}
		elseif (!preg_match("/^[a-zA-Z]*$/",$lname)){
			$lnameErr = "Lastname must contain only alphabets";
			$flag = false;
		}
		
		if (empty($email)){
			$emailErr = "Email-Id is required";
			$flag=false;
		}
		
		if (empty($phone)){
			$phoneErr = "Mobile No. is required";
			$flag=false;
		}
		elseif (!preg_match("/^[0-9]{10}$/",$phone)){
			$phoneErr = "Mobile No. must contain only 10 numbers";
			$flag = false;
		}

		if (empty($addr)){
			$addrErr = "Address is required";
			$flag=false;
		}

		if (empty($photo)){
			$photoErr = "Photo is required";
			$flag=false;
		}
		elseif (!preg_match("/^.{6,}+$/",$photo)){
			$photoErr = "Username must contain atleast 6 characters";
			$flag = false;
		}
		
		if (empty($uname)){
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
		elseif ($pass!=$conpass){
			$conpassErr = "Invalid Password";
			$flag = false;
		}
		
		if ($pass==$conpass){	
			$conn = mysqli_connect("localhost","root","", "librarydb");
	
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			$sql = "INSERT INTO userinfo VALUES('$fname', '$mname', '$lname', '$email', '$phone', '$addr', '$gender', '$photo', '$uname', '$pass')";
	
			if (mysqli_query($conn, $sql)) {
				echo "New record inserted successfully.";
			} 
			else {
				echo "Error <br>" . mysqli_error($conn);
				$flag=false;
			}
				
			mysqli_close($conn);
		}
					
				
		if($flag==true){
		header('Location:./loginpage.php');	
		}
	}
?>
<html>
<head><title>SIGNUP Page</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="./jquery.js"></script>

<style>
.design{
	background:linear-gradient(rgba(0,100,234,0.4),rgba(1,255,233,0.6));
	border:3px solid black;
	border-radius:5px;
	position:absolute;
	left:37%;
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
<h1 style="font-family:timenewroman;align:center;margin-top:30px;color:Red;margin-left:40%;">Registration Form</h1>
<div class="container">
<form class="design" method="post">

<br><br>
	<div class="form-group">
		<label for="firstname" style='color:Black;margin-left:10px;Font-size:20px;'>First Name:</label>
		<input type="text" class="form-control" name="fname" placeholder="Enter firstname"><span style="color:red"><?php echo $fnameErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="middlename" style='color:Black;margin-left:10px;Font-size:20px;'>Middle Name:</label>
		<input type="text" class="form-control" name="mname" placeholder="Enter middlename"><span style="color:red"><?php echo $mnameErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="lastname" style='color:Black;margin-left:10px;Font-size:20px;'>Last Name:</label>
		<input type="text" class="form-control" name="lname" placeholder="Enter lastname"><span style="color:red"><?php echo $lnameErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="email" style='color:Black;margin-left:10px;Font-size:20px;'>Email Id:</label>
		<input type="email" class="form-control" name="email" placeholder="Enter email Id"><span style="color:red"><?php echo $emailErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="phone" style='color:Black;margin-left:10px;Font-size:20px;'>Mobile No.:</label>
		<input type="text" class="form-control" name="phone" placeholder="Enter mobile no."><span style="color:red"><?php echo $phoneErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="addr" style='color:Black;margin-left:10px;Font-size:20px;'>Address:</label>
		<input type="text" class="form-control" name="addr" placeholder="Enter your address"><span style="color:red"><?php echo $addrErr; ?></span>
	</div><br>
	<div class="form-group">
		<pre><label for="gender" style='color:Black;margin-left:10px;Font-size:20px;'>Gender:   </label><input type='radio' name="gender" value="male">Male      <input type='radio' name="gender" value="female">Female  </pre>
	</div><br>
	<div class="form-group">
		<label for="photo" style="color:Black;margin-left:10px;Font-size:20px">Photo:</label>
		<input type='file' style="background-color:white" name="photo"><span style="color:red"><?php echo $photoErr; ?></span><br>
	</div><br>
	<div class="form-group">
		<label for="fname" style='color:Black;margin-left:10px;Font-size:20px;'>Username:</label>
		<input type='text'class="form-control" name="uname" placeholder="Enter username"><span style="color:red"><?php echo $unameErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="password" style='color:Black;margin-left:10px;Font-size:20px;'>New Password:</label>
		<input type='text'class="form-control" name="pass" placeholder="Enter New password"><span style="color:red"><?php echo $passErr; ?></span>
	</div><br>
	<div class="form-group">
		<label for="password" style='color:Black;margin-left:10px;Font-size:20px;'>Confirm Password:</label>
		<input type='text'class="form-control" name="conpass" placeholder="Confirm your password"><span style="color:red"><?php echo $conpassErr; ?></span>
	</div><br>
	<br>
	<center><pre><input type="Submit" name="submit" style="background-color:Plum;padding:5px;font-family:timenewroman;font-size:20px" height="5px">              <input type="reset" value="Clear" style="background-color:Plum;padding:5px;font-family:timenewroman;font-size:20px" height="5px"></pre></center>
	<br>
	
</form> 
</div>    
</body>
</html>