<?php include_once 'header.php';
	include_once 'db.php';
	$conn = db();

	$error = '';
	if(isset($_POST["submit"])){
		if(isset($_POST['user_name']) && isset($_POST['password'])){
			$user = mysqli_real_escape_string($conn, $_POST['user_name']);
			$new_pass = sha1(mysqli_real_escape_string($conn, $_POST['password']));

			$query = "SELECT * FROM users WHERE user_name = '$user' AND password_hash = '$new_pass'";
			$res = mysqli_query($conn, $query);
			if(mysqli_error($conn))
			{
			var_dump(mysqli_error($conn));
			exit();
			}

			$row = mysqli_fetch_assoc($res);
			if(isset($row['user_name'])){
				$_SESSION['user'] = $row['user_name'];
				$_SESSION['user_id'] = $row['ID'];
				$_SESSION['user_email'] = $row['user_email'];
			header('Location: http://localhost/advertisments/index.php');
			}
			else{
				echo "Failed to log in";
			}
		}
		else{
		echo "Please enter user name and password";
		}
	}
?>
<div class="container jumbotron justify-content-center">
	<h1>Welcome back! </h1><br>
<form action="login.php" method="POST">
	<label>Username</label>
	<input class="form-control bg-light"  type="text" name="user_name"><br>
	<label>Password</label>
	<input class="form-control bg-light" type="password" name="password"><br>
	<input class="btn btn-primary" type="submit" name="submit" value="Login">
</form>
</div>
<?php include 'footer.php'; ?>