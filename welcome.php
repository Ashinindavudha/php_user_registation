<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome Page</title>
	<link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
	<div class="body content">
		<div class="welcome">
			<div class="alert alert-error"><?= $_SESSION['message']; ?></div>
			<span class="user"><img src="<?= $_SESSION['avatar'] ?>" alt=""></span><br><br>
			Welcome:: <span class="user"><?= $_SESSION['username'] ?></span>
		</div>
	</div>

	<?php 

$mysqli = new mysqli('localhost', 'root', '', 'php_login') or die(mysqli_error($mysqli)); // database connection
$sql = 'SELECT username, avatar FROM user';
$result = $mysqli->query($sql); // $result = mysqli_result object
	 ?>

	 <div id="registered">
	 	<span>All registered users </span>
	 	<?php 
while ($row = $result->fetch_assoc()) {
    // echo '<pre>';
    // print_r($row);
    // echo '</pre>';
echo "<div class='userlist'><span>$row[username]</span><br>";
echo "<img src='$row[avatar]'></div>";

}
	 	 ?>
	 </div>
</body>
</html>