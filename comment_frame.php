<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>
	<?php 
		require 'config/config.php';
		include("includes/classes/User.php");
		include("includes/classes/Post.php");

		if(isset($_SESSION['username'])){
			$userLoggedIn = $_SESSION['username'];
			$user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
			$user = mysqli_fetch_array($user_details_query);

		}
		else{
			header("Location: register.php");
		}
	?>


	<script>
		function toggle(){
		    var element = document.getElementById("comment_section");

		    if(element.style.display == "block")
		        element.style.display = "none";
		    else
		        element.style.display = "block";
		}

	</script>

    <php>

    </php>

</body>
</html>