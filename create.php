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

<?php 
 session_start(); 
//error_reporting(E_ALL); ini_set('display_errors', 1); 
    $error = false;

        if( isset($_POST['btn-login'])){ 

            $name1 = trim($_POST['name1']);
            $name1 = strip_tags($name1);
            $name1 = htmlspecialchars($name1);

            $email = trim($_POST['email']);
            $email = strip_tags($email);
            $email = htmlspecialchars($email);

            $mobile = trim($_POST['mobile']);
            $mobile = strip_tags($mobile);
            $mobile = htmlspecialchars($mobile); 
 
            $title = trim($_POST['title']);
            $title = strip_tags($title);
            $title = htmlspecialchars($title);

            $valuelist = trim($_POST['valuelist']);
            $valuelist = strip_tags($valuelist);
            $valuelist = htmlspecialchars($valuelist);

            $checkbox1 = $_POST['techno'];
        



            $chk="";  
            foreach($checkbox1 as $chk1)  
            {  
                $chk .= $chk1.",";  
            }

            if (empty($name1)) {
                $error = true;
                $nameError = "Please enter your name.";
            } else if (strlen($name1) < 3) {
                $error = true;
                $nameError = "Name must have atleat 3 characters.";
            } else if (!preg_match("/^[a-zA-Z ]+$/",$name1)) {
                $error = true;
                $nameError = "Name must contain alphabets and space.";
            }
        

            if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
                $error = true;
                $emailError = "Please enter valid email address.";
            } else {


                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM customers WHERE email='$email' ";
                $q = $pdo->prepare($sql);
                $q->execute();

                $number_of_rows = $q->fetchColumn(); 
                if($number_of_rows != 0) { 
                    $error = true;
                    $emailError = "Provided Email is already in use.";

    
                }
            }
            if (empty($mobile)){
                $error = true;
                $mobileError = "Please enter mobile.";
            } else if(strlen($mobile) < 10) {
                $error = true;
                $mobileError = "Mobile number must have atleast 10 characters.";
            }


            if (empty($title)){
                $error = true;
                $titleError = "Please enter teamname.";
            } else if (strlen($title) < 3) {
                $error = true;
                $titleError = "teamname must have atleat 3 characters.";
            } else if (!preg_match("/^[a-zA-Z]+$/",$title)) {
                $error = true;
                $titleError = "teamname must contain alphabets.";
            }


            if( !$error ) {

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO customers (name,email,mobile,teamname ,skills,members) values('$name1','$email','$mobile', :title, :valuelist,'$chk')";
                $q = $pdo->prepare($sql);
                $q->bindParam(':title',$title,PDO::PARAM_STR);
                $q->bindParam(':valuelist',$valuelist,PDO::PARAM_INT);
                $q->execute();
             
                if ($q) {
                    header("location:crud.php");
                    Database::disconnect();
                } else {
                    $errTyp = "danger";
                    $errMSG = "Something went wrong, please try again later...";   
                } 
        }


}     
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
    <form method="post" autocomplete="off">    
        <div class="col-md-12">       
            <div class="form-group">
                <h2 class="">Create</h2>
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
                     <input name="name1" id='name' placeholder="enter name" class="form-control" type="text" value="<?php echo $name1 ;?>">
                </div>
                <p id="errormessage1"></p>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>           
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input name="email" id='email' placeholder="E-Mail Address" class="form-control" type="text" value="<?php echo $email ;?>">                   
                </div>
                <p id="errormessage2"></p>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                    <input name="mobile" id="mobile" placeholder="9999999999" class="form-control" type="text" value="<?php echo $mobile ;?>">
                </div>
                <p id="errormessage3"></p>
                <span class="text-danger"><?php echo $mobileError; ?></span>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TEAM NAME</span>
                    <input type="text" name="title" id="title" class="form-control" value="<?php echo $title ;?>"/>                   
                </div>
                <p id="errormessage11"></p>
                <span class="text-danger"><?php echo $titleError; ?></span>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">SELECT SKILLS</span>
                    <select name="valuelist" id="valuelist" class="form-control" value="<?php echo $valuelist ;?>">
                        <option>select your skill</option>
                        <option>php</option>
                        <option>ruby</option>
                        <option>andriod</option>
                        <option>java</option>
                    </select>
                </div>
                <p id="errormessage6"></p>
                <span class="text-danger"><?php echo $valuelistError; ?></span>
            </div>
            <hr/>
             <div class="form-group">
            <div class="input-group">
                <label>Add users:</label>
                    <?php
                        $pdo = Database::connect();
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "SELECT name FROM customers";
                                        
                        foreach ($pdo->query($sql) as $row){
                            echo '<input type="checkbox" id="checkbox" name="techno[]" value="'.$row['name'].'"><span class="user-top">'.$row['name'].'</span>';
                        }
                        Database::disconnect();
                    ?>
            </div>
            </div>
            <hr/>     
            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-success" name="btn-login">Create</button>
                <a class="btn btn-danger" href="crud.php">Back</a>
            </div>
          
        </div>
    </form>
    </div>
</div>

</body>
</html>