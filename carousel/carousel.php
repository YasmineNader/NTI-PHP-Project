<?php
require "../connection/dbconnection.php";


$errorimage="";
$imagname="";
function validateImage($image){

   if(empty($image)){

        return "Please Enter Image";
  
  
      }else{
          
          $fileTmpName=$_FILES["image"]["tmp_name"];
          $fileName=$_FILES["image"]["name"];
          $fileSize=$_FILES["image"]["size"];
          $fileType=$_FILES["image"]["type"];
          $fileExt=explode(".",$fileName);
          $count=count($fileExt);
          $extention=strtolower($fileExt[$count-1]);
          $ext_allow=array("png","jpg","jpeg","gif");
          global $imagname;
          $imagname=time().$fileExt[0].".".$extention;
      
          if(in_array($extention,$ext_allow)){
          $fileUploads="../uploads/";
          $imgPath=$fileUploads.$imagname;
          move_uploaded_file($fileTmpName,$imgPath);
         
          
  
          }
      }

}

if($_SERVER["REQUEST_METHOD"]=="POST"){
   
    $errorimage=validateImage($_FILES["image"]["name"]);
    $image=$imagname;
 

   if(empty($errorimage)){
    $sql="insert into carousel (image) values ('$image')";
    $query=mysqli_query($con,$sql);
    
    if($query){
     
        echo " <div class='alert alert-success' role='alert'>image inserted</div>";
    }else{
      
        echo "<div class='alert alert-danger' role='alert'>Error in inserting image</div> ";
    
    }

}


}

?>




<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>


<div class="container ">
<?php if(isset($_SESSION["Name"])){?>
<h3>Carousel Image</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype='multipart/form-data' >
        

      <div class="mb-3">
      <label for="image" class=" form-label ms-2">Image</label>
       <input type="file" class="form-control" name="image" id="image">
       
        <div class="error"><?php echo $errorimage;?></div>

      </div>
 
    <button type="submit"  class="btn btn-primary mt-3 w-100 " >Add</button>
        
    <div>
    <a href="carouseldisplay.php" class="btn btn-dark mt-3 w-100 mb-4">Back</a>
</div>
</form>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>