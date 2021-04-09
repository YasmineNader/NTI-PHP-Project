<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</head>
<body>
<main>	
	<!-- navigation section -->
<header>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container">
	  <a class="navbar-brand" href="#">Food Resturant</a>
	  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" >
		<span class="navbar-toggler-icon"></span>
	  </button>
	  
	  <div class="collapse navbar-collapse " id="navbarNavDropdown">
		<ul class="navbar-nav ms-auto">
		 <li class="nav-item dropdown">
		 

		 
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle="dropdown" >
			  Log
			</a>
			<?php if(isset($_SESSION["Name"])){?>
			<ul class="dropdown-menu" >
			
			  <li><a class="dropdown-item" href="../admins/logout.php">LogOut</a></li>
			 
			 
			</ul>
		  </li>
		  
		</ul>
		<?php }else{?>
			<ul class="dropdown-menu" >
			
			<li><a class="dropdown-item" href="../admins/login.php">LogIn</a></li>
		   
		   
		  </ul>
		</li>
		
	  </ul>
			<?php } ?>
		<?php if(isset($_SESSION["Name"])){?>
		<div style="color:white"> welcome <?php echo $_SESSION["Name"] ?></div>

			<?php } ?>
	  </div>
	</div>
  </nav>
</header>

