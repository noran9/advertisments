<div class="jumbotron">

	<h4><?php echo $forUser[0]->username;?>'s comments</h4>
	<?php foreach($forUser as $comm){ ?>
	<div class="card card-body">
		<h4><?php echo $comm->username;?></h4>
		<p class="lead"><?php echo $comm->comment;?></p>
		<a class="btn btn-danger" href="index.php?controller=comment&action=delete&id=<?php echo $comm->id; ?>"class="btn btn-danger">Delete</a>
	</div>
	<?php } ?>

</div>