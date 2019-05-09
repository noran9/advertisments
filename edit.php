<?php include_once ('header.php');
	include_once('db.php');

	$conn = db();

	if(isset($_GET['id'])){
		$id = $_GET['id'];

		$query = "SELECT * FROM product WHERE ID = '$id'";
		$result = mysqli_query($conn, $query);
		$product = mysqli_fetch_assoc($result);



		if(isset($_POST["submit"])){
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$description = mysqli_real_escape_string($conn, $_POST['description']);
			$price = mysqli_real_escape_string($conn, $_POST['price']);
			$user_id = $_SESSION["user_id"];
			$path = 'images/'.$_FILES["image"]["name"];
			move_uploaded_file($_FILES["image"]["tmp_name"], $path);

			if($path == 'images/')
				$path = $product['photo_path'];
			if($description == "")
				$description = $product['description'];

			$query = "UPDATE product SET
						user_id = '$user_id',
						title = '$title',
						description = '$description',
						photo_path = '$path',
						price = '$price'
				WHERE ID = '$id'";

			$conn -> query($query);
			header('Location: http://localhost/advertisments/index.php');
		}
 ?>
<div class="container jumbotron justify-content-center">
<h2>Edit advertisment</h2><br>
<form action="edit.php?id=<?php echo $product['ID']; ?>" method="POST" enctype="multipart/form-data">
	<label>Title</label><br>
	<input class="form-control bg-light" type="text" name="title" value="<?php echo $product['title']; ?>"><br>
	<label>Description</label><br>
	<textarea class="form-control bg-light" type="text" name="description" placeholder="<?php echo $product['description']; ?>"></textarea><br>
	<label>Price</label><br>
	<input class="form-control bg-light"  type="number" name="price" value="<?php echo $product['price']; ?>"><br>
	<label>Change Image</label><br>
	<input class="form-control"  type="file" name="image"><br><br>
	<input class="btn btn-primary" type="submit" name="submit" value="Save Changes">
</form>
</div>
<?php } include 'footer.php' ?>