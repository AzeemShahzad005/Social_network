<?php
include("includes/connection.php");
if(isset($_POST['sign_up'])){
		
		$name=mysqli_real_escape_string($con,$_POST['u_name']);
		$pass=mysqli_real_escape_string($con,$_POST['u_pass']);
		$email=mysqli_real_escape_string($con,$_POST['u_email']);
		$country=mysqli_real_escape_string($con,$_POST['u_country']);
		$gender=mysqli_real_escape_string($con,$_POST['u_gender']);
		$b_day=mysqli_real_escape_string($con,$_POST['u_birthday']);
		$name=mysqli_real_escape_string($con,$_POST['u_name']);
		$status="unverified";
		$posts="No";
		
		
		$get_email="SELECT * FROM users where u_email='$email'";
		$run_email = mysqli_query($con,$get_email);
		$check=mysqli_num_rows($run_email);
		
		if($check==1){
			
			echo"<script>alert('Email is already registered! Try another..')</script>";
			exit();
			}
			if(strlen($pass)<8){
			echo"<script>alert('Password shoud be minimum 8 characters..')</script>";
			exit();
			}
			else{
				
			$insert= "insert into users (u_name,u_pass,u_email,u_country,u_gender,u_birthday,u_image,registration_date,last_login,status,posts) values ('$name','$pass','$email','$country','$gender','$b_day','default.jpg',NOW(),NOW(),'$status','$posts')";
			$run_insert=mysqli_query($con,$insert);	
			
			if($run_insert){
				$_SESSION['u_email']=$email;
				echo"<script>alert('Registration Successfull.. You can LOGIN NOW !')</script>";
		//		echo"<script>window.open('home.php','_self')</script>";

				}
				
				}
		}
?>