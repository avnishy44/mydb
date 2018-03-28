<?php
/* Database connection settings */

$host = 'localhost';
$user = 'root';
$pass = 'avnishy44';
$db = 'mydb';
/*
$host = 'localhost';
$user = 'id5119464_admin';
$pass = 'avnishy44';
$db = 'id5119464_mydb';
*/
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);