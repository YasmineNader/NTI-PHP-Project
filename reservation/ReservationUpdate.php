<?php

require "../connection/dbconnection.php";
$id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
$query="select * from reservation where id=".$id;
$sql=mysqli_query($con,$query);
if($sql){
    $operation=mysqli_fetch_assoc($sql);
}else{
    echo "no data related to this id";

}

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
  
$id=$_POST["id"];
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

$query="update reservation set name= '$name' ,email='$email',phone='$phone',date='$date',guests='$guests',tables='$tables',time='$time',section='$section' where id=".$id;

$sql=mysqli_query($con,$query);

if($sql){
  
  echo "<div class='alert alert-success' role='alert'>Data Updated</div>";
}else{
  
  echo "<div class='alert alert-danger' role='alert'>Error in Updating Data</div>";

}
}


}


?>




<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
    <h4 class="text-center reservetitle">Reservation Update Form</h4>
  <div class="container"> 
  <?php if(isset($_SESSION["Name"])){?>
      <h3 >update Reservation </h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id?>" class="row row-cols-2 " >
    <input type="hidden" name="id" value="<?php echo $operation["id"];?>">
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="fName" placeholder="Full Name" name="name" value="<?php echo $operation["name"]?>">
        <label for="fName" class="ms-2">Full Name</label>
        <div class="error"><?php echo $errorName;?></div>
      </div>
  
     
    
      <div class="form-floating mb-3">
       <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php echo $operation["email"]?>">
        <label for="email" class="ms-2">E-mail</label>
        <div class="error"><?php echo $errorEmail;?></div>
      </div>
      <div class="form-floating mb-3">
        <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" value="<?php echo $operation["phone"]?>">
        <label for="phone" class="ms-2">Phone</label>
        <div class="error"><?php echo $errorPhone;?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="date" class="form-control" id="date" placeholder="Date" name="date" value="<?php echo $operation["date"]?>">
        <label for= "date" class="ms-2">Choose Date</label>
        <div class="error"><?php echo $errorDate;?></div>
      </div>

      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="guest" placeholder="Number Of Guests" name="guests" min="1" value="<?php echo $operation["guests"]?>">
        <label for="guest" class="ms-2">Number Of Guests</label>
        <div class="error"><?php echo $errorGuests;?></div>
      </div>
      <div class="form-floating mb-3">
        <input type="number" class="form-control" id="table" placeholder="Number Of Tables" name="tables" min="1" value="<?php echo $operation["tables"]?>">
        <label for="table" class="ms-2">Number Of Tables</label>
        <div class="error"><?php echo $errorTables;?></div>
      </div>
      <div>
      <select class="form-select" name="time" value="<?php echo $operation["time"]?>">
        <option value=""  >Select Time</option>
        <option value="1 PM"  <?php if($operation["time"]=="1 PM") echo 'selected'; ?>>1  PM</option>
        <option value="3 PM" <?php if($operation["time"]=="3 PM") echo 'selected'; ?>>3  PM</option>
        <option value="5 PM"<?php if($operation["time"]=="5 PM") echo 'selected'; ?>>5  PM</option>
        <option value="7 PM"<?php if($operation["time"]=="7 PM") echo 'selected'; ?>>7  PM</option>
        <option value="9 PM"<?php if($operation["time"]=="9 PM") echo 'selected'; ?>>9  PM</option>
        <option value="11 PM"<?php if($operation["time"]=="11 PM") echo 'selected'; ?>>11 PM</option>
      </select>
      <div class="error"><?php echo $errorTime;?></div>
    </div>
    <div>
      <select class="form-select" name="section" value="<?php echo $operation["section"]?>">
        <option value="">Select Section Type</option>
        <option value="Smoking Area" <?php if($operation["section"]=="Smoking Area") echo 'selected'; ?>>Smoking Area</option>
        <option value="Non Smoking Area" <?php if($operation["section"]=="Non Smoking Area") echo 'selected'; ?>>Non Smoking Area</option>
   
      </select>
      <div class="error"><?php echo $errorSection;?></div>
    </div>
    <div>
    <button type="submit"  class="btn btn-primary mt-3 w-100 " >Update</button>
    </div>
        <div>
    <a href="reservationDisplay.php" class="btn btn-dark mt-3 w-100 mb-4">Back</a>
</div>

</form>

</div> 
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>