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
    }
?>

<!DOCTYPE html>
<html lang="eng">
   <head>
      <meta charset="UTF-8">
      <title>
         Teams
      </title>
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
      <link rel="stylesheet" href="css/custum.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
      <script type="text/javascript" src="js/custom.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   </head>
 <body>
 <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><b>CRUD</b></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <b><?php echo "hi.." . $name . "";?></b> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href='logout.php' class="btn">Logout</a> </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <div id="login-form">
    <form method="post" action="">    
        <div class="col-md-12">  
          <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TEAM</span>
                    <select class='form-control' name="idea" >
                    <option >select your team</option>
                    <?php
                      $pdo = Database::connect();
                      $sql="SELECT teamname,id FROM customers order by teamname";                      
                      foreach ($pdo->query($sql) as $row){
                          echo "<option  value=".$row['id'].">".$row['teamname']."</option><br/>"; 
                      }
                    ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
            <?php
              if(isset($_POST['submit'])){
  
                  $ide=$_POST['idea']; 
                  $pdo = Database::connect();
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sql = "SELECT * FROM customers WHERE id = $ide";

                  foreach ($pdo->query($sql) as $row) {
                      echo '<div><b>Persons in the team <span class="team-name">' . $row['teamname'] . '</span> are below :</b></div>';
                      echo "<div class='form-control'>" . $row['members'] . "</div>";
                      Database::disconnect();
                  }
              }
            ?></div><hr/>
            <div class="form-group">
                <button type="submit"  class="btn btn-success" name="submit">submit</button>
                <a class="btn btn-danger" href="crud.php">back</a>
            </div>
         </div>
       </form>
     </div>
</div>
</body>
</html>
