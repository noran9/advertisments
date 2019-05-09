<?php
class comment{


	function all(){
		$comments = comment_model::all();
		require_once("view/comment.php");
	}

	function insert(){

		if(isset($_SESSION['user']) && ($_SESSION['user']) == 'admin'){
			$username = 'admin';
			$email = 'admin@admin';
		}
		else{
			$username=$_POST["username"];
       		$email=$_POST["email"];
    	}
        $comment=$_POST["comment"];
        $product_id=$_POST["product_id"];

        $c = comment_model::insert($comment, $product_id, $username, $email);

        require_once("view/add.php");
	}

	function delete(){
        //read the id passed over query string
        if(isset($_GET["id"]))
        $id=$_GET["id"];

        //execute the delete command on the model
        $c=comment_model::delete($id);
        //return a simple view of confirming the deletion
        require_once("view/delete.php");
    }

    function forUser(){
    	if(isset($_GET["id"]))
        $id=$_GET["id"];

        $forUser=comment_model::forUser($id);
        require_once("view/forUser.php");
    }

}