<?php

require "../connection/dbconnection.php";

$errorFirstName=$errorLastName=$errorEmail=$errorPassword="";

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

  if(empty($password)){
    return "Please Enter Password";
  }

 if(strlen($password)<6 || strlen($password)>15){
      return "Invalid Password";
  }
}




if($_SERVER["REQUEST_METHOD"] == "POST"){

$firstName=clear($_POST["firstName"]);
$lastName=clear($_POST["lastName"]);
$email=clear($_POST["email"]);
$password=clear($_POST["password"]);



$errorFirstName=validateFirstName($firstName);
$errorLastName=validateLastName($lastName);
$errorEmail=validateEmail($email);
$errorPassword=validatePassword($password);
$password=md5($password);


if(empty($errorFirstName) && empty($errorSecondName) && empty($errorEmail) && empty($errorPassword)){

$query="insert into admins (firstName, lastName, email, password) values('$firstName','$lastName','$email','$password')";

$sql=mysqli_query($con,$query);

if($sql){
 
  echo "<div class='alert alert-success' role='alert'>data inserted</div>";
  header("location: login.php");
}else{
  
  echo "<div class='alert alert-danger' role='alert'>Error in inserting data</div>";
  header("location:signup.php");

}
}


}


?>





<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  <div class="container"> 
  <?php if(isset($_SESSION["Name"])){?>
  <h3 >Add Admin </h3>                                                                                           
<form method="post"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    
    <div class="form-floating mb-3 ">
        <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstName">
        <label for="firstname" class="ms-2">First Name</label>
      <div class="error"><?php echo $errorFirstName;?></div>
      </div>
  
      <div class="form-floating mb-3  mx-auto">
        <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastName">
        <label for="lastname" class="ms-2">Last Name</label>
        <div class="error"><?php echo $errorLastName;?></div>
      </div>
      
    
      <div class="form-floating mb-3  mx-auto">
        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
        <label for="email" class="ms-2">E-mail</label>
        <div class="error"><?php echo $errorEmail;?></div>
      </div>
    
      <div class="form-floating mb-3  mx-auto">
       <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        <label for="password" class="ms-2">Password</label>
        <div class="error"><?php echo $errorPassword;?></div>
      </div>

      
      
    <div class="row row-cols-2">
        <div>
    <button type="submit" class="btn btn-success mt-3 w-100">SignUp</button>
</div>
<div>
        <a href="login.php" class="btn btn-dark mt-3 w-100">back</a>
        </div>


</form>

</div> 
</div> 
</div> 




<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>

