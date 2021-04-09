<?php
require "../connection/dbconnection.php";
$query="select * from reservation";
$sql=mysqli_query($con,$query);

?>

<?php include "../layout/headeradmin.php";?>

<?php include "../layout/navbaradmin.php";?>
<?php if (isset($_SESSION["deleteMessage"])){echo "<div class='alert alert-danger' role='alert'>". $_SESSION['deleteMessage']."</div>";unset($_SESSION["deleteMessage"]);} ?>
<div class="container">
<?php if(isset($_SESSION["Name"])){?>
<h3>ALL Reservation</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Phone</th>
      <th scope="col">Date</th>
      <th scope="col">Number Of Guests</th>
      <th scope="col">Number Of Tables</th>
      <th scope="col">Time</th>
      <th scope="col">Section</th>
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
      <td>'.$operation["phone"].'</td>
      <td>'.$operation["date"].'</td>
      <td>'.$operation["guests"].'</td>
      <td>'.$operation["tables"].'</td>
      <td>'.$operation["time"].'</td>
      <td>'.$operation["section"].'</td>
      <td><a href="ReservationUpdate.php?id='.$operation["id"].'"class="btn btn-success">Edit</a>
      <a href="ReservationDelete.php?id='.$operation["id"].'"class="btn btn-danger">Delete</a></td>
    </tr>';
   } ?>
  </tbody>

</table>
</div>
</div>
<?php include '../layout/footer.php'?>
<?php } else{header("location: ../admins/login.php");} ?>