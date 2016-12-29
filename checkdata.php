// <?php
//z $q = intval($_GET['q']);

// $con = mysqli_connect('localhost','root','root','crud');
// if (!$con) {
//     die('Could not connect: ' . mysqli_error($con));
// }

// mysqli_select_db($con,"crud");
// $sql="SELECT * FROM customers WHERE id = '".$q."'";
// $result = mysqli_query($con,$sql);

// echo "<table>
// <tr>
// <th>Team Members</th>
// </tr>";
// while($row = mysqli_fetch_array($result)) {
//     echo "<tr>";
//     echo "<td>" . $row['members'] . "</td>";
//     echo "</tr>";
// }
// echo "</table>";
// mysqli_close($con);
// ?>
// <?php
//     include('database.php');
//     session_start();
   
//         $name = $_SESSION['name'];
//         $pdo = Database::connect();
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $sql = "SELECT username FROM `users` WHERE username='$name'";
//         $q = $pdo->prepare($sql);
//         $q->execute(); 
//         $number_of_rows = $q->fetchColumn();

//     if(!isset($_SESSION['name'])){
//         header("location:index.php");
//     }
// ?>
// <!DOCTYPE html>
// <html lang="eng">
//    <head>
//       <meta charset="UTF-8">
//       <title>
//          Teams
//       </title>
//       <meta charset="utf-8">
//       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
//       <link rel="stylesheet" href="css/custum.css">
//       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
//       <script type="text/javascript" src="js/custom.js"></script>
//       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
//    </head>
//  <body>
//  <nav class="navbar navbar-default">
//     <div class="container-fluid">
//         <div class="navbar-header">
//             <a class="navbar-brand" href="#"><b>CRUD</b></a>
//         </div>
//         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
//             <ul class="nav navbar-nav navbar-right">
//                 <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <b><?php echo "hi.." . $name . "";?></b> <span class="caret"></span></a>
//                     <ul class="dropdown-menu">
//                         <li><a href='logout.php' class="btn">Logout</a> </li>
//                     </ul>
//                 </li>
//             </ul>
//         </div>
//     </div>
// </nav>
// <div class="container">
//     <div id="login-form">
//     <form method="post" autocomplete="off">    
//         <div class="col-md-12">  
//           <div class="form-group">
//                 <div class="input-group">
//                     <span class="input-group-addon">TEAM</span>
//                     <select class='form-control' onchange="showUser(this.value)">
//                     <option >select your team</option>
//                     <?php
//                       $pdo = Database::connect();
//                       $sql="SELECT teamname,id FROM customers order by teamname";                      
//                       foreach ($pdo->query($sql) as $row){
//                           echo "<option  value=".$row['id'].">".$row['teamname']."</option><br/>"; 
//                       }
//                     ?>
//                     </select>
//                 </div>
//             </div>
//             <div id="txtHint"><b>Persons in the team will be displayed here.</b></div><hr>
//             <div class="form-group">
//                 <button type="submit" id="submit" class="btn btn-success" name="btn-login">Create</button>
//                 <a class="btn btn-danger" href="crud.php">Back</a>
//             </div>
//          </div>
//        </form>
//      </div>
// </div>
// <script>
// function showUser(str) {
//   if (str=="") {
//     document.getElementById("txtHint").innerHTML="";
//     return;
//   }
//   if (window.XMLHttpRequest) {
//     xmlhttp=new XMLHttpRequest();
//   } else { // code for IE6, IE5
//     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
//   xmlhttp.onreadystatechange=function() {
//     if (this.readyState==4 && this.status==200) {
//       document.getElementById("txtHint").innerHTML=this.responseText;
//     }
//   }
//   xmlhttp.open("GET","checkdata.php?q="+str,true);
//   xmlhttp.send();
// }
// </script>
// </body>
// </html>
