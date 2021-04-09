<?php

require "../connection/dbconnection.php";

$errorName=$errorEmail=$errorPhone=$errorDate=$errorGuests=$errorTables=$errorTime=$errorSection="";

function clear($field){
  return trim(htmlspecialchars(stripslashes($field)));
}

function validateName($name){

if(empty($name)){
  return "Please Enter Your Full Name";
}

$name=filter_var($name,FILTER_SANITIZE_STRING);
if(strlen($name)<20 ||strlen($name)>200)
return "Please enter name more than 20 char and less than 200 char";

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

function validatePhone($phone){

  if(empty($phone)){
    return "Please Enter Phone";
  }
 $phone=filter_var($phone, FILTER_SANITIZE_NUMBER_INT);

 if(strlen($phone)!= 11 || is_numeric($phone)==false){
      return "Invalid Phone";
  }
}
  function validateDate($date){

    if(empty($date)){
      return "Please Enter Date";
    }
   

}


function validateGuests($guests){

  if(empty($guests)){
    return "Please Enter Number of Guests";
  }

  if(is_numeric($guests)==false){
    return "Please Enter valid Number";
  }
 
}

function validateTables($tables){

  if(empty($tables)){
    return "Please Enter Number of Tables";
  }
  if(is_numeric($tables)==false){
    return "Please Enter valid Number";
  }
 
}

function validateTime($time){

  if(empty($time)){
    return "Please Enter Reservation Time";
  }
 
}

function validateSection($section){

  if(empty($section)){
    return "Please Enter Section Area";
  }
 
}


if($_SERVER["REQUEST_METHOD"] == "POST"){

$name=clear($_POST["name"]);
$email=clear($_POST["email"]);
$phone=clear($_POST["phone"]);
$date=$_POST["date"];
$guests=$_POST["guests"];
$tables=$_POST["tables"];
$time=$_POST["time"];
$section=$_POST["section"];

$errorName=validateName($name);
$errorEmail=validateEmail($email);
$errorPhone=validatePhone($phone);
$errorDate=validateDate($_POST["date"]);
$errorGuests=validateGuests($_POST["guests"]);
$errorTables=validateTables($_POST["tables"]);
$errorTime=validateTime($_POST["time"]);
$errorSection= validateSection($_POST["section"]);

if(empty($errorName) && empty($errorEmail) && empty($errorPhone) && empty($errorDate) && empty($errorGuests) && empty($errorTables) && empty($errorTime) && empty($errorSection)){

$query="insert into reservation (name, email, phone, date, guests, tables, time, section) values('$name','$email','$phone','$date','$guests','$tables','$time','$section')";

$sql=mysqli_query($con,$query);

if($sql){
  echo "data inserted";
}else{
  echo "Error in inserting data";

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
    <title>Reservation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</head>
<body class="reservebody">
    <h4 class="text-center reservetitle">Reservation Form</h4>
  <div class="container"> 
      
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" class="row row-cols-2 reserveform" >
    
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="fName" placeholder="Full Name" name="name">
        <label for="fName" class="ms-2">Full Name</label>
        <div class="error"><?php echo $errorName;?></div>
      </div>
  
     
    
      <div class="form-floating mb-3">
       <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
        <label for="email" class="ms-2">E-mail</label>
        <div class="error"><?php echo $errorEmail;?></div>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
        <label for="phone" class="ms-2">Phone</label>
        <div class="error"><?php echo $errorPhone;?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="date" class="form-control" id="date" placeholder="Date" name="date">
        <label for= "date" class="ms-2">Choose Date</label>
        <div class="error"><?php echo $errorDate;?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="guest" placeholder="Number Of Guests" name="guests" min="1">
        <label for="guest" class="ms-2">Number Of Guests</label>
        <div class="error"><?php echo $errorGuests;?></div>
      </div>
      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="table" placeholder="Number Of Tables" name="tables" min="1">
        <label for="table" class="ms-2">Number Of Tables</label>
        <div class="error"><?php echo $errorTables;?></div>
      </div>

      
      <div>
      <select class="form-select" name="time">
        <option value="" selected >Select Time</option>
        <option value="1 PM">1  PM</option>
        <option value="3 PM">3  PM</option>
        <option value="5 PM">5  PM</option>
        <option value="7 PM">7  PM</option>
        <option value="9 PM">9  PM</option>
        <option value="11 PM">11 PM</option>
      </select>
      <div class="error"><?php echo $errorTime;?></div>
    </div>


    <div>
      <select class="form-select" name="section">
        <option value="" selected>Select Section Type</option>
        <option value="Smoking Area">Smoking Area</option>
        <option value="Non Smoking Area">Non Smoking Area</option>
   
      </select>
      <div class="error"><?php echo $errorSection;?></div>
    </div>
    <div>
    <button type="submit"  class="btn btn-primary mt-3 w-100 " >Send</button>
    </div>
        <div>
    <a href="../menu/menu.php" class="btn btn-dark mt-3 w-100">Back</a>
</div>

</form>

</div> 
</body>
</html>