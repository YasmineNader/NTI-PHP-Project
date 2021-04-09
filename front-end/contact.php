<?php
require "../connection/dbconnection.php";


$errorName=$errorEmail=$errorSubject=$errorMessage="";
function clear($field){
  return trim(htmlspecialchars(stripslashes($field)));
}

function validateName($name){

if(empty($name)){
  return "Please Enter Your Name";
}

$name=filter_var($name,FILTER_SANITIZE_STRING);
if(strlen($name)<10 ||strlen($name)>50)
return "Please enter name more than 10 char and less than 50 char";

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

function validateSubject($subject){

  if(empty($subject)){
    return "Please Enter Subject";
  }
  
  $subject=filter_var($subject,FILTER_SANITIZE_STRING);

  
  if(strlen($subject)<3 ||strlen($subject)>20)
  return "Invalid Subject";
  
  }



  function validateMessage($message){

    if(empty($message)){
      return "Please Enter Subject";
    }
    
    $message=filter_var($message,FILTER_SANITIZE_STRING);
  
    
    if(strlen($message)<10 ||strlen($message)>40)
    return "Please Enter Message more than 10 char and less than 40";
    
    }
    $message="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $name=clear($_POST["name"]);
      $email=clear($_POST["email"]);
      $subject=clear($_POST["subject"]);
      $message=clear($_POST["message"]);

      $errorName=validateName($name);
      $errorEmail=validateEmail($email);
      $errorSubject=validateSubject($subject);
      $errorMessage=validateMessage($message);

if(empty($errorName) && empty($errorEmail) && empty($errorSubject) && empty($errorMessage)){
  $query="insert into contact_form (name, email,subject,message) values('$name','$email','$subject','$message')";
  $sql=mysqli_query($con,$query);
 
  if($sql){
    
   $message = "<div class='alert alert-success' role='alert'>Message Sent</div> ";
    
  }else{
    
      $message =  "<div class='alert alert-danger' role='alert'>Error in Sending Message</div> ";
  }
}



    }




?>









<?php include "../layout/header.php"?>
  
    <!-- banner section -->
    <div class="contactbanner mb-5">


    </div>
    <!-- information section -->
    <?php $sql="select * from contact_information";
           $query=mysqli_query($con,$sql);
           $data=mysqli_fetch_assoc($query);


?>
    <div class="container">
      <div class="row">

        <div class="col-6 info">

          <h3 class="fst-italic">Food Information</h3>
          <div>
            <span>Address : </span>
            <span><?php echo $data['address']?> </span>
          </div>
          <div>
            <span>phone : </span>
            <span><?php echo $data['phone']?></span>
          </div>
          <div>
            <span>website : </span>
            <span><?php echo $data['website']?></span>
          </div>
          <div>
            <span>Email : </span>
            <span><?php echo $data['email']?></span>
          </div>
          <div class="">
            <h3 class="fst-italic mb-4">Our social Media</h3>

            <div>
              <a href="<?php echo $data['url_facebook']?>" target="_blank"><img src="../images/facebook.png"
                  alt="facebook icon"></a>
              <a href="<?php echo $data['url_youtube']?>" target="_blank"><img src="../images/youtube.png" alt="Youtube icon"></a>
              <a href="<?php echo $data['url_instagram']?>" target="_blank"><img src="../images/instagram.png"
                  alt="Instagram icon"></a>
              <a href="<?php echo $data['url_twitter']?>" target="_blank"><img src="../images/twitter.png" alt="Twitter icon"></a>
            </div>


          </div>
        </div>
        <!-- form section -->
        <div class="col-6">
        <div><?php echo $message ; ?></div>
          <h3 class="fst-italic mb-4">Contact Us</h3>
         

          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" placeholder="Name" name="name">
              <label for="name" class="ms-2">Name</label>
            <div class="error"><?php echo $errorName;?></div>
            </div>

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
              <label for="email" class="ms-2">E-mail</label>
              <div class="error"><?php echo $errorEmail;?></div>


            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
              <label for="subject" class="ms-2">Subject</label>
              <div class="error"><?php echo $errorSubject;?></div>

            </div>
            <div class="form-floating">
              <textarea class="form-control" placeholder="Message" id="message" style="height: 100px"
                name="message"></textarea>
              <label for="message">Message</label>
              <div class="error"><?php echo $errorMessage;?></div>

            </div>
            <button type="submit" class="btn btn-success mt-3 w-100">Send</button>
          </form>
        </div>


      </div>
    </div>




      <!-- location section -->
      <div class="mt-5 map">
        <h3 class="fst-italic text-center mb-4">Our Location</h3>
        <map>
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d55251.377099651014!2d31.223444799685!3d30.05948381031422!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583fa60b21beeb%3A0x79dfb296e8423bba!2sCairo%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1617141936713!5m2!1sen!2seg"
          width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </map>
      </div>

      
     
  </main>
  <!-- footer section -->
  <?php include '../layout/footer.php'?>

