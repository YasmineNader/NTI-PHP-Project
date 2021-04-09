
<?php
require "../connection/dbconnection.php";

$id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
$query="select * from team_information where id=".$id;
$sql=mysqli_query($con,$query);
if($sql){
    $operation=mysqli_fetch_assoc($sql);
}else{
    echo "no data related to this id";

}


$imagname="";

$errorName=$errorimage=$errorJobTitle=$erroJobDescription="";
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
function validateTitle($title){

    if(empty($title)){
      return "Please Enter Job Title";
    }
    
    $title=filter_var($title,FILTER_SANITIZE_STRING);
    if(strlen($title)<10 ||strlen($title)>50)
    return "Please enter Title more than 10 char and less than 50 char";
    
    }

    function validateDescription($description){

        if(empty($description)){
          return "Please Enter Job description";
        }
        
        $description=filter_var($description,FILTER_SANITIZE_STRING);
        if(strlen($description)<10 ||strlen($description)>200)
        return "Please enter Title more than 10 char and less than 200 char";
        
        }



if($_SERVER["REQUEST_METHOD"]=="POST"){

    $name=clear($_POST["name"]);
    $title=clear($_POST["Jobtitle"]);
    $description=clear($_POST["Jobdescription"]);
    $oldimage = $_POST['oldimage'];
    $errorName=validateName($name);
    $errorimage=validateImage($_FILES["image"]["name"]);
    $errorJobTitle=validateTitle($title);
    $erroJobDescription=validateDescription($description);
    $image=$imagname;
 

   if(empty($errorName) && empty($errorimage) && empty($errorJobTitle)&& empty($errorJobDescription)){
    if (file_exists('../uploads/'.$oldimage)) {
      unlink('../uploads/'.$oldimage);
  }
    $sql="update team_information set name='$name',image='$image',job_title='$title',job_description='$description' where id=$id";
    $query=mysqli_query($con,$sql);
    
    if($query){
      
        echo "<div class='alert alert-success' role='alert'>data updated</div>";
    }else{
     
        echo "  <div class='alert alert-danger' role='alert'>Error in updating Data</div>";
    
    }

}


}

?>






<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<?php if(isset($_SESSION["Name"])){?>
<div class="container">
<h3>Update Team Information</h3>
  
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id?>" method="post" enctype='multipart/form-data' >
          <input type="hidden" name="id" value="<?php echo $operation["id"]?>">
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="<?php echo $operation["name"]?>">
              <label for="name" class="ms-2">Name</label>
            <div class="error"><?php echo $errorName;?></div>
            </div>



            <div class="mb-3">
      <label for="image" class=" form-label ms-2">Image</label>
       <input type="file" class="form-control" name="image" id="image" >
       <div><img class="imageadmin" src="<?php echo ('../uploads/' . $operation['image']); ?>"></div>
      
      <input type="hidden" name="oldimage" value="<?php echo $operation['image'] ?>">
        <div class="error"><?php echo $errorimage;?></div>

      </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="Jobtitle" placeholder="Job Title" name="Jobtitle"value="<?php echo $operation["job_title"]?>" >
              <label for="Jobtitle" class="ms-2">Job Title</label>
              <div class="error"><?php echo $errorJobTitle;?></div>


            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="Jobdescription" placeholder="Job Description" name="Jobdescription" value="<?php echo $operation["job_description"]?>">
              <label for="Jobdescription" class="ms-2">Job Description</label>
              <div class="error"><?php echo $erroJobDescription;?></div>


            </div>

            <button type="submit" class="btn btn-success mt-3 w-100">Update</button>
          </form>
        </div>
        </div>

      </div>
    </div>





    </div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>