<?php include_once 'header.php';

	include_once "db.php";
	function register_user($user, $email, $password){
		$conn = db();
		$user = mysqli_real_escape_string($conn, $user);
		$password = sha1(mysqli_real_escape_string($conn, $password));
		$query = "INSERT INTO users (user_name, user_email, password_hash) VALUES ('$user', '$email', '$password')";
		$conn -> query($query);
		?>
		<div class="alert alert-success">Registration successful!</div>
		<?php
	}


	$error = "";
	if(isset($_POST["submit"])){
		if($_POST["password"] != $_POST["repeat_password"])
			$error = "Passwords do not match";
		else{
			register_user($_POST["user_name"], $_POST["email"], $_POST["password"]);
		}
	}
?>

<div class="container jumbotron justify-content-center">
<h1>Sign up here</h1><br>
<form action = "register.php" method="POST">
	<label><?php echo $error; ?></label>
	<label>Email</label><br>
	<input class="form-control bg-light" type="text" name="email"/><br>
	<label>Username</label><br>
	<input class="form-control bg-light" type="text" name="user_name"><br>
	<label>Password</label><br>
	<input class="form-control bg-light" type="password" name="password"><br>
	<label>Repeat password</label><br>
	<input class="form-control bg-light" type="password" name="repeat_password"><br><br>
	<input class="btn btn-primary" type="submit" name="submit" value="Register">
</form>
</div>

<?php include_once 'footer.php'?>
