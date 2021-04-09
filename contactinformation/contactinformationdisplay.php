<?php
require "../connection/dbconnection.php";
$query="select * from contact_information";
$sql=mysqli_query($con,$query);

?>



<?php include "../layout/headeradmin.php";?>
<?php include "../layout/navbaradmin.php";?>
  
<?php if(isset($_SESSION["Name"])){?>
<div class="container">
<h3>All Information</h3>
<?php if (isset($_SESSION["deleteMessage"])){echo $_SESSION["deleteMessage"];unset($_SESSION["deleteMessage"]);} ?>
<table class="table table-bordered">
 <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th scope="col">Website</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Facebook-URL</th>
      <th scope="col">Youtube-URL</th>
      <th scope="col">Instagram-URL</th>
      <th scope="col">Twitter-URL</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php while($operation=mysqli_fetch_assoc($sql)){
      echo '
    <tr>
      <th>'.$operation["id"].'</th>
      <td>'.$operation["address"].'</td>
      <td>'.$operation["phone"].'</td>
      <td>'.$operation["website"].'</td>
      <td>'.$operation["email"].'</td>
      <td>'.$operation["url_facebook"].'</td>
      <td>'.$operation["url_youtube"].'</td>
      <td>'.$operation["url_instagram"].'</td>
      <td>'.$operation["url_twitter"].'</td>
      <td><a href="contactinformationdelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a>
      <a href="contactinformationupdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a></td>
    </tr>';
   } ?>
  </tbody>
</table>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>