<?php
include("includes/connection.php");
if(isset($_POST['submit'])){
		
		$name=mysqli_real_escape_string($con,$_POST['name']);
		$email=mysqli_real_escape_string($con,$_POST['email']);
		$website=mysqli_real_escape_string($con,$_POST['website']);
		$message=mysqli_real_escape_string($con,$_POST['message']);
		
		
		$get_email="SELECT * FROM users where email='$email'";
		$run_email = mysqli_query($con,$get_email);
		$check=mysqli_num_rows($run_email);
		
		if($check==1){
			
			echo"<script>alert('Thankx for your feedback.')</script>";
			exit();
			}				
			$insert= "insert into contact (name,email,website,message,added_date) values ('$name','$email','$website','$message',',NOW())";
			$run_insert=mysqli_query($con,$insert);	
			
			if($run_insert){
				$_SESSION['email']=$email;
				echo"<script>alert('Submitt Successful..!')</script>";
			echo"<script>window.open('home.php','_self')</script>";

				}
				
				}
		
?>