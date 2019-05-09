<?php 
	include_once('header.php');
	include_once('db.php');

	if(isset($_POST["submit"])){
		$conn = db();
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$description = mysqli_real_escape_string($conn, $_POST['description']);
		$price = mysqli_real_escape_string($conn, $_POST['price']);
		$user_id = $_SESSION["user_id"];
		$path = 'images/'.$_FILES["image"]["name"];
		move_uploaded_file($_FILES["image"]["tmp_name"], $path);

		$query = "INSERT INTO product (user_id, title, description, photo_path, price) VALUES ('$user_id',  '$title', '$description', '$path', '$price')";
		$conn -> query($query);
	}
?>
<div class="container jumbotron justify-content-center">
<h2>Create a new advertisment</h2><br>
<form action="create.php" method="POST" enctype="multipart/form-data">
	<div class="form-group">
	<label>Title</label><br>
	<input class="form-control bg-light" type="text" name="title"></div>
	<div class="form-group"></div>
	<label>Description</label><br>
	<textarea class="form-control bg-light" type="text" name="description"></textarea><br>
	<label>Price</label><br>
	<input class="form-control bg-light" type="number" name="price"><br>
	<label>Image</label><br>
	<input class="form-control" type="file" name="image"><br><br>
	<input class="btn btn-primary" type="submit" name="submit" value="Create">
</form>
</div>
<?php include 'footer.php' ?>