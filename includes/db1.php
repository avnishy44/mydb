<?php
/* Database connection settings */
$host = 'localhost';
$user = 'root';
$pass = 'avnishy44';
$db = 'mydb';

$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);