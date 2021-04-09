<?php
require "../connection/dbconnection.php";
$query="select * from admins";
$sql=mysqli_query($con,$query);

?>






<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>

<div class="container">
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<?php if(isset($_SESSION["Name"])){?>
<h3>ALL Admins</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["firstName"].'</td>
      <td>'.$operation["lastName"].'</td>
      <td>'.$operation["email"].'</td>
    
      
      <td><a href="signupUpdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a>
      <a href="signupdelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a>
      <a href="changepassword.php?id='.$operation["id"].'"class="btn btn-dark">Change Password</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
<a href="signup.php" class="btn btn-primary mb-3">Add Admin</a>
</div>
</div>

<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>
