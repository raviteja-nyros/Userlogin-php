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
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/custum.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="js/custom.js"></script>
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
<?php 

    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    
    if ( null==$id ) {
        header("Location: crud.php");
    }
    session_start(); 
//error_reporting(E_ALL); ini_set('display_errors', 1); 
    $error = false;
    
    if ( !empty($_POST)) {

                
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

            $value1 = trim($_POST['valuelist']);
            $value1 = strip_tags($value1);
            $value1 = htmlspecialchars($value1);

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
            $sql = "UPDATE customers  set name = ?, email = ?, mobile =? ,teamname = ? , skills = ? , members = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name1,$email,$mobile,$title,$value1,$chk,$id));
             
                if ($q) {
                    header("location:crud.php");
                    Database::disconnect();
                } else {
                    $errTyp = "danger";
                    $errMSG = "Something went wrong, please try again later...";   
                } 
        }         
     }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customers where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name1 = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $title =$data ['teamname'];
        $value1 =$data ['skills'];
        $chk = $data ['members'];     
        Database::disconnect();
    }
?>

<div class="container">
    <div id="login-form">
    <form method="post" action="update.php?id=<?php echo $id?>" autocomplete="off">    
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
                     <input name="name1" id='name' value="<?php echo !empty($name1)?$name1:'';?>" class="form-control" type="text">
                </div>
                <p id="errormessage1"></p>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>           
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                    <input name="email" id='email' value="<?php echo !empty($email)?$email:'';?>" class="form-control" type="text">
                    
                </div>
                <p id="errormessage2"></p>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                    <input name="mobile" id="mobile" value="<?php echo !empty($mobile)?$mobile:'';?>" class="form-control" type="text">                   
                </div>
                <p id="errormessage3"></p>
                <span class="text-danger"><?php echo $mobileError; ?></span>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">TEAM NAME</span>
                    <input name="title" id="title" value="<?php echo !empty($title) ? $title: '' ;?>" class="form-control" type="text" />                   
                </div>
                <p id="errormessage11"></p>
                <span class="text-danger"><?php echo $titleError; ?></span>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon">SELECT SKILLS</span>
                    <select name="valuelist" id="valuelist"  class="form-control">
                        <option><?php echo !empty($value1) ? $value1: '' ;?></option>
                        <option>php</option>
                        <option>ruby</option>
                        <option>andriod</option>
                        <option>java</option>
                    </select>
                    <p id="errormessage6"></p>
                </div>
            </div>
            <hr/>
             <div class="form-group">
            <div class="input-group">
                <label>Present users: <span class="upadate-users"><?php echo !empty($chk) ? $chk: '' ;?></span></label><br/>
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
                <p id="errormessage10"></p>
            </div>
            </div>
            <hr/>

           <div class="form-group">
                <button type="submit" id="submit" class="btn btn-success" name="btn-login">Update</button>
                <a class="btn btn-danger" href="crud.php">Back</a>
            </div>
          
        </div>
    </form>
    </div>
</div>
</body>
</html>