<?php 
$conn = db();

$users = mysqli_query($conn, "SELECT * FROM users");
?>
<div class="jumbotron">

	<h4>Add a comment</h4>
	<form action="index.php?controller=comment&action=insert" method="POST" enctype="multipart/form-data">
		<label>Product ID</label>
		<input class="form-control bg-light" type="text" name="product_id"></input>
		<label>Comment</label>
		<textarea class="form-control bg-light" name="comment"></textarea><br>
		<input class="btn btn-primary" type="submit" name="submit" value="Add">
	</form><br>

	<h4>All comments</h4>
	<?php foreach($comments as $comm){ ?>
	<div class="card card-body">
		<h4><?php echo $comm->username;?></h4>
		<p class="lead"><?php echo $comm->comment;?></p>
		<a class="btn btn-danger" href="index.php?controller=comment&action=delete&id=<?php echo $comm->id; ?>"class="btn btn-danger">Delete</a>
	</div>
	<?php } ?>

	<br><h4>Filter for user</h4>
	<select class="form-search bg-light" onchange="location = this.value;">
		<option>Select user</option>
		<?php foreach($users as $user) { ?>
			<option class="form-control" value="index.php?controller=comment&action=forUser&id=<?php echo $user['ID'];?>"><?php echo $user['user_name'];?></option>
			<?php } ?>
	</select>
</div>

