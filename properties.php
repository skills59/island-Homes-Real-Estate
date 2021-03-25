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

	<link rel="stylesheet" href="assets/css/break.css">

	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="apple-touch-icon" href="assets/images/favicon.ico">
	<link rel="stylesheet" href="assets/css/skillfulstyletwo.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
	

</head>
    
<body>
	<section class="section-padding gray-bg">
		<div class="container">
			<div class="row">
				<?php include('includes/header.php');?>
			</div>
		</div>
	</section>


	<section class="section-padding gray-bg">
		<div class="container">
			<div class="article-list">
				<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand";
					$query = $dbh -> prepare($sql);
					$query->execute();
					$results=$query->fetchAll(PDO::FETCH_OBJ);
					$cnt=1;
						if($query->rowCount() > 0)
					{ foreach($results as $result) {  
				?>  
				<div class="col-sm-6 col-md-4 float-right order-4 item shadow">
					
					
					
					<div class="card_content">
					<a href="property-details?vhid=<?php echo htmlentities($result->id);?>">
						<img class="img-fluid shadow" src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>"/>
					</a>
						<div id="outter">
							<div id="div1">
								<i class="fa fa-home" aria-hidden="true"></i> 
								<?php echo htmlentities($result->FuelType);?>	
							</div>

							<div id="div2"> 
								<i class="fa fa-calendar" aria-hidden="true"></i> 
								<?php echo htmlentities($result->ModelYear);?>
							</div>

							<div id="div3"> 
								<i class="fa fa-user" aria-hidden="true"></i> 
								<?php echo htmlentities($result->SeatingCapacity);?> Units
							</div>

							<div style="clear:both"></div>
						</div>

						<h3 class="name">
							<?php echo htmlentities($result->BrandName);?> , 
							<?php echo htmlentities($result->VehiclesTitle);?>
						</h3>
		
						<div class="description">
							<?php echo substr($result->VehiclesOverview,0,70);?>
						</div>
					</div>
				</div>
				<?php }}?>
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
