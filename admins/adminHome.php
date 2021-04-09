<?php

require "../connection/dbconnection.php";

include "../layout/headeradmin.php";

?>

<div class="">
<?php if(isset($_SESSION["Name"])){?>
<h3>Admin Profile</h3>

<?php include "../layout/navbaradmin.php";?>
<?php } ?>
