<?php
session_start();
$server="localhost";
$userName="root";
$password="";
$dbName="food_resturant";

$con=mysqli_connect($server,$userName,$password,$dbName);

if(!$con){
    echo "Error In Connection".mysqli_connect_error();
}

?>