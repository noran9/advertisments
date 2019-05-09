<?php
//configuration file, for connecting to the database
//we only need to update this file, in case 
//vrne mysqli objekt
function db(){
return mysqli_connect("localhost", "root", "123456", "advertisments");
}

?>