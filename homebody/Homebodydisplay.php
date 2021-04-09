<?php
require "../connection/dbconnection.php";
$query="select * from home_body";
$sql=mysqli_query($con,$query);


?>


<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<?php if(isset($_SESSION["Name"])){?>
<div class="container">
<h3>All Data</h3>
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Tilte</th>
      <th scope="col">Content</th>
      <th scope="col">Actions</th>

      
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
    
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["title"].'</td>
      <td>'.$operation["content"].'</td>
    
      <td><a href="homebodyDelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a>
      <a href="homebodyupdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a></td>
    </tr>';
   } ?>
  </tbody>
</table>

</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>