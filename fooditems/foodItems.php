<?php
require "../connection/dbconnection.php";
$op="select * from subcategory";
$operation=mysqli_query($con,$op);


$errorSubcategory = $errorFoodItem = $errorimage=$errorprice=$errordetails="";
function clear($field)
{
    return trim(htmlspecialchars(stripslashes($field)));
}

function validateSubCategory($subcategory)
{

    if (empty($subcategory)) {

        return "Please Enter Category";

    } 
    
}

function validateFoodItems($foodItems)
{

    if (empty($foodItems)) {

        return "Please Enter Food Items";

    } else {
        $foodItems = filter_var($foodItems, FILTER_SANITIZE_STRING);
        $pattern = "/^[a-zA-Z\s*]+$/";

        if (!preg_match($pattern, $foodItems)) {

            return "Invalid Food Items";

        }

    }
}


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

function validateprice($price)
{

    if (empty($price)) {

        return "Please Enter Price";

    } 
    if(strlen($price)<1 ||is_numeric($price)==false){
        return "Invalid Price";
    }
    
}

function validatedetails($details)
{

    if (empty($details)) {

        return "Please Enter Details";

    } 
    if(strlen($details)<10 ||strlen($details)>300 ){
        return "Invalid Details ";
    }
    
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $foodItem = clear($_POST['fooditem']);
    $price=clear($_POST['price']);
    $details=clear($_POST['details']);
    $subcategory = $_POST['subcategory'];
    $errorprice = validateprice($price);
    $errordetails =validatedetails($details);
    $errorFoodItem = validateFoodItems($foodItem);
    $errorSubcategory = validateSubCategory($subcategory);
    $errorimage=validateImage($_FILES["image"]["name"]);
    $image=$imagname;

    if (empty($errorFoodItem) && empty($errorSubcategory)&& empty($errorimage)&& empty($errorprice) && empty($errordetails)){
        $sql = "insert into food_items (name,subCategory_id,image,price,details) values('$foodItem','$subcategory','$image','$price', '$details')";
        $query = mysqli_query($con, $sql);

        if ($query) {
            
            echo "<div class='alert alert-success' role='alert'>Food Item inserted</div>";
        } else {
           
            echo "  <div class='alert alert-danger' role='alert'>Error in inserting Food Item</div> ";

        }

    }

}

?>





<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>


<div class="container">
<?php if(isset($_SESSION["Name"])){?>
<h3>Add Food Items</h3>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype='multipart/form-data' >


<div class="form-floating mb-3">
              <input type="text" class="form-control" id="fooditem" placeholder="fooditem" name="fooditem">
              <label for="fooditem" class="ms-2">Food Item</label>
              <div class="error"><?php echo $errorFoodItem; ?></div>

            </div>
            <div>
            <label for="subcategory" class="ms-2">SubCategory</label>
            <select name="subcategory" class="form-control">
               <option> SubCategory </option>
                <?php while ($data=mysqli_fetch_assoc($operation)) {?>
               <option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option>
               <?php }?>
             </select>
      <div class="error"><?php echo $errorSubcategory; ?></div>
    </div>
    <div class="mb-3">
      <label for="image" class=" form-label ms-2">Image</label>
       <input type="file" class="form-control" name="image" id="image">
       
        <div class="error"><?php echo $errorimage;?></div>

      </div>
      <div class="form-floating mb-3">
              <input type="text" class="form-control" id="price" placeholder="Price" name="price" >
              <label for="price" class="ms-2">Price</label>
              <div class="error"><?php echo $errorprice; ?></div>
            
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="details" placeholder="Details" name="details">
              <label for="details" class="ms-2">Detials</label>
              <div class="error"><?php echo $errordetails; ?></div>
            
            </div>

    <button type="submit"  class="btn btn-primary mt-3 w-100 " >Add</button>

    <div>
    <a href="fooditemsdisplay.php" class="btn btn-dark mt-3 w-100 mb-3">Back</a>
</div>
</form>
</div>
</div>

<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>
