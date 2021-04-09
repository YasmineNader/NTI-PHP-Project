<?php
require "../connection/dbconnection.php";
$id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
$op = "select * from categories";
$operation = mysqli_query($con, $op);

$opsub = "select * from subcategory where id=" . $id;
$operationsubquery = mysqli_query($con, $opsub);
if ($operationsubquery) {
    $operationsub = mysqli_fetch_assoc($operationsubquery);
} else {
    echo "no data related to this id";

}

$errorSubcategory = $errorcategory = $errorimage = "";
function clear($field)
{
    return trim(htmlspecialchars(stripslashes($field)));
}

function validateCategory($category)
{

    if (empty($category)) {

        return "Please Enter Category";

    }

}

function validateSubCategory($subcategory)
{

    if (empty($subcategory)) {

        return "Please Enter SubCategory";

    } else {
        $subcategory = filter_var($subcategory, FILTER_SANITIZE_STRING);
        $pattern = "/^[a-zA-Z\s*]+$/";

        if (!preg_match($pattern, $subcategory)) {

            return "Invalid SubCategory";

        }

    }
}

$imagname = "";
function validateImage($image)
{

    if (empty($image)) {

        return "Please Enter Image";

    } else {

        $fileTmpName = $_FILES["image"]["tmp_name"];
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $fileType = $_FILES["image"]["type"];
        $fileExt = explode(".", $fileName);
        $count = count($fileExt);
        $extention = strtolower($fileExt[$count - 1]);
        $ext_allow = array("png", "jpg", "jpeg", "gif");
        global $imagname;
        $imagname = time() . $fileExt[0] . "." . $extention;

        if (in_array($extention, $ext_allow)) {
            $fileUploads = "../uploads/";
            $imgPath = $fileUploads . $imagname;
            move_uploaded_file($fileTmpName, $imgPath);

        }
    }

}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $category = clear($_POST['category']);
    $subcategory = clear($_POST['subcategory']);
    $errorcategory = validateCategory($category);
    $errorSubcategory = validateSubCategory($subcategory);
    $oldimage = $_POST['oldimage'];
    $errorimage = validateImage($_FILES["image"]["name"]);
    $image = $imagname;

    if (empty($errorcategory) && empty($errorSubcategory) && empty($errorimage)) {
        if (file_exists('../uploads/'.$oldimage)) {
            unlink('../uploads/'.$oldimage);
        }
        $sql = "update subcategory set name='$subcategory',categories_id= '$category',image='$image' where id=" . $id;
        
        $query = mysqli_query($con, $sql);

        if ($query) {
           
            echo " <div class='alert alert-success' role='alert'>SubCategory updated</div>";
        } else {
            
            echo "<div class='alert alert-danger' role='alert'>Error in updating SubCategory</div> ";

        }

    }

}

?>



<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<div class="container ">
<?php if(isset($_SESSION["Name"])){?>
<h3>Update SubCategory</h3> 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id=$id" ?>" enctype='multipart/form-data' >

        <input type="hidden" name="id" value="<?php echo $operationsub['id'] ?>">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="subcategory" placeholder="subcategory" name="subcategory" value="<?php echo $operationsub["name"] ?>">
              <label for="subcategory" class="ms-2">SubCategory</label>
              <div class="error"><?php echo $errorSubcategory; ?></div>

            </div>


            <div>
                <label for="category" class="ms-2">Category</label>
                <select name="category" class="form-control">
               <option> Category </option>
                <?php while ($data = mysqli_fetch_assoc($operation)) {?>
               <option value="<?php echo $data['id'];?>" <?php if($operationsub["categories_id"] == $data['id']) {echo "selected";} ?>> <?php echo $data['name']; ?></option>
               <?php }?>
             </select>
      <div class="error"><?php echo $errorcategory; ?></div>

    </div>


    <div class="mb-3">
      <label for="image" class=" form-label ms-2">Image</label>
       <input type="file" class="form-control" name="image" id="image" >


       <div><img class="imageadmin" src="<?php echo ('../uploads/' . $operationsub['image']); ?>"></div>
      
       <input type="hidden" name="oldimage" value="<?php echo $operationsub['image'] ?>">

        <div class="error"><?php echo $errorimage; ?></div>

      </div>



    
    <button type="submit"  class="btn btn-primary mt-3 w-100 " >Update</button>

    <div>
    <a href="subcategorydisplay.php" class="btn btn-dark mt-3 w-100 mb-4">Back</a>
  </div>
  </form>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>