<?php
require "../connection/dbconnection.php";
$query="select * from contact_form";
$sql=mysqli_query($con,$query);

?>





<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  
<?php if(isset($_SESSION["Name"])){?>
<div class="container">
<h3>All Contact Message</h3>
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["name"].'</td>
      <td>'.$operation["email"].'</td>
      <td>'.$operation["subject"].'</td>
      <td>'.$operation["message"].'</td>
      <td><a href="contactDelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>
