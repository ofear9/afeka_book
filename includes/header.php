<?php 
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");
include("includes/classes/Message.php");


if(isset($_SESSION['username'])){
	$userLoggedIn = $_SESSION['username'];
	$user_details_query = mysqli_query($con,"SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);

}
else{
	header("Location: register.php");

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>AfekBook - <?php echo $user['first_name']." " .$user['last_name']; ?></title>

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>


	<!--CSS -->
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<body>

	<div class="top_bar">
		<div class="logo">
			<a href="index.php">AfekBook!</a>
			<img id="afeka_logo" src="assets/images/afeka.png">
		</a>

	</div>
	<nav>
		<a href="<?php echo $userLoggedIn; ?>">
			<?php echo $user['first_name']; ?>
		</a>
		<a href="index.php">
			<i class="fa fa-home fa-lg"></i>
		</a>
		<a href="#">
			<i class="fa fa-envelope fa-lg"></i>
		</a>
		<a href="#">
			<i class="fa fa-bell-o fa-lg"></i>
		</a>
		<a href="requests.php">
			<i class="fa fa-users fa-lg"></i>
		</a>
		<a href="#">
			<i class="fa fa-cog fa-lg"></i>
		</a>
		<a href="includes/handlers/logout.php">
			<i class="fa fa-sign-out fa-lg"></i>
		</a>


	</nav>    

</div>

<div class="wrapper">
