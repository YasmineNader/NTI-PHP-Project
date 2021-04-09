
<?php
require "../connection/dbconnection.php";



$errorAddress=$errorPhone=$errorWebsite=$errorEmail=$errorFacebook=$errorYoutube=$errorInstagram=$errorTwitter="";
function clear($field){
  return trim(htmlspecialchars(stripslashes($field)));
}

function validationAddress($address)
{
    if (empty($address)) {
        return "Please Enter Your Address";
    } else {

        if (strlen($address) < 10 || strlen($address) > 100) {
            return 'Please Enter Your Address more than 10 char and less than 100';
        }

    }

}


function validationPhone($phone)
{

    if (empty($phone)) {
        return "Please Enter Your Phone <br>";
    } else {

        $phone = trim(htmlspecialchars(stripcslashes($phone)));
        $phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);

        if (strlen($phone) != 11 || is_numeric($phone) == false) {
            return "Invalid Phone";
        } 

    }
}


function validationURL($url)
{
    if (empty($url)) {
       return "Please Enter Your URL <br>";
    } else {

        $url = trim(htmlspecialchars(stripcslashes($url)));
        $URL = filter_var($url, FILTER_SANITIZE_URL);
        if (!filter_var($URL, FILTER_VALIDATE_URL)) {
       
            return "Invalid URL";
        }
    }
}




function validationMail($email)
{
    if (empty($email)) {
        return "Please Enter Your E-mail <br>";
    } else {

        $email = trim(htmlspecialchars(stripcslashes($email)));
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            return "Invalid Mail";
        }
    }
}


if($_SERVER["REQUEST_METHOD"]=="POST"){

    $address=clear($_POST["address"]);
    $phone=clear($_POST["phone"]);
    $website=clear($_POST["website"]);
    $email=clear($_POST["email"]);
    $facebook=clear($_POST["facebookURL"]);
    $youtube=clear($_POST["youtubeURL"]);
    $instagram=clear($_POST["instagramURL"]);
    $twitter=clear($_POST["twitterURL"]);
    
    $errorAddress=validationAddress($address);
    $errorPhone=validationPhone($phone);
    $errorWebsite= validationURL($website);
    $errorEmail=validationMail($email);
    $errorFacebook= validationURL($facebook);
    $errorYoutube= validationURL($youtube);
    $errorInstagram= validationURL($instagram);
    $errorTwitter= validationURL($twitter);

   
   if(empty($errorAddress) && empty($errorPhone) && empty($errorWebsite)&& empty($errorEmail) && empty($errorFacebook) && empty($errorYoutube) && empty($errorInstagram) && empty($errorTwitter)){
    $sql="insert into contact_information (address,phone,	website,email,url_facebook,url_youtube,url_instagram,url_twitter) values ('$address','$phone','$website','$email','$facebook','$youtube','$instagram','$twitter')";
    $query=mysqli_query($con,$sql);
    
    if($query){
      
        echo "<div class='alert alert-success' role='alert'>data inserted</div>";
    }else{
      
        echo " <div class='alert alert-danger' role='alert'>Error in inserting Data</div>";
    
    }

}


}

?>






<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  
<?php if(isset($_SESSION["Name"])){?>
<div class="container">

  <h3>Add Contact Information</h3>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype='multipart/form-data' >
          
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="address" placeholder="Address" name="address">
              <label for="address" class="ms-2">Address</label>
            <div class="error"><?php echo $errorAddress;?></div>
            </div>


            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
              <label for="phone" class="ms-2">Phone</label>
            <div class="error"><?php echo $errorPhone;?></div>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="website" placeholder="Website" name="website">
              <label for="website" class="ms-2">Website</label>
              <div class="error"><?php echo $errorWebsite;?></div>


            </div>

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" placeholder="E-Mail" name="email">
              <label for="email" class="ms-2">E-Mail</label>
              <div class="error"><?php echo $errorEmail;?></div>


            </div>
            
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="facebook" placeholder="Facebook-URL" name="facebookURL">
              <label for="facebook" class="ms-2">Facebook-URL</label>
              <div class="error"><?php echo $errorFacebook;?></div>


            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="youtube" placeholder="Youtube-URL" name="youtubeURL">
              <label for="youtube" class="ms-2">Youtube-URL</label>
              <div class="error"><?php echo $errorYoutube;?></div>


            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="instagram" placeholder="Instagram-URL" name="instagramURL">
              <label for="instagram" class="ms-2">instagram-URL</label>
              <div class="error"><?php echo $errorInstagram;?></div>


            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="twitter" placeholder="Twitter-URL" name="twitterURL">
              <label for="twitter" class="ms-2">facebook-URL</label>
              <div class="error"><?php echo $errorTwitter;?></div>


            </div>

            <button type="submit" class="btn btn-success mt-3 w-100 mt-3 mb-4">Add</button>
          </form>
        </div>
        </div>

      </div>
    </div>

    </div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>