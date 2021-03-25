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
	<section class="section-padding gray-bg">
		<div class="container">
			<div class="row">
				<?php include('includes/header.php');?>
			</div>
		</div>
	</section>

<section class="search-console"> 
    <div class="container shadow">
        <div class="banner-info">
			<div id="search_form" class="search_top text-center">
				<div class="search-container">
					<form id="manage-filter"  action="search-result" method="POST">
						<div class="row form-group">
							<div class="col-md-4 banf shadow">
								<select id="country13" class="form-control" name="brand">
									<option>Property Option</option>
										<?php $sql = "SELECT * from  tblbrands ";
                  							$query = $dbh -> prepare($sql);
                  							$query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                  							$cnt=1;
                  							if($query->rowCount() > 0) {
                      						foreach($results as $result) {       
				 						?>  
									<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?></option>
									<?php }} ?>
								</select>
							</div>
							<div class="col-md-4 banf">
								<select id="country13" class="form-control" name="fueltype">
									<option>Purchase Option</option>
				  					<option value="For Sale">For Sale</option>
                  					<option value="For Rent">For Rent</option>
								</select>
							</div>
							<div class="col-md-4 banf">
								<div class="form-control">
									<button a type="submit" class="btn btn-block btn-sm btn-primary"><i class="fa fa-search"></i> Find a Property</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
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
