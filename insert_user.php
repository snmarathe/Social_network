<?php
include("includes/connection.php");

	if(isset($_POST['sign_up'])){

		$first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
		$last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
		$pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
		$email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
		$country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
		$gender = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
		$status = "verified";
		$posts = "no";

		if(strlen($pass) <8 ){
			echo"<script>alert('Password should have at least 8 characters!')</script>";
			exit();
		}

		$check_email = "select * from users where email_id='$email'";
		$run_email = mysqli_query($check_email);

		$check = mysqli_num_rows($run_email);

		if($check == 1){
			echo "<script>alert('This email ID is already registered to another account. Please try using another email ID.')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
			exit();
		}

		$rand = rand(1, 3); //Random number between 1 and 3

			if($rand == 1)
				$profile_pic = "head_red.png";
			else if($rand == 2)
				$profile_pic = "head_sun_flower.png";
			else if($rand == 3)
				$profile_pic = "head_turqoise.png";

		$cover_pic = "default_cover.jpg";

		$insert = "insert into users (first_name,last_name,email_id,country,gender,profile_pic,cover_pic,reg_date,recovery,posts,status,password)
		values('$first_name','$last_name','$email','$country','$gender','$profile_pic','$cover_pic',NOW(),'Harry Potter','$posts','$status','$pass')";
		
		$query = mysqli_query($con, $insert);

		if($query){
			echo "<script>alert('Hello $first_name, you are good to go.')</script>";
			echo "<script>window.open('signin.php', '_self')</script>";
		}
		else{
			echo "<script>alert('Registration failed, please try again!')</script>";
			echo "<script>window.open('signup.php', '_self')</script>";
		}
	}
?>