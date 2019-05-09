<?php

class comment_model{

	public $id;
	public $comment;
	public $product_id;
	public $username;
	public $email;

	public function __construct($id, $comment, $product_id, $username, $email){
		$this->id = $id;
		$this->comment = $comment;
		$this->product_id = $product_id;
		$this->username = $username;
		$this->email = $email; 
	}

	public static function insert($comment, $product_id, $username, $email){

		$conn = db();
		$comment = mysqli_real_escape_string($conn, $comment);
		$username = mysqli_real_escape_string($conn, $username);
		$email = mysqli_real_escape_string($conn, $email);

		$query = "INSERT INTO comments (comment, product_id, username, email) VALUES ('$comment', '$product_id', '$username', '$email')";
		$id = mysqli_insert_id($conn);
		$conn->query($query);
		return new comment_model($id, $comment, $product_id, $username, $email);
	}

	public static function all(){
		$all = [];
		$conn = db();
		$res = mysqli_query($conn, "SELECT * FROM comments");

		while($comment = mysqli_fetch_assoc($res)){
			$c = new comment_model($comment['ID'], $comment['comment'], $comment['product_id'], $comment['username'], $comment['email']);
			$all[] = $c;
		}

		return $all;
	}

	public static function delete($id){
      	$id = intval($id);
        $conn = db();
        $res = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM comments WHERE ID= $id"));
        $c = new comment_model($res['ID'], $res['comment'], $res['product_id'], $res['username'], $res['email']);
        $result = mysqli_query($conn,"DELETE FROM comments WHERE ID=$id");
        return $c;
    }

    public static function forUser($id){
    	$id = intval($id);
        $conn = db();
        $result = mysqli_query($conn, "SELECT * FROM users WHERE ID='$id'");
        $user = mysqli_fetch_assoc($result);

        $username = $user['user_name'];
        $res = mysqli_query($conn, "SELECT * FROM comments WHERE username = '$username'");
        $allForUser = [];

        while($comment = mysqli_fetch_assoc($res)){
			$c = new comment_model($comment['ID'], $comment['comment'], $comment['product_id'], $comment['username'], $comment['email']);
			$allForUser[] = $c;
		}
        return $allForUser;
    }

}