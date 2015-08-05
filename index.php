<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">


  	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"> </script>
    <link  href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
    		<div class="row">
    			<div class="col-md-12 text-center">
    				<h3>Seasonal Offer Admin Page</h3>
    		</div>
    		</div>
			
			<div class="row">
				<div class="col-md-12 text-center">
					<p>
						<a href="create.php" class="btn btn-success">Create New Offer</a>
					</p>
				</div>
			</div>


	<div class="row">
				<div class="col-md-12 text-center">

				<table class="table table-striped table-bordered">
		              <thead>
		           <tr>
		                  <th>offer</th>
		                  <th>advertiser</th>
		                  <th>start date</th>
		                  <th>end date</th>
		                  <th>Action</th>
		                </tr>

		              </thead>
		              <tbody>
		              <?php 
	   				   include 'pagination.php';
                       include 'database.php';
					   $pdo = Database::connect();
					   $sql = 'SELECT * FROM customers ORDER BY id DESC';


					   $paginator = new Paginator();
                       $sql = "SELECT count(*) FROM customers ";
                       $paginator->paginate($pdo->query($sql)->fetchColumn());

                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       $sql = "SELECT * FROM customers ORDER BY id DESC limit $start, $length ";



	 				   foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
							   	echo '<td>'. $row['offer'] . '</td>';
							   	echo '<td>'. $row['advertiser'] . '</td>';
							   	echo '<td>'. $row['startdate'] . '</td>';
							   	echo '<td>'. $row['enddate'] . '</td>';
							   	echo '<td width=250>';
							   	echo '<a class="btn btn" href="read.php?id='.$row['id'].'"><i class="fa fa-info"></i></a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-primary" href="update.php?id='.$row['id'].'"><i class="fa fa-pencil"></i></a>';
							   	echo '&nbsp;';
							   	echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'"><i class="fa fa-trash-o"></i>
</a>';
							   	echo '</td>';
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
	            
	            <?php
                echo $paginator->pageNav();
                ?>

    	</div>
    </div>

    </div> <!-- /container -->
  </body>
</html>

