<?php
session_start();
require_once 'class/Admin.php';
if (isset($_GET['logout']))
{   $adm=new Admin();
    $adm->adminLogout();
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <title>slide</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	 <link   href="css/demo.css" rel="stylesheet">
	 <link   href="css/message.css" rel="stylesheet">
	 <link   href="css/form.css" rel="stylesheet">
     <link   href="css/dashboard.css" rel="stylesheet">

</head>
<body>
<div class="container-fluid" style="overflow:hidden;">
    <div class="row">
         <div class="col-12 col-sm-12 col-md-12 col-lg-12 header">
           <div class="ad-name">
               <h4>Admin:<?php
                   if(isset($_SESSION['adminname'])){
                   echo " ".$_SESSION['adminname'];}
                   ?>
               </h4>
           </div>
           <div class="log-out">
               <a href="?logout=true"">Logout</a>
           </div>
        </div>
    </div>

    <div class="row">
        <div class="menu-bar col-3 col-sm-2 col-md-2 col-lg-2 sticky-top">
            <?php
            $adminCategory=$_SESSION['admincat'];
            if($adminCategory=='Admin-1')
            {
                include 'includes/superAdminMenu.php';
            }
            elseif($adminCategory=='Admin-2')
            {
                include 'includes/onCallAdminMenu.php';
            }
            else
                include 'includes/fixedAdminMenu.php';

            ?>
        </div>

        <div class="col-9 col-sm-10 col-md-10 col-lg-10" style="background:rgba(120,120,120,0.9);border-left:1px solid black;" >
      <?php
       if($page=='dashboard'){
           include 'pages/dashboard_page.php';
       }
       else if($page=='addNewAdmin'){
           include 'pages/add_new_admin_page.php';
       }
       else if($page=='adminList'){
           include 'pages/admin_list_page.php';
       }
       else if($page=='addOrigin'){
           include 'pages/add_origin_page.php';
       }
       else if($page=='originList'){
           include 'pages/origin_list_page.php';
       }
       else if($page=='onCall'){
           include 'pages/on_call_page.php';
       }
       else if($page=='onCallList'){
           include 'pages/on_call_list_page.php';
       }
       else if($page=='fixed'){
           include 'pages/fixed_page.php';
       }
       else if($page=='fixedList'){
           include 'pages/fixed_list_page.php';
       }
       else if($page=='shipped'){
           include 'pages/shipped.php';
       }
       else if($page=='updateAdminInformation'){
           include 'pages/update_admin_information_page.php';
       }
       else if($page=='updateOriginInformation'){
           include 'pages/update_origin_information_page.php';
       }
       else if($page=='updateOnCallInformation'){
           include 'pages/update_oncall_information_page.php';
       }
       else if($page=='updateFixedInformation'){
           include 'pages/update_fixed_information_page.php';
       }
       else if($page=='lcOpen'){
           include 'pages/lc_opening_page.php';
       }
       else if($page=='lcOpeningList'){
           include 'pages/lc_opening_list_page.php';
       }
       else if($page=='updatelcOpeningInformation'){
           include 'pages/update_lc_opening_information_page.php';
       }
       else if($page=='countryWiseSellInformation'){
           include 'pages/country_wise_sell_informatoin_page.php';
       }
       else
           echo "No Page Found";
          ?>
        </div>

    </div>
</div>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>