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
$errorFirstName=$errorLastName=$errorEmail="";

function clear($field){
  return trim(htmlspecialchars(stripslashes($field)));
}

function validateFirstName($firstName){

if(empty($firstName)){
  return "Please Enter Your First Name";
}

$firstName=filter_var($firstName,FILTER_SANITIZE_STRING);
if(strlen($firstName)<3 ||strlen($firstName)>15)
return "Please enter Valid Name";

}

function validateLastName($lastName){

  if(empty($lastName)){
    return "Please Enter Your Last Name";
  }
  
  $lastName=filter_var($lastName,FILTER_SANITIZE_STRING);
  if(strlen($lastName)<3 ||strlen($lastName)>15)
  return "Please enter Valid Name";
  
  }

function validateEmail($email){

  if(empty($email)){
    return "Please Enter E-Mail";
  }
  
  $email=filter_var($email,FILTER_SANITIZE_EMAIL);
  $email=filter_var($email,FILTER_VALIDATE_EMAIL);
  
   if($email == false){

    return"Invalid E-Mail";

  }

}

function validatePassword($password){

 if(strlen($password)<6){
      return "Invalid Password";
  }
}




if($_SERVER["REQUEST_METHOD"] == "POST"){
$id=$_POST["id"];
$firstName=clear($_POST["firstName"]);
$lastName=clear($_POST["lastName"]);
$email=clear($_POST["email"]);




$errorFirstName=validateFirstName($firstName);
$errorLastName=validateLastName($lastName);
$errorEmail=validateEmail($email);



if(empty($errorFirstName) && empty($errorLastName) && empty($errorEmail)){
  
    

$query="update admins set firstName =' $firstName',lastName ='$lastName',email='$email' where id=".$id;
  

$sql=mysqli_query($con,$query);

if($sql){
  
  echo "<div class='alert alert-success' role='alert'>data Updated</div>";
  
}else{
  
  
  echo "<div class='alert alert-danger' role='alert'>Error in Updating data</div>";
  
}

}


}


?>






<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  
  <?php if(isset($_SESSION["Name"])){?>
    
  <div class="container"> 
  <h3>Admin Update </h3>                                                          
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$id"?>">
    <input type="hidden" name="id" value="<?php echo $operation['id'] ?>">
    <div class="form-floating mb-3  mx-auto">
        <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstName" value="<?php echo  $operation['firstName']?>">
        <label for="firstname" class="ms-2">First Name</label>
      <div class="error"><?php echo $errorFirstName;?></div>
      </div>
  
      <div class="form-floating mb-3  mx-auto">
        <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastName" value="<?php echo  $operation['lastName']?>">
        <label for="lastname" class="ms-2">Last Name</label>
        <div class="error"><?php echo $errorLastName;?></div>
      </div>
      
    
      <div class="form-floating mb-3  mx-auto">
        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo  $operation['email']?>">
        <label for="email" class="ms-2">E-mail</label>
        <div class="error"><?php echo $errorEmail;?></div>
      </div>
    
      

      
      
    <div class="row row-cols-2">
        <div>
    <button type="submit" class="btn btn-success mt-3 w-100">Update</button>
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




