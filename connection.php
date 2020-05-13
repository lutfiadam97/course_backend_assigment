<?php

$conn = mysqli_connect('localhost', 'root', '', 'game_database');

if(!$conn){
	die("Connection failed: " .mysqli_connect_error());
} 
?>