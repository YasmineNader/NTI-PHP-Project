<?php

require "../connection/dbconnection.php";
$id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
$query="select * from admins where id=".$id;
$sql=mysqli_query($con,$query);
if($sql){
    $operation=mysqli_fetch_assoc($sql);
}else{
    echo "no data related to this id";

}
$errorPassword="";

function clear($field){
  return trim(htmlspecialchars(htmlentities($field)));
}
function validatePassword($password){

 if(strlen($password)<6){
      return "Invalid Password";
  }
}




if($_SERVER["REQUEST_METHOD"] == "POST"){
$id=$_POST["id"];
$password=clear($_POST["password"]);
$errorPassword=validatePassword($password);
$password=md5($password);


if(empty($errorPassword)){
  
    

    $query="update admins set password='$password' where id=".$id;
      
    
    $sql=mysqli_query($con,$query);
    
    if($sql){
      echo "<div class='alert alert-success' role='alert'>Password Changed</div>";
      
    }else{
      
      echo "<div class='alert alert-danger' role='alert'>Error in Changing Password</div>";
      
    }
    
    }
    
}
?>

<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  <div class="container"> 
  <?php if(isset($_SESSION["Name"])){?>
  <h3 >Change Password </h3>                                                                                           
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$id";?>">
    
<input type="hidden" name="id" value="<?php echo $operation['id'] ?>">
    
      <div class="form-floating mb-3  mx-auto">
       <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        <label for="password" class="ms-2">Password</label>
        <div class="error"><?php echo $errorPassword;?></div>
      </div>

      
      
    <div class="row row-cols-2">
        <div>
    <button type="submit" class="btn btn-success mt-3 w-100">Change</button>
</div>
<div>
        <a href="signupdisplay.php" class="btn btn-dark mt-3 w-100">back</a>
        </div>


</form>

</div> 
</div> 
</div> 
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>