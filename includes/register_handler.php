<?php

//Declaring var
$fname = "";
$lname = "";
$em = "";
$em2 = "";
$password = "";
$password2 = "";
$date = "";
$error_array = array() ;
$_SESSION['reg_fname'] = ""; 
$_SESSION['reg_lname'] = "";
$_SESSION['reg_email'] = "";
$_SESSION['reg_email2'] = "";


if(isset($_POST['register_button'])){
	//Regustration form values

	//First name
	$fname = strip_tags($_POST['reg_fname']);  //Remove tags
	$fname = str_replace(' ','',$fname);  // Remove spaces
	$fname = ucfirst(strtolower($fname));  //Upper
	$_SESSION['reg_fname'] = $fname;     //Stores first name into session variable


    //Last name
	$lname = strip_tags($_POST['reg_lname']);  //Remove tags
	$lname = str_replace(' ','',$lname);  // Remove spaces
	$lname = ucfirst(strtolower($lname));  //Upper
	$_SESSION['reg_lname'] = $lname;

    //email
	$em = strip_tags($_POST['reg_email']);  //Remove tags
	$em = str_replace(' ','',$em);  // Remove spaces
	$em = ucfirst(strtolower($em));  //Upper
	$_SESSION['reg_email'] = $em;

	//email 2
	$em2 = strip_tags($_POST['reg_email2']);  //Remove tags
	$em2 = str_replace(' ','',$em2);  // Remove spaces
	$em2 = ucfirst(strtolower($em2));  //Upper
	$_SESSION['reg_email2'] = $em2;

    //Password
 	$password = strip_tags($_POST['reg_password']);  //Remove tags
 	$_SESSION['reg_email2'] = $em2;
 	$password2 = strip_tags($_POST['reg_password2']);  //Remove tags

	//Date
	$date = date("Y-m-d"); //Current date 

	if($em == $em2) {
		// Check if the email is in valid format
		if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
			$em =filter_var($em, FILTER_VALIDATE_EMAIL); 

			//Check if email exiest
			$e_check = mysqli_query($con,
				"SELECT email FROM users WHERE email='$em'");

			//Count the number of rows retured
			$num_rows = mysqli_num_rows($e_check);
			if($num_rows > 0){
				array_push($error_array,"Email alredy in use<br>");
			}

		}
		else{
			array_push($error_array, "Invalid email format<br>");
		}

	}

	else{
		array_push($error_array,"Emails don't match<br>");
	}

	if (strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($error_array, "Your first name must be between 2 and 25 charecters<br>");
	}
	if (strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($error_array,"Your last name must be between 2 and 25 charecters<br>");
	}
	if($password != $password2) {
		array_push($error_array,"Password don't match<br>");
	}
	else{
		if(preg_match('/[^A-Za-z0-9]/', $password))
			array_push($error_array, "Password must contains english letters or numbers<br>");
	}

	if (strlen($password) > 30 || strlen($password) < 5 ){
		array_push($error_array, "Password must be betwwn 5 and 30 charecters<br>");
	}


	if(empty($error_array)){
		$password = md5($password); //Encrypt password before send it to DB

		// Genreate usern name 
		$username = strtolower($fname . "_" .$lname);
		$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");
		$i = 0;
		//If user name exists
		while(mysqli_num_rows($check_username_query) != 0){
			$i++; 
			$username =  strtolower($fname . "_" .$lname). "_" . $i;
			$check_username_query = mysqli_query($con,"SELECT username FROM users WHERE username='$username'");

		}

		//Profile picture assignmant
		$rand = rand(1,2);
		if($rand == 1)
			$profile_pic = "assets/images/profile_pic/defaults/head_deep_blue.png";
		else if ($rand ==2 )
			$profile_pic = "assets/images/profile_pic/defaults/head_emerald.png";


		$query = mysqli_query($con,"INSERT INTO users VALUES ('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no', ',') ");

		array_push($error_array,"<span style='color: #14C800;'> You are all set ! Go head and login ! </span><br>");

		//Clear session var
		$_SESSION['reg_fname'] = ""; 
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";

	}

}
?>