<?php
require "../connection/dbconnection.php";

$id=filter_var($_GET["id"],FILTER_SANITIZE_NUMBER_INT);
$query="select * from home_body where id=".$id;
$sql=mysqli_query($con,$query);
if($sql){
    $operation=mysqli_fetch_assoc($sql);
}else{
    echo "no data related to this id";

}

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
      $id=$_POST["id"];
      $title=clear($_POST["title"]);
      $content=clear($_POST["content"]);
     

      $errorTitle=validateName($title);
      $errorContent=validateEmail($content);
      

if(empty($errorTitle) && empty($errorContent)){
  $query="update home_body set title='$title', content='$content' where id=".$id;
  $sql=mysqli_query($con,$query);
 
  if($sql){
    
   $message = "<div class='alert alert-success' role='alert'>data Updated</div>";
  
  }else{
      $message =  " <div class='alert alert-danger' role='alert'>Error in updating  Data</div>";
  }

}



    }




?>







<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<?php if(isset($_SESSION["Name"])){?>
<div class="container">
<h3>update Information</h3>

  <div><?php echo $message ; ?></div>
  
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$id?>" method="post">
          <input type="hidden" name="id" value="<?php echo $operation['id']?>">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="Title" placeholder="Title" name="title" value="<?php echo $operation['title']?>">
              <label for="Title" class="ms-2">Title</label>
            <div class="error"><?php echo $errorTitle;?></div>
            </div>

            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="content" placeholder="Content" name="content" value="<?php echo $operation['content']?>">
              <label for="content" class="ms-2">Content</label>
              <div class="error"><?php echo $errorContent;?></div>


            </div>

      
            <button type="submit" class="btn btn-success mt-3 w-100">Send</button>
          </form>
        </div>
        </div>

      </div>
    </div>




    </div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>
