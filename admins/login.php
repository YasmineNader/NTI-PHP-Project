<?php
require "../connection/dbconnection.php";

$errorEmail=$errorPassowrd="";

function clear($field){
  return trim(htmlspecialchars(stripslashes($field)));
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


$email=clear($_POST["email"]);
$password=clear($_POST["password"]);
$errorEmail=validateEmail($email);
$errorPassowrd=validatePassword($password);
$password = md5($_POST["password"]);
if(empty($errorEmail) && empty($errorPassowrd)){
  $query="select * from admins where email= '$email' and password='$password'";
  $sql=mysqli_query($con,$query);
  $count=mysqli_num_rows($sql);
  if($count==1){
    
  echo "<div class='alert alert-success' role='alert'>You are login</div>";
  $data=mysqli_fetch_assoc($sql);
 
  $_SESSION["Name"]=$data["firstName"];
  header("location: adminHome.php");
  }
  else{
    
    echo "<div class='alert alert-danger' role='alert'>You have error in login</div>";
  }



}

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body class="loginbody">
    <h4 class="text-center logintitle">Login Form</h4>
  <div class="container"> 
      
<form method="post" class="loginform"  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    
    <div class="form-floating mb-3  mx-auto">
        <input type="email" class="form-control" id="email" placeholder="email" name="email">
        <label for="email" class="ms-2">E-Mail</label>
        <div class="error"><?php echo $errorEmail;?></div>
      </div>
  
      <div class="form-floating mb-3  mx-auto">
       <input type="password" class="form-control" id="password" placeholder="Password" name="password">
        <label for="password" class="ms-2">Password</label>
        <div class="error"><?php echo $errorPassowrd;?></div>
      </div>
      
    <div class="row">
    <button type="submit" class="btn btn-success mt-3 ">LogIn</button>
    
        
        </div>


</form>

</div> 
</body>
</html>