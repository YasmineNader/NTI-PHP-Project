<?php
require "../connection/dbconnection.php";
$query="select * from categories";
$sql=mysqli_query($con,$query);

?>




<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  
<?php if(isset($_SESSION["Name"])){?>
    

<div class="container">
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<h3>ALL Category</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Category</th>
      <th scope="col">Image</th>
      <th scope="col">Actions</th>
     
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["name"].'</td>
      <td><img class="imageadmin" src="../uploads/'.$operation["image"].'" ></td>
    
      <td><a href="categoriesdelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a>
      <a href="categoriesupdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
<a href="categories.php" class="btn btn-primary mb-3">Add Category</a>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>
