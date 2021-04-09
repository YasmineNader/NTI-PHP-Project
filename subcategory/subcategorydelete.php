<?php

require "../connection/dbconnection.php";
$id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
$query="delete from subcategory where id=".$id;
$operation=mysqli_query($con,$query);
$deleteMessage="";
if($operation){
    $deleteMessage= "Recorde Deleted";
}else{
    $deleteMessage= "Error in Deleting Data";
}
$_SESSION["deleteMessage"]=$deleteMessage;
header("location: subcategorydisplay.php");


?>