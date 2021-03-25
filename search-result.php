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
	<link rel="stylesheet" href="assets/css/breath.css">
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


	<section class="listing-page">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-md-push-3">
				  	<div class="result-sorting-wrapper">
						<div class="sorting-count">
							<?php 
								//Query for Listing count
								$brand=$_POST['brand'];
								$fueltype=$_POST['fueltype'];
								$sql = "SELECT id from tblvehicles where tblvehicles.VehiclesBrand=:brand and tblvehicles.FuelType=:fueltype";
								$query = $dbh -> prepare($sql);
								$query -> bindParam(':brand',$brand, PDO::PARAM_STR);
								$query -> bindParam(':fueltype',$fueltype, PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=$query->rowCount();
							?>
							<p><span><?php echo htmlentities($cnt);?> Listings</span></p>
						</div>
					</div>
							<?php 
								$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:brand and tblvehicles.FuelType=:fueltype";
								$query = $dbh -> prepare($sql);
								$query -> bindParam(':brand',$brand, PDO::PARAM_STR);
								$query -> bindParam(':fueltype',$fueltype, PDO::PARAM_STR);
								$query->execute();
								$results=$query->fetchAll(PDO::FETCH_OBJ);
								$cnt=1;
								if($query->rowCount() > 0)
								{
								foreach($results as $result)
								{  
							?>


							<div class="product-listing-m bg-default">
								
								<div class="product-listing-img">
									<img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="Image" /> </a> 
								</div>

								<div class="product-listing-content">
									<h5>
										<a <?php echo htmlentities($result->id);?>>
											<?php echo htmlentities($result->BrandName);?> , 
											<?php echo htmlentities($result->VehiclesTitle);?>
										</a>
									</h5>
									<br>
									<p class="list-price">&#8358;<?php echo htmlentities($result->PricePerDay);?></p>
									<ul>
										<li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> Units</li>
										<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?> </li>
										<li><i class="fa fa-home" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
									</ul>

									<br>
										See more images of this Property <br><br>
										<a href="property-details?vhid=<?php echo htmlentities($result->id);?>" class="">View Details 
											<span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
										</a>
								</div>

							</div>
							
						<?php }} ?>
				</div>
			

				<aside class="col-md-3 col-md-pull-9">
					<div class="sidebar_widget">
						<div class="widget_heading">
							<h5><i class="fa fa-filter" aria-hidden="true"></i> Find something else </h5>
						</div>
						<div class="sidebar_filter">
							<form action="search">
								<div class="form-group">
									<button a type="submit" class="btn btn-block btn-sm btn-primary"><i class="fa fa-search"></i> Back to search</button>
								</div>
							</form>
						</div>
						<br>

						<hr>

						<div class="sidebar_widget">
							<div class="widget_heading">
								<h5><i class="fa fa-home" aria-hidden="true"></i> Recent Properties</h5>
							</div>
							<br>

							<div class="recent_addedcars">
								<ul>
									<?php $sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand order by id desc limit 4";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{  ?>
									<li class="bg-light">
										<div class="recent_post_img"> 
											<a href="property-details?vhid=<?php echo htmlentities($result->id);?>">
											<img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" alt="image"></a>
										</div>
											<div class="recent_post_title"> 
												<a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>">
													<?php echo htmlentities($result->BrandName);?> , 
													<?php echo htmlentities($result->VehiclesTitle);?>
												</a>
												<p class="widget_price">&#8358;<?php echo htmlentities($result->PricePerDay);?></p>
											</div>
									</li>
									<?php }} ?>
								</ul>
							</div>
						</div>
						
					</div>
				</aside>
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
