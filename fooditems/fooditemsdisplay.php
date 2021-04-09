<?php
require "../connection/dbconnection.php";
$query="select food_items.id,food_items.name ,food_items.Price ,food_items.details,food_items.image,subcategory.name as subcategory_name from food_items join subcategory on food_items.subCategory_id=subcategory.id";
$sql=mysqli_query($con,$query);

?>






<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<div class="container">
<?php if(isset($_SESSION["Name"])){?>
<h3>ALL Food Items</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">subCategory_Name </th>
      <th scope="col">Images </th>
      <th scope="col">Price </th>
      <th scope="col">Details </th>
      <th scope="col">Actions</th>
     
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["name"].'</td>
      <td>'.$operation["subcategory_name"].'</td>
      <td><img class="imageadmin" src="../uploads/'.$operation["image"].'"></td>
      <td>'.$operation["Price"].'</td>
      <td>'.$operation["details"].'</td>
      <td><a href="fooditemdelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a>
      <a href="fooditemsupdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
<a href="foodItems.php" class="btn btn-primary mb-3">Add Food Items</a>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>