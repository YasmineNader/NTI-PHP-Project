
<?php
require "../connection/dbconnection.php";
$id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
$query="select * from contact_information where id=".$id;
$sql=mysqli_query($con,$query);
if($sql){
    $operation=mysqli_fetch_assoc($sql);
}else{
    echo "no data related to this id";

}


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
    $id=$_POST["id"];
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
    $sql="update contact_information set address='$address',phone='$phone',	website='$website',email='$email',url_facebook='$facebook',url_youtube= '$youtube',url_instagram='$instagram',url_twitter='$twitter' where id= " .$id;
    $query=mysqli_query($con,$sql);
    
    if($query){
      
        echo "<div class='alert alert-success' role='alert'>data Updated</div>";
    }else{
     
        echo " <div class='alert alert-danger' role='alert'>Error in Updating Data</div> ";
    
    }

}


}

?>




<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  
  <?php if(isset($_SESSION["Name"])){?>


<div class="container">

  <h3>Update Information</h3>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id?>" method="post" enctype='multipart/form-data' >
          <input type="hidden" name="id" value="<?php echo $operation['id']?>">
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $operation['address']?>">
              <label for="address" class="ms-2">Address</label>
            <div class="error"><?php echo $errorAddress;?></div>
            </div>


            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" value="<?php echo $operation['phone']?>">
              <label for="phone" class="ms-2">Phone</label>
            <div class="error"><?php echo $errorPhone;?></div>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="website" placeholder="Website" name="website" value="<?php echo $operation['website']?>">
              <label for="website" class="ms-2">Website</label>
              <div class="error"><?php echo $errorWebsite;?></div>


            </div>

            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" placeholder="E-Mail" name="email" value="<?php echo $operation['email']?>">
              <label for="email" class="ms-2">E-Mail</label>
              <div class="error"><?php echo $errorEmail;?></div>


            </div>
            
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="facebook" placeholder="Facebook-URL" name="facebookURL" value="<?php echo $operation['url_facebook']?>">
              <label for="facebook" class="ms-2">Facebook-URL</label>
              <div class="error"><?php echo $errorFacebook;?></div>


            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="youtube" placeholder="Youtube-URL" name="youtubeURL" value="<?php echo $operation['url_youtube']?>">
              <label for="youtube" class="ms-2">Youtube-URL</label>
              <div class="error"><?php echo $errorYoutube;?></div>


            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="instagram" placeholder="Instagram-URL" name="instagramURL" value="<?php echo $operation['url_instagram']?>">
              <label for="instagram" class="ms-2">instagram-URL</label>
              <div class="error"><?php echo $errorInstagram;?></div>


            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="twitter" placeholder="Twitter-URL" name="twitterURL" value="<?php echo $operation['url_twitter']?>">
              <label for="twitter" class="ms-2">facebook-URL</label>
              <div class="error"><?php echo $errorTwitter;?></div>


            </div>

            <button type="submit" class="btn btn-success mt-3 w-100 mb-4">Send</button>
          </form>
        </div>
        </div>

      </div>
    </div>




    </div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>