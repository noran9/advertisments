
<?php include ('header.php');
/* Database connection */
	include('db.php');
	$conn = db();
	$id = $_GET['id'];

/*Query for product */
	$result = mysqli_query($conn, "SELECT * FROM product WHERE ID = '$id'");
	$product = mysqli_fetch_assoc($result);


/* Query for user */
	$res = mysqli_query($conn, "SELECT * FROM users WHERE ID = {$product['user_id']}");
	$user = mysqli_fetch_assoc($res);

/* Rest API for the comments */
	/* Get request for comments*/
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		http_response_code(200);

	/* Post request for comments*/
	} if(isset($_POST['submit'])){

			/* First two attributes for a comment*/
			$comment = mysqli_real_escape_string($conn, $_POST['comment']);
			$product_id = $product['ID'];

			/* If the user is logged in - use his email and username */
			if(isset($_SESSION['user_id'])){
				$username = $_SESSION['user'];
				$email = $_SESSION['user_email'];
			}
			else{
				$username = mysqli_real_escape_string($conn, $_POST['username']);
				$email = mysqli_real_escape_string($conn, $_POST['email']);
			}

			/* Inserting the comment */
			$query = "INSERT INTO comments (comment, product_id, username, email) VALUES ('$comment', '$product_id', '$username', '$email')";
			$conn -> query($query);
			
		}
	else
		http_response_code(405);

	/*Query for comments*/
	$comments = mysqli_query($conn, "SELECT * FROM comments WHERE product_id = '$id'");
?>


<div class="container jumbotron justify-content-center">
<h1><?php echo $product['title'];?></h1>
<p>Price: <?php echo $product['price']; ?></p>
<p class="lead"><?php echo $product['description']; ?></p>
<img src="<?php echo $product['photo_path']; ?>"><br><br>
<h6>Posted by: <?php echo $user['user_name']; ?></h6>


<?php 
if(isset($_SESSION['user_id'])){
	if($product['user_id'] == $_SESSION['user_id']) { ?>

<!-- Users can only edit or delete their posts -->
<a class ="btn btn-primary" href="edit.php?id=<?php echo $id;?>">Edit</a>
<a class="btn btn-danger" href="delete.php?id=<?php echo $id;?>" onsubmit="return confirm('Do you really want to delete this post?');">Delete</a><br>

<?php } } ?>
<!-- Comment section -->
<!-- Comment form -->
<br>
<h1>Add a comment</h1>
<form action="single.php?id=<?php echo $id?>" method="POST">
<?php
	if(!isset($_SESSION['user_id'])){ ?>
	<label>Nickname</label><br>
	<input class="form-control bg-light" type="text" id="username" name="user_name"/><br>
	<label>Email</label><br>
	<input class="form-control bg-light" type="text" id="email" name="email"><br>
<?php } ?>
	<label>Comment</label><br>
	<textarea class="form-control bg-light" id="comment" name="comment"></textarea><br>
	<input class="btn btn-primary" type="submit" name="submit" value="Add comment">
</form>

<!-- Comments for the product -->
<br><h1>Comments</h1><br>
<?php while ($comm = mysqli_fetch_assoc($comments)) { ?>
	<div class="card card-body bg-light">
		<h5><?php echo $comm['username']; ?></h5><hr class="bg-light">
		<p class="lead"><?php echo $comm['comment'];?></p>
	</div>
<?php } ?>

</div>
<?php include ('footer.php') ?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('form').on('submit', function(e){
			e.preventDefault();


			var username = $('#username').val();
			var email = $('#email').val();
			var comment = $('#comment').val();

			$.ajax({
				type: "POST",
				//url: "single.php?id=<?php echo $id?>",
				data: {'username' : username, 'email' : email, 'comment' : comment, 'submit' : true},
				success: function(){
					alert('Added comment!');
				}
			});

		});
	});
</script>