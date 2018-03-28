<?php
/* Database connection settings */

$host = 'localhost';
$user = 'root';
$pass = 'avnishy44';
$db = 'accounts';
/*
$host = 'localhost';
$user = 'id5119464_admin1';
$pass = 'avnishy44';
$db = 'id5119464_accounts';
*/
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);