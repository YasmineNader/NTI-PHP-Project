<?php
require "../connection/dbconnection.php";
$query="select * from carousel";
$sql=mysqli_query($con,$query);


?>





<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  
<?php if(isset($_SESSION["Name"])){?>
    
<div class="container">
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<h3>Carousel View</h3>

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">image</th>
      <th scope="col">Actions</th>


      
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
    
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td><img class="imageadmin" src="../uploads/'.$operation["image"].'"></td>
    
      <td><a href="carouselDelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a>
      <a href="carouselupdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
<a href="carousel.php" class="btn btn-primary mb-3">Add Carousel Image</a>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>