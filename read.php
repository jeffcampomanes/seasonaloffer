<?php 
	require 'database.php';
	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: index.php");
	} else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM customers where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
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
		    			<h3>Offer Details:</h3>
		    		</div>
		    		
	    			<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">offer</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['offer'];?>
						    </label>
					    </div>
					  </div>

					<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">advertiser</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['advertiser'];?>
						    </label>
					    </div>
					  </div>



					<div class="form-horizontal" >
					  <div class="control-group">
					    <label class="control-label">startdate</label>
					    <div class="controls">
						    <label class="checkbox">
						     	<?php echo $data['startdate'];?>
						    </label>
					    </div>
					  </div>



					<div class="form-horizontal" >
						  <div class="control-group">
						    <label class="control-label">enddate</label>
						    <div class="controls">
							    <label class="checkbox">
							     	<?php echo $data['enddate'];?>
							    </label>
						    </div>
						  </div>


						  	<div class="form-horizontal" >
						  <div class="control-group">
						    <label class="control-label">id</label>
						    <div class="controls">
							    <label class="checkbox">
							     	<?php echo $data['id'];?>
							    </label>
						    </div>
						  </div>











					    <div class="form-actions">
						  <a class="btn" href="index.php">Back</a>
					   </div>
					
					 
					</div>
				</div>
				
    </div> <!-- /container -->
  </body>
</html>