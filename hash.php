<?php

$text = "HASH TESTING";
echo $text."<br>";
echo md5($text)."<br>";
$salt = "garam";
echo md5($text.$salt);

?>