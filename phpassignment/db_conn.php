<?php

$sname= "localhost";
$uname= "root";
$password= "";

$db_name= "test_dbd";

$conn = mysqli_connect($name, $uname, $password, $db_name);

if(!$conn) {
    echo"Connection failed!";
}