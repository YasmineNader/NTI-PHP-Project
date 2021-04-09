<?php
require "../connection/dbconnection.php";


$errorTitle=$errorContent="";
function clear($field){
  return trim(htmlspecialchars(stripslashes($field)));
}

function validateName($title){

if(empty($title)){
  return "Please Enter Your Title";
}

$title=filter_var($title,FILTER_SANITIZE_STRING);
if(strlen($title)<5 ||strlen($title)>50)
return "Please enter name more than 5 char and less than 50 char";

}

function validateEmail($content){

  if(empty($content)){
    return "Please Enter content";
  }
  
  $title=filter_var($content,FILTER_SANITIZE_STRING);
if(strlen($title)<50){
return "Please enter content more than 50 char";


   

  }

}
    $message="";
    if($_SERVER["REQUEST_METHOD"] == "POST"){

      $title=clear($_POST["title"]);
      $content=clear($_POST["content"]);
     

      $errorTitle=validateName($title);
      $errorContent=validateEmail($content);
      

if(empty($errorTitle) && empty($errorContent)){
  $query="insert into home_body(title, content) values('$title','$content')";
  $sql=mysqli_query($con,$query);
 
  if($sql){
  
   $message = " <div class='alert alert-success' role='alert'>data insert</div>";
    
  }else{
    
      $message =  "<div class='alert alert-danger' role='alert'>Error in inserting Data</div>";
  }

}



    }




?>







<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>

<div class="container">
<?php if(isset($_SESSION["Name"])){?>
<h3>About Information</h3>

  <div><?php echo $message ; ?></div>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="Title" placeholder="Title" name="title">
              <label for="Title" class="ms-2">Title</label>
            <div class="error"><?php echo $errorTitle;?></div>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="content" placeholder="Content" name="content">
              <label for="content" class="ms-2">Content</label>
              <div class="error"><?php echo $errorContent;?></div>


            </div>

      
            <button type="submit" class="btn btn-success mt-3 w-100">Add</button>
          </form>
        </div>
        </div>

      </div>
    </div>




    </div>

<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>
