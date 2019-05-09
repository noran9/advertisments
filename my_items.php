<?php include 'header.php' ?>
		<?php
			//connecting to database
			include "db.php";
			$db = db();

			$products = mysqli_query($db, "SELECT * FROM product WHERE user_id = {$_SESSION['user_id']}
				ORDER BY ID DESC");

			if(mysqli_error($db)){
				echo mysqli_error($db);
			}

			$row; ?>
			<div class="container jumbotron justify-content-center">
			<h1>Your advertisments: </h1><hr>
			<?php while($row=mysqli_fetch_assoc($products)){ ?>
			<br>
			<h2><?php echo $row['title']; ?></h2>
			<p class="font-weight-bold"><?php echo $row['description']; ?></p>
			<p>Price: <?php echo $row['price']; ?></p>
			<img width = "600" src="<?php echo $row['photo_path'] ?>">
			<?php

			$res = mysqli_query($db, "SELECT * FROM users WHERE ID = {$row['user_id']}");
			$user = mysqli_fetch_assoc($res);

			?><br><br>
			<h6>Posted by: <?php echo $user['user_name']; ?></h6>
			<p><a class="btn btn-primary"  href="single.php?id=<?php echo $row['ID']; ?>" role = "button">View details</a></p><hr>

		<?php } ?>
	</div>
<?php include 'footer.php'; ?>