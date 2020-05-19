<?php 
session_start(); //FOR ERROR MESSAGE
$SESSION['message'] = '';
$mysqli = new mysqli('localhost', 'root', '', 'php_login') or die(mysqli_error($mysqli)); // database connection
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// tow passwords are equal to each other
	if ($_POST['password'] == $_POST['confirmpassword']) {
		//print_r($_FILES); die;//preview image.
		$username = $mysqli->real_escape_string($_POST['username']);
		$email = $mysqli->real_escape_string($_POST['email']);
		$password = md5($_POST['password']); // md5 hash password security
		$avatar_path = $mysqli->real_escape_string('image/'.$_FILES['avatar']['name']);

		//make sure file type is image
		if (preg_match("!image!", $_FILES['avatar']['type'])) {
			//copy image to image/ folder
			if (copy($_FILES['avatar']['tmp_name'], $avatar_path)) {
				$_SESSION['username'] = $username;
				$_SESSION['avatar'] = $avatar_path;
				$sql = "INSERT INTO user (username, email, password, avatar)" . "VALUE ('$username', '$email', '$password', '$avatar_path')";


				//if the quer is successful, redirect to welcomephp page, done!
				if ($mysqli->query($sql) === true) {
					$_SESSION['message'] = "Registraion succeful ! Added $username to the database";
					header("location: welcome.php");
				}
			
			else {
				$_SESSION['message'] = "User could not be added to the database!";
			}
		}

		else {
			$_SESSION['message'] = "File Upload failed!";

		}
	}
	else {
		$_SESSION['message'] = "Please only upload GIF, JPG, or PNG images";
	}
}
else {
	$_SESSION['message'] = "Two password do not match";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>PHP Login & Registration</title>
	<link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="asset/css/style.css" type="text/css">
</head>
<body>

	<div class="body-content">
		<div class="module">
			<h1>Create an account</h1>
			<form class="form" action="index.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<div class="alert alert-error"><?= $_SESSION['message']; ?></div>
				<div class="alert alert-error"></div>
				<input type="text" placeholder="User Name" name="username" required />
				<input type="email" placeholder="Email" name="email" required />
				<input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
				<input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
				<div class="avatar"><label>Select your avatar: </label><input type="file" name="avatar" accept="image/*" required /></div>
				<input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
			</form>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<a href="https://codepen.io/clevertechie/pen/NbxyPX">Click Here!</a>
		</div>
	</div>
</body>
</html>