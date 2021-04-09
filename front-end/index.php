<?php 
require "../connection/dbconnection.php";

$sql="select * from carousel";
$query=mysqli_query($con,$sql);



?>



<?php include "../layout/header.php"?>
<!-- carousel section -->
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
	<div class="carousel-inner">

<?php $x=0 ; while( $data=mysqli_fetch_assoc($query)){?>
	  <div class="carousel-item <?php if($x==0){echo "active";}?>">
		<img class="carouselimg"src="../uploads/<?php echo $data['image']?>" class="d-block w-100" alt="...">
	  </div>
	  <?php $x++;} ?>
	 

	</div>
	<button class="carousel-control-prev" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
	  <span class="carousel-control-prev-icon" ></span>
	  <span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" data-bs-target="#carouselExampleFade" data-bs-slide="next">
	  <span class="carousel-control-next-icon" ></span>
	  <span class="visually-hidden">Next</span>
	</button>
  </div>
<!-- about us section -->
<?php

$sql1="select * from home_body";
$op=mysqli_query($con,$sql1);


?>
<div class="container">
<?php while($operation=mysqli_fetch_assoc($op)) {?>
<h3 class="text-center mt-4 mb-4 fst-italic"><?php echo $operation["title"] ?></h3>
<p class="about_par"><?php echo $operation["content"] ?></p>
</div>
<?php }?>
<!-- our team section -->
<div class="container mt-5 mb-5">
	<h3 class="text-center mb-5 fst-italic">Our Team</h3>
	<div class="row row-cols-5 justify-content-between">
	<?php

$sql2="select * from team_information";
$op2=mysqli_query($con,$sql2);


?>
<?php while($data2=mysqli_fetch_assoc($op2)){?>
		<div class="card p-0" >
			<img src="../uploads/<?php echo $data2['image']?>" class="card-img-top" alt="team image">
			<div class="card-body">
			  <h5 class="card-text text-center" ><?php echo $data2['name']?></h5>
			  <p class="text-center"><?php echo"jobtitle : ". $data2['job_title']?></p>
			  <p class="text-center"><?php echo "jobdescription : ".$data2['job_description']?></p>
			</div>
		  </div>
		  <?php } ?>
		
		 
	</div>

</div>


<!-- footer section -->
<?php include '../layout/footer.php'?>
</main>
</body>
</html>