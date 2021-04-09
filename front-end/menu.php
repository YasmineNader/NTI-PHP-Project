<?php 
require "../connection/dbconnection.php";
$sql="select * from categories ";
$query=mysqli_query($con,$sql);




?>


<?php include "../layout/header.php"?>

<div class="container">
    <h3 class="text-center fst-italic mt-4">Menu</h3>
    <div class="row row-cols-3 g-4 mb-4">
<?php while($data=mysqli_fetch_assoc($query)){?>
    <div class="card p-0" >
            <img style="height:300px"src="../uploads/<?php echo $data['image'];?>" class="card-img-top" alt="category image">
            <div class="card-body">
              <h5 class="card-title text-center fst-italic"><?php echo $data['name'];?></h5>
              <a href="subcategorymenu.php?id=<?php echo $data['id'];?>" class="btn btn-primary d-block">Go</a>
            </div>
          </div>
          <?php }?>
        
    </div>



</div>

<!-- footer section -->
<?php include '../layout/footer.php'?>