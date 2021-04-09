<?php
require "../connection/dbconnection.php";
$query="select * from team_information";
$sql=mysqli_query($con,$query);

?>

<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<?php if(isset($_SESSION["Name"])){?>
<div class="container">
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">image</th>
      <th scope="col">Job tilte</th>
      <th scope="col">Job Description</th>
      <th scope="col">Actions</th>
      
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
      
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["name"].'</td>
      <td><img class="imageadmin" src="../uploads/'.$operation["image"].'"</td>
      <td>'.$operation["job_title"].'</td>
      <td>'.$operation["job_description"].'</td>
      
      <td><a href="teaminformationupdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a>
      <a href="teaminformationdelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
<a href="teamInformation.php" class="btn btn-primary mb-3">Add Team Member</a>
</div>

</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>
