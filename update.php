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
					     	<div id="pickStartDate">
						      	<input name="startdate" type="text"  placeholder="startdate" onclick="pickStartDate()" value="<?php echo !empty($startdate)?$startdate:'';?>">
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
							      	<input name="enddate" type="text"  placeholder="enddate"  onclick="pickEndDate()"value="<?php echo !empty($enddate)?$enddate:'';?>">
							      	<?php if (!empty($enddateError)): ?>
							      		<span class="help-inline"><?php echo $enddateError;?></span>
							      	<?php endif; ?>
						     	</div>
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