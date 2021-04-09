<?php
require "../connection/dbconnection.php";
$query="select subcategory.id,subcategory.name as subcategory ,subcategory.image,categories.name from subcategory join categories on categories.id=subcategory.categories_id";
$sql=mysqli_query($con,$query);

?>




<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<div class="container">

<?php if(isset($_SESSION["Name"])){?>
<h3>ALL SubCategory</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Category_Name</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
     
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["subcategory"].'</td>
      <td>'.$operation["name"].'</td>
      <td><img class="imageadmin" src="../uploads/'.$operation["image"].'"></td>
      <td><a href="subcategorydelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a>
      <a href="subcategoryupdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
<a href="subcategory.php" class="btn btn-primary mb-3">Add SubCategory</a>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>