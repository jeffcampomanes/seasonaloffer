<?php 
	
	require 'database.php';

	if ( !empty($_POST)) {
		// keep track validation errors
		$offerError = null;
		$advertiserError = null;
		$startdateError = null;
		$enddateError = null;
		$countryError = null;
		$statusError = null;
	
		
		// keep track post values
		$offer= $_POST['offer'];
		$advertiser= $_POST['advertiser'];
		$startdate= $_POST['startdate'];
		$enddate= $_POST['enddate'];
		$country= $_POST['country'];
		$status= $_POST['status'];
	
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

		$valid = true;
		if (empty($country)) {
			$countryError = 'Please enter country (US, UK, CA, AU)';
			$valid = false;
		}

		$valid = true;
		if (empty($status)) {
			$statusError = 'Please enter status';
			$valid = false;
		}
	
	
	
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO customers (offer,advertiser,startdate,enddate,country,status) values(?,?,?,?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($offer,$advertiser,$startdate,$enddate,$country,$status));
			Database::disconnect();
			header("Location: index.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  	<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
    <link  href="css/bootstrap.min.css" rel="stylesheet">
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


<script>
	function pickStartDate(){
	$('#pickStartDate input').datepicker({
	    autoclose: true
	});

	$('#pickStartDate input').on('show', function(e){
	    console.debug('show', e.date, $(this).data('stickyDate'));
	    
	    if ( e.date ) {
	         $(this).data('stickyDate', e.date);
	    }
	    else {
	         $(this).data('stickyDate', null);
	    }
	});

	$('#pickStartDate input').on('hide', function(e){
	    console.debug('hide', e.date, $(this).data('stickyDate'));
	    var stickyDate = $(this).data('stickyDate');
	    
	    if ( !e.date && stickyDate ) {
	        console.debug('restore stickyDate', stickyDate);
	        $(this).datepicker('setDate', stickyDate);
	        $(this).data('stickyDate', null);
	    	}
		});
	};
</script>


<script>
	function pickEndDate(){
	$('#pickEndDate input').datepicker({
	    autoclose: true
	});

	$('#pickEndDate input').on('show', function(e){
	    console.debug('show', e.date, $(this).data('stickyDate'));
	    
	    if ( e.date ) {
	         $(this).data('stickyDate', e.date);
	    }
	    else {
	         $(this).data('stickyDate', null);
	    }
	});

	$('#pickEndDate input').on('hide', function(e){
	    console.debug('hide', e.date, $(this).data('stickyDate'));
	    var stickyDate = $(this).data('stickyDate');
	    
	    if ( !e.date && stickyDate ) {
	        console.debug('restore stickyDate', stickyDate);
	        $(this).datepicker('setDate', stickyDate);
	        $(this).data('stickyDate', null);
	    	}
		});
	};
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
					     	<div id="pickStartDate">
						      	<input name="startdate" type="date"  placeholder="startdate" value="<?php echo !empty($startdate)?$offer:'';?>">
						      	<?php if (!empty($startdateError)): ?>
						      		<span class="help-inline"><?php echo $startdateError;?></span>
						      	<?php endif; ?>
					      	</div>
						</div>
			<!-- end date -->

					 	<div class="control-group <?php echo !empty($enddateError)?'error':'';?>">
					     <label class="control-label">End Date:</label>
					    	<div class="controls">
					    		<div id="pickEndDate">
							      	<input name="enddate" type="date"  placeholder="enddate"  value="<?php echo !empty($enddate)?$offer:'';?>">
							      	<?php if (!empty($enddateError)): ?>
							      		<span class="help-inline"><?php echo $enddateError;?></span>
							      	<?php endif; ?>
						     	</div>
					   		 </div>

			<!-- country -->

					 	<div class="control-group <?php echo !empty($countryError)?'error':'';?>">
					     <label class="control-label">Country:</label>
					    	<div class="controls">
					    		<div id="pickEndDate">
							      	<input name="country" type="text"  placeholder="country"  value="<?php echo !empty($country)?$offer:'';?>">
							      	<?php if (!empty($countryError)): ?>
							      		<span class="help-inline"><?php echo $countryError;?></span>
							      	<?php endif; ?>
						     	</div>
					   		 </div>
							   		 

			<!-- status -->

					 	<div class="control-group <?php echo !empty($statusError)?'error':'';?>">
					     <label class="control-label">Status:</label>
					    	<div class="controls">
					    		<div id="pickEndDate">
							      	<input name="status" type="text"  placeholder="status"  value="<?php echo !empty($status)?$offer:'';?>">
							      	<?php if (!empty($statusError)): ?>
							      		<span class="help-inline"><?php echo $statusError;?></span>
							      	<?php endif; ?>
						     	</div>
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