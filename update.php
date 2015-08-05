<?php 
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	}
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$offer= null;
		$advertiser= null;
		$startdate= null;
		$enddate= null;
		
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
	
		
		// update data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "UPDATE customers  set offer = ?, advertiser = ?, startdate = ?, enddate = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($offer,$advertiser,$startdate,$enddate,$id));
			Database::disconnect();
			header("Location: index.php");
		}
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM customers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		$offer = $data['offer'];
		$advertiser = $data['advertiser'];
		$startdate = $data['startdate'];
		$enddate = $data['enddate'];
		Database::disconnect();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
    
    			<div class="span10 offset1">
    				<div class="row">
		    			<h2><?php echo !empty($advertiser)?$advertiser:'';?></h2> 
		    			<h4>Current Offer: <?php echo !empty($offer)?$offer:'';?> </h4>
		    			<h5>Run Dates: <?php echo !empty($startdate)?$startdate:'';?> - <?php echo !empty($enddate)?$enddate:'';?></h5>

		    		</div>
    		
	    			<form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
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
					      	<input name="advertiser" type="text"  placeholder="advertiser" value="<?php echo !empty($advertiser)?$advertiser:'';?>">
					      	<?php if (!empty($advertiserError)): ?>
					      		<span class="help-inline"><?php echo $advertiserError;?></span>
					      	<?php endif; ?>
					    </div>

			<!-- start date -->
					 <div class="control-group <?php echo !empty($startdateError)?'error':'';?>">
					    <label class="control-label">Start Date:</label>
					    <div class="controls">
					      	<input name="startdate" type="text"  placeholder="startdate" value="<?php echo !empty($startdate)?$startdate:'';?>">
					      	<?php if (!empty($startdateError)): ?>
					      		<span class="help-inline"><?php echo $startdateError;?></span>
					      	<?php endif; ?>
					    </div>
			<!-- end date -->

					 <div class="control-group <?php echo !empty($enddateError)?'error':'';?>">
					    <label class="control-label">End Date:</label>
					    <div class="controls">
					      	<input name="enddate" type="text"  placeholder="enddate" value="<?php echo !empty($enddate)?$enddate:'';?>">
					      	<?php if (!empty($enddateError)): ?>
					      		<span class="help-inline"><?php echo $enddateError;?></span>
					      	<?php endif; ?>
					    </div>
					

					
					  <div class="form-actions">
						  <button type="submit" class="btn btn-success">Update</button>
						  <a class="btn" href="index.php">Back</a>
						</div>
					</form>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>