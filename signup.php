
<?php
    //error_reporting(E_ALL); ini_set('display_errors', 1);
    ob_start();
    session_start();
    if( isset($_SESSION['name'])!="" ){
        header("Location: crud.php");
    }
    require 'database.php';

    $error = false;

    if ( isset($_POST['btn-signup']) ) {
        

        $name1 = trim($_POST['name1']);
        $name1 = strip_tags($name1);
        $name1 = htmlspecialchars($name1);
        
        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email);
        
        $pass = trim($_POST['pass']);
        $pass = strip_tags($pass);
        $pass = htmlspecialchars($pass);

        if (empty($name1)) {
            $error = true;
            $nameError = "Please enter your name.";
        } else if (strlen($name1) < 3) {
            $error = true;
            $nameError = "Name must have atleat 3 characters.";
        } else if (!preg_match("/^[a-zA-Z]+$/",$name1)) {
            $error = true;
            $nameError = "Name must contain alphabets and space.";
        }
        

        if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $error = true;
            $emailError = "Please enter valid email address.";
        } else {


                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM users WHERE useremail='$email' ";
                $q = $pdo->prepare($sql);
                $q->execute();
                $number_of_rows = $q->fetchColumn(); 
                if($number_of_rows != 0) { 
                    $error = true;
                    $emailError = "Provided Email is already in use.";
    
                }
        }
    
        if (empty($pass)){
            $error = true;
            $passError = "Please enter password.";
        } else if(strlen($pass) < 6) {
            $error = true;
            $passError = "Password must have atleast 6 characters.";
        }
        

        $password = hash('sha256', $pass);
        

        if( !$error ) {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (username,useremail,password) VALUES ('$name1','$email','$password')";
            $q = $pdo->prepare($sql);
            $q->execute();
             
                if ($q) {
                    $errTyp = "success";
                    $errMSG = "Successfully registered, you may login now";
                    unset($name1);
                    unset($email);
                    unset($pass);
                } else {
                    $errTyp = "danger";
                    $errMSG = "Something went wrong, try again...";   
                } 
        }Database::disconnect();
               
    }
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign up</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="css/custum.css" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

</head>
<body>

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Sign Up.</h2>
            </div>
            
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
            	   <input type="text" name="name1"  class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name1 ;?>"/>
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	   <input type="text" name="email"  class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email; ?>"/>
                </div>
                 <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	    <input type="password" name="pass"  class="form-control" placeholder="Enter Password" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            	<hr />
            
            <div class="form-group">
            	<button type="submit" id="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
            	<a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>


