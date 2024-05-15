<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./style/style.css">

<style>
body {
	color: rgb(156,131,33);
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
  
}
	
</style>

</head>
<body>
<?php
include 'dbconn.php';
$id = $_GET['id'];
$update = "SELECT * FROM user WHERE id = $id";
$updatequery = mysqli_query($conn, $update);
$result = mysqli_fetch_assoc($updatequery);


if(isset($_POST['submit'])){
    $id = $_GET['id'];
$name = mysqli_real_escape_string($conn, $_POST['name']);
    $company = mysqli_real_escape_string($conn, $_POST['company']);
	$count = mysqli_real_escape_string($conn, $_POST['count']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $expiration_date = mysqli_real_escape_string($conn, $_POST['expiration_date']);

      $insertquery =  "UPDATE user SET name ='$name', company='$company', count='$count', price ='$price',expiration_date='$expiration_date' WHERE id = $id";
        $mysqliquery = mysqli_query($conn, $insertquery);
    if($insertquery){
        ?>
    <script>
        window.location.replace("index.php");
    </script>

<?php 

    }else{
        echo 'Not Updated';
    }
}
?>
<div style="font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; text-align: center; font-size: 30px; position: relative; top: 150px;">
<a href="#editEmployeeModal" class="edit" data-toggle="modal">Click Here to Update<i class="material-icons" data-toggle="tooltip" title="Update">&#xE254;</i></a>
</div>
<!-- Update Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="">
				<div class="modal-header">						
					<h4 class="modal-title">Update Data</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
					<label>Name</label>
						<input type="text" name="name" class="form-control" value="<?php echo $result['name']; ?>" required>
					</div>
					<div class="form-group">
						<label>Company</label>
						<input type="text" name="company" class="form-control" value="<?php echo $result['company']; ?>" required>
					</div>
					<div class="form-group">
						<label>count</label>
						<input type="number" name="count" class="form-control" value="<?php echo $result['count']; ?>" required>
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="text" name="price" class="form-control" value="<?php echo $result['price']; ?>" required>
					</div>
					<div class="form-group">
						<label>Expiration Date</label>
						<input type="date" name="expiration_date" class="form-control" value="<?php echo $result['expiration_date']; ?>" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

</body>
</html>