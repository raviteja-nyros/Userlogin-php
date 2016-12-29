
<?php
//error_reporting(E_ALL); ini_set('display_errors', 1);
session_start();
$error = false;
require('database.php');
    if (
        isset($_POST['name1']) and isset($_POST['pass'])){
            $name1 = trim($_POST['name1']);
            $name1 = strip_tags($name1);
            $name1 = htmlspecialchars($name1);
        
      
            $pass = trim($_POST['pass']);
            $pass = strip_tags($pass);
            $pass = htmlspecialchars($pass);

            if (empty($name1)) {
                $error = true;
                $nameError = "Please enter your username or email.";
            }
            if (empty($pass)) {
                $error = true;
                $passError = "Please enter your password.";
            }
        $password = hash('sha256', $pass);
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $sql = "select * from  users where ( username='$name1' OR useremail = '$name1') and password='$password'";
        $q = $pdo->prepare($sql);
        $q->execute(); 
        $number_of_rows = $q->fetchColumn();
        
        if ($number_of_rows > 0){
            $_SESSION['name'] = $name1;
             header('Location: crud.php');  
        }
        else{
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again ...";
        }
        Database::disconnect();
    }

?>
<!doctype html>
<html>

<head>
	  <title>User Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/custum.css" >
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
<div class="container">
    <div id="login-form">
    <form method="post" autocomplete="off">    
        <div class="col-md-12">       
            <div class="form-group">
                <h2 class="">Sign In.</h2>
            </div>        
            <hr/>           
            <?php
            if ( isset($errMSG) ) {
                
                ?>
                <div class="form-group">
                    <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
                        <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                    <input type="text" name="name1"  class="form-control" placeholder="Username or Email" value="<?php echo $name1;?>">
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>           
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                    <input type="password" name="pass" class="form-control" placeholder="Password" >
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>           
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            <hr/>
             <div class="form-group">
                <a href="signup.php">Sign Up Here...</a>
            </div>
        </div>
    </form>
    </div>
</div>
</body>
</html>

