<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="theme-color" content="#009578">
		<title>iSland Homes :: Buy, Sell or Rent a Property at a Click!</title>
		<link rel="manifest" href="manifest.json">
		<link rel="stylesheet" href="assets/css/skills.css">
		<link rel="stylesheet" href="assets/css/search.css">
		<link rel="stylesheet" href="assets/css/bootstrap.css">
		<link rel="apple-touch-icon" href="assets/images/favicon.ico">
		<link rel="stylesheet" href="assets/css/skillfulstyletwo.css">
		<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
		<link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
	</head>
		
	<body>
		<?php 
			$pagetype=$_GET['type'];
			$sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':pagetype',$pagetype,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result){
		?>
		<section class="section-padding gray-bg">
			<div class="container">
				<div class="row">
					<?php include('includes/header.php');?>

				</div>
			</div>
		</section>
		<section class="section-padding gray-bg">
			<div class="container">
				<div class="row">
				<div class="midd py-5 shadow">
        <div class="container py-lg-5 py-md-3">
			<div class="row">
				<div class="col-lg-5">
                    <div class="position-relative">
                       <center> <img src="assets/images/logo192.png" alt="" class="radius-image img-fluid shadow"></center>
                    </div>
                </div>
                <div class="col-lg-7 mb-lg-0 mb-md-5 mb-4 align-self">
                    <h3 class="title-left mx-0"><?php   echo htmlentities($result->PageName); ?></h3>
                    <p class="mt-md-4 mt-3"><?php  echo $result->detail; ?></p>
                    <a class="btn btn-style btn-primary mt-sm-5 mt-4 mr-2 shadow" href="contact">Get in touch with us</a>
                </div>
            </div>
        </div>
    </div>

					<?php } }?>
				</div>
			</div>
		</section>

		

		


								

		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.slicknav.js"></script>
		<script src="assets/js/main.js"></script>
		</body>
	</body>
</html>
