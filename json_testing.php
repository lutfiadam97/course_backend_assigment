<?php

// serializable data

$test = array(0,3,5,1,10);
$testencode = json_encode($test); // array test diubah menjadi string dengan menggunakan fungsi json_encode

echo $testencode."<br>";

$testdecode = json_decode($testencode); // string testencode dibuah menjadi array kembali

echo $testdecode[4]; // menarik hasil arry yang telah didecode dari string $testencode -> tampil angka 10
?>