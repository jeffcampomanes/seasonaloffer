<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$offerError = null;
		$advertiserError = null;
		$startdateError = null;
		$enddateError = null;
	
		
		// keep track post values
		$offer= $_POST['offer'];
		$advertiser= $_POST['advertiser'];
		$startdate= $_POST['startdate'];
		$enddate= $_POST['enddate'];
	
		// validate input
		$valid = true;
		if (empty($offer)) {
			$offerError = 'Please enter offer';
			$valid = false;
		}

		$valid = true;
		if (empty($advertiser)) {
			$advertiserError = 'Please enter advertiser';
			$valid = false;
		}

		$valid = true;
		if (empty($startdate)) {
			$startdateError = 'Please enter start date';
			$valid = false;
		}

		$valid = true;
		if (empty($enddate)) {
			$enddateError = 'Please enter end date';
			$valid = false;
		}
	
	
	
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO customers (offer,advertiser,startdate,enddate) values(?,?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($offer,$advertiser,$startdate,$enddate));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<script>
function validateForm() {
    var x = document.forms["myForm"]["fname"].value;
    if (x == null || x == "") {
        alert("Name must be filled out");
        return false;
    }
}
</script>


<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h3>Create New Offer</h3>
		    		</div>


		    <!-- offer name	 -->	
	    			<form class="form-horizontal" action="create.php" method="post">
					  <div class="control-group <?php echo !empty($offerError)?'error':'';?>">
					    <label class="control-label">Offer Name:</label>	 
					    <div class="controls">
					      	<input name="offer" type="text"  placeholder="offer" value="<?php echo !empty($offer)?$offer:'';?>">
					      	<?php if (!empty($offerError)): ?>
					      		<span class="help-inline"><?php echo $offerError;?></span>
					      	<?php endif; ?>
					    </div>

			<!-- advertiser name -->
					  <div class="control-group <?php echo !empty($advertiserError)?'error':'';?>">
					    <label class="control-label">Advertiser Name:</label>
					    <div class="controls">
					      	<input name="advertiser" type="text"  placeholder="advertiser" value="<?php echo !empty($advertiser)?$offer:'';?>">
					      	<?php if (!empty($advertiserError)): ?>
					      		<span class="help-inline"><?php echo $advertiserError;?></span>   
					      	<?php endif; ?>

					    </div>

			<!-- start date -->
					 <div class="control-group <?php echo !empty($startdateError)?'error':'';?>">
					    <label class="control-label">Start Date:</label>
					    <div class="controls">
					      	<input name="startdate" type="text"  placeholder="startdate" value="<?php echo !empty($startdate)?$offer:'';?>">
					      	<?php if (!empty($startdateError)): ?>
					      		<span class="help-inline"><?php echo $startdateError;?></span>
					      	<?php endif; ?>
					    </div>
			<!-- end date -->

					 <div class="control-group <?php echo !empty($enddateError)?'error':'';?>">
					    <label class="control-label">End Date:</label>
					    <div class="controls">
					      	<input name="enddate" type="text"  placeholder="enddate"  value="<?php echo !empty($enddate)?$offer:'';?>">
					      	<?php if (!empty($enddateError)): ?>
					      		<span class="help-inline"><?php echo $enddateError;?></span>
					      	<?php endif; ?>
					    </div>
					

					
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Create</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>