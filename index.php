<?php
session_start();
if(isset($_SESSION['adminname'])){
    header("location:dashboard.php");
}
require_once'class/Admin.php';
if(isset($_POST['btn'])) {
    $adm = new Admin;
    $message = $adm->Admin_login($_POST);
}
?>

<!DOCTYPE html>
<html>
<head>


	<title>Sell project</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="css/bootstrap.css">
    <link href="css/message.css" rel="stylesheet">
      <link href="css/login.css" rel="stylesheet">
    <style>

        .log-body{
            margin:0;
            padding: 0;
            background:  url("img/pic1.jpg") fixed center ;

            background-size: cover;

        }
        .login-box{
            height:500px;
            width: 400px;
            border: 2px solid black;
            margin: 100px auto;
            background:darkslategray;
            opacity:0.9;
            box-sizing: border-box;
            padding: 70px 30px;
            border-radius:15px;
            animation: loginAnimation 2s;
        }

        .login-box h2{
            text-align:center;
            color:white;
            font-style:italic;
        }
        .login-box h4{color:white;}

        .login-box input{
            width:100%;
            margin-bottom: 20px;

        }
        .login-box input[type="text"],input[type="password"]{
            border: none;
            border:2px solid black;
            border-radius:15px;
            background: transparent;
            outline: none;
            height: 35px;
            color: white;
            font-size: 20px;

        }
        .login-box input[type="submit"]{
            border: none;
            outline: none;
            background:DodgerBlue;
            border-radius:15px;
            border: 2px solid black;
            margin-top:15px;
            color:white;
            font-size:20px;
        }
        .login-box input[type="submit"]:hover{
            transition: 1s;
            background-color:Tomato;
            color:black;
        }

        @keyframes loginAnimation {
            from{
                transform: translateX(100%);
                opacity:0;
            }
            to{
                transform: translateX(0%);
                opacity:1;
            }
        }

    </style>
</head>
<body class="log-body">

<div class="login-box">
     <?php
     if(isset($message))
     {?>
         <div class="message"><?php
             $length=count($message);
             for($i=0;$i<$length;$i++){
                 echo "<h4>".$message[$i]."</h4>";
             }?>
         </div>
     <?php   }

     ?>
<h2>ADMIN<br/>LOGIN HERE</h2>
   <form action="" method="post">
 <h4>Name</h4>
 <input type="text" name="username" placeholder="Enter username">

 <h4>Password</h4>
 <input type="Password" name="password" placeholder="Enter Password">

 <input type="submit" name="btn" value="LOGIN">

   </form>


</div>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>