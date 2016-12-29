<?php
    include('database.php');
    session_start();
   
  		$name = $_SESSION['name'];
 		$pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username FROM `users` WHERE username='$name'";
        $q = $pdo->prepare($sql);
        $q->execute(); 
        $number_of_rows = $q->fetchColumn();

	if(!isset($_SESSION['name'])){
    	header("location:index.php");
    	Database::disconnect();
   	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/custum.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
	<script src="js/jquery.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

	<script>
		function deleletconfig(){
			var del=confirm("Are you sure you want to delete this record?");
				
			if (del==true){
				alert ("record deleted successfully");
			}
			return del;
		}
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
    $('#example').DataTable( {
        "processing": false,
        "serverSide": false,
        "lengthMenu": [5,10,15,20],
    } );
	} );
	</script>
</head>

<body>
<nav class="navbar navbar-default">
	<div class="container-fluid">
    	<div class="navbar-header">
      		<a class="navbar-brand" href="#"><b>CRUD</b></a>
    	</div>
    	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      		<ul class="nav navbar-nav">
      		    <li class="active"><a href="#">Create Users</a></li>
      		</ul>
      		<ul class="nav navbar-nav navbar-right">
        		<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <b><?php echo "hi.." . $name . "";?></b> <span class="caret"></span></a>
          			<ul class="dropdown-menu">
            			<li><a href='logout.php' class="btn">Logout</a>	</li>
          			</ul>
        		</li>
      		</ul>
    	</div>
  	</div>
</nav>
<div class="container">
<label><a href="create.php"><span class="glyphicon glyphicon-plus-sign"></span><span class="create-top">Create Users</span></a></label>
<label><a href="addteam.php"><span class="glyphicon glyphicon-plus-sign"></span><span class="add-top">Teams</span></a></label>
	<table class="table table-striped table-bordered" id="example">
	<thead>
		<tr>
		    <th>Name</th>
		    <th>Email</th>
		    <th>Mobile</th>
		    <th>Teamname</th>
		    <th>Skill</th>
		    <th>Members</th>
		    <th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$pdo = Database::connect();
		$sql = 'SELECT * FROM customers ORDER BY id DESC';
	 	
	 	foreach ($pdo->query($sql) as $row) {
			echo '<tr>';
			echo '<td>'. $row['name'] . '</td>';
			echo '<td>'. $row['email'] . '</td>';
			echo '<td>'. $row['mobile'] . '</td>';
			echo '<td>'. $row['teamname'] . '</td>';
			echo '<td>'. $row['skills'] . '</td>';
			echo '<td>'. $row['members'] . '</td>';
			echo '<td width=160>';
			echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
			echo '&nbsp;';
			echo '<a href="delete.php?id='.$row['id'].'" class="btn btn-danger" onclick="return deleletconfig()">delete</a>';
			echo '</td>';
			echo '</tr>';
		}
		Database::disconnect();
	?>
	</tbody>
	 </table>
</div>
</body>
</html>