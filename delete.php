<?php include 'db.php';

	$conn = db();
	if(isset($_GET['id'])){
		$id = $_GET['id'];
	

	$query = "DELETE FROM product WHERE ID=$id";
	$result = mysqli_query($conn, $query);

	if(mysqli_error($conn))
	{
	var_dump(mysqli_error($conn));
	}

	header('Location: http://localhost/advertisments/index.php');
	}

?>

