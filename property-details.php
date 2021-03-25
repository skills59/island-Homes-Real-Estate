<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$sql="INSERT INTO  tblbooking(userEmail,VehicleId,FromDate,ToDate,message,Status) VALUES(:useremail,:vhid,:fromdate,:todate,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert(' successfull.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}

}

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
	<link rel="stylesheet" href="assets/css/ruff.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="apple-touch-icon" href="assets/images/favicon.ico">
	<link rel="stylesheet" href="assets/css/skillfulstyletwo.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
	<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
	<link  rel="stylesheet" href="assets/css/slick.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
		<style>
			.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			}
			.succWrap{
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
			}
		</style>
</head>
    
<body>
	<section class="section-padding gray-bg">
		<div class="container">
			<div class="row">
				<?php include('includes/header.php');?>
			</div>
		</div>
	</section>

		<section>
  			<div class="container">
			  <div class="container shadow">
  				<div class="row">
					<?php 
						$vhid=intval($_GET['vhid']);
						$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount() > 0)
						{
						foreach($results as $result)
						{  
						$_SESSION['brndid']=$result->bid;  
					?>  

					<section id="listing_img_slider">
						<div><img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" width="900" height="560"></div>
						<div><img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" class="img-responsive" alt="image" width="900" height="560"></div>
						<div><img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" class="img-responsive" alt="image" width="900" height="560"></div>
						<div><img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" class="img-responsive"  alt="image" width="900" height="560"></div>
						
						<?php if($result->Vimage5==""){} else {?>

						<div><img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" class="img-responsive" alt="image" width="900" height="560"></div>
					<?php } ?>
					</section>
				</div></div>
			</div>
		</section>

	<section class="listing-detail">
  		<div class="container">
    		<div class="listing_detail_head row">
      			<div class="col-md-9">
        			<h2><?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?></h2>
      			</div>
      			<div class="col-md-3">
        			<div class="price_info">
          				<p>&#8358;<?php echo htmlentities($result->PricePerDay);?> </p>
        			</div>
      			</div>
    		</div>
    		<div class="row">
      			<div class="col-md-9">
        			<div class="main_features">
          				<ul>
          					<li> <i class="fa fa-calendar" aria-hidden="true"></i>
              					<h5><?php echo htmlentities($result->ModelYear);?></h5>
              					<p>Published Year</p>
            				</li>
            				<li> <i class="fa fa-home" aria-hidden="true"></i>
              					<h5><?php echo htmlentities($result->FuelType);?></h5>
              					<p>Purchase Option</p>
            				</li>
        				</ul>
        			</div>

        			<div class="listing_more_info">
          				<div class="listing_detail_wrap"> 
            				<ul class="nav nav-tabs bg-light" role="tablist">
              					<li role="presentation" >
									  <a href="#vehicle-overview" aria-controls="vehicle-overview" role="tab" data-toggle="tab">Property Overview </a>
								</li>
          
              					<li role="presentation">
									  <a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">View Accessories</a>
								</li>
            				</ul>
            
            				<div class="tab-content"> 
              					<div role="tabpanel" class="tab-pane active" id="vehicle-overview">
                					<p><?php echo htmlentities($result->VehiclesOverview);?></p>
              					</div>
              
              					<div role="tabpanel" class="tab-pane" id="accessories"> 
                					<table>
											<thead>
												<tr>
													<th colspan="2">Accessories</th>
												</tr>
											</thead>
                  						<tbody>
											<tr>
												<td>Car Parking Space</td>
													<?php if($result->AirConditioner==1){?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
													<?php } else { ?> 
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
													<?php } ?> 
											</tr>
											<tr>
												<td>Swimming Pool</td>
													<?php if($result->AntiLockBrakingSystem==1){?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
													<?php } else {?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
													<?php } ?>
											</tr>
											<tr>
												<td>Balcony</td>
													<?php if($result->PowerSteering==1){?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
													<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
													<?php } ?>
											</tr>
											<tr>
												<td>Dog House</td>
													<?php if($result->PowerWindows==1){?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
													<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
													<?php } ?>
											</tr>
											<tr>
												<td>Clean Water system</td>
													<?php if($result->CDPlayer==1){?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
													<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
													<?php } ?>
											</tr>

											<tr>
												<td>Furnitures</td>
													<?php if($result->LeatherSeats==1){?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
													<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
													<?php } ?>
											</tr>

											<tr>
												<td>Solar System</td>
													<?php if($result->CentralLocking==1){?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
													<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
													<?php } ?>
											</tr>
											<tr>
												<td>Garden</td>
												<?php if($result->PowerDoorLocks==1)
												{
												?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
												<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
												<?php } ?>
																	</tr>
																	<tr>
												<td>Laundry</td>
												<?php if($result->BrakeAssist==1)
												{
												?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
												<?php  } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
												<?php } ?>
												</tr>

												<tr>
												<td>Governor's Consent</td>
												<?php if($result->DriverAirbag==1)
												{
												?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
												<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
												<?php } ?>
												</tr>
												
												<tr>
												<td>Security</td>
												<?php if($result->PassengerAirbag==1)
												{
												?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
												<?php } else {?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
												<?php } ?>
												</tr>

												<tr>
												<td>Indoor/Outdoor Bar</td>
												<?php if($result->CrashSensor==1)
												{
												?>
												<td><i class="fa fa-check" aria-hidden="true"></i></td>
												<?php } else { ?>
												<td><i class="fa fa-close" aria-hidden="true"></i></td>
												<?php } ?>
												</tr>
                  						</tbody>
                					</table>
              					</div>
            				</div>
          				</div>
        			</div>
					<?php }} ?>
      			</div>
      
      
				<aside class="col-md-3">
					<div class="sidebar_widget">
						<div class="widget_heading">
							<h5><i class="fa fa-envelope" aria-hidden="true"></i>Enquire Now</h5>
						</div>
						<form action="contact">
							<div class="form-group">
							To know more about the property kindly message us directly here
							</div>
							<div class="form-group">
								<button class="btn" type="submit" name="send" type="submit">Send Message 
									<span class="angle_arrow">	
										<i class="fa fa-angle-right" aria-hidden="true"></i>
									</span>
								</button>
							</div>
						</form>
					</div>
					
					<div class="share_vehicle">
					<p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
					</div>
				</aside>
    		</div>
			<div class="space-20"></div>
			<div class="divider"></div>
    
   
			<div class="similar_cars">
				<h3>Similar Properties</h3>
					<div class="row">
						<?php 
						$bid=$_SESSION['brndid'];
						$sql="SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.PricePerDay,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.SeatingCapacity,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.VehiclesBrand=:bid";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':bid',$bid, PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						if($query->rowCount() > 0)
						{
						foreach($results as $result)
						{ ?>      
						<div class="col-md-3 grid_listing">
							<div class="product-listing-m gray-bg">
								<div class="product-listing-img"> 
									<a href="property-details?vhid=<?php echo htmlentities($result->id);?>">
										<img src="control-panel/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image" /> 
									</a>
								</div>
								<div class="product-listing-content">
									<h5><a href="property-details?vhid=<?php echo htmlentities($result->id);?>">
											<?php echo htmlentities($result->BrandName);?> , <?php echo htmlentities($result->VehiclesTitle);?>
										</a>
									</h5>
									<p class="list-price">&#8358;<?php echo htmlentities($result->PricePerDay);?></p>
				
									<ul class="features_list">
										<li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->SeatingCapacity);?> No Of Units</li>
										<li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->ModelYear);?></li>
										<li><i class="fa fa-home" aria-hidden="true"></i><?php echo htmlentities($result->FuelType);?></li>
									</ul>
								</div>
							</div>
						</div>
						<?php }} ?>     
					</div>
				</div>
			</div>
		</section>
		<script src="assets/js/jquery-3.3.1.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.slicknav.js"></script>
		<script src="assets/js/main.js"></script>
		<script src="assets/js/bootstrap-slider.min.js"></script> 
		<script src="assets/js/interface.js"></script> 
		<script src="assets/js/slick.min.js"></script> 
		<script src="assets/js/owl.carousel.min.js"></script>
	</body>
</html>
