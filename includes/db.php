<?php
//for localhost
$con = mysqli_connect("localhost","root","avnishy44","mydb");

//for hosting
//$con = mysqli_connect("localhost","id5119464_admin","avnishy44","id5119464_mydb");

if(mysqli_connect_errno()){
  echo "Failed to connect to MySql: ".mysqli_connect_errno();
}

?>
