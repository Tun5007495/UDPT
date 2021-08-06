<!DOCTYPE html>
<?php
//$con = mysqli_connect("localhost","root","","social_network") ;
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
    header("location: index.php");
}
?>
<html>
  <head>

    <title>RANKING</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css"></link>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      
    </script>
  </head>
  <body>
  
      <div class="col-sm-12">
        <center><h2 style='color:orange'> RANKING USER</h2></center>
        <?php show_users(); ?>
            <hr/>
    </div>

      <div class="col-sm-12">
        <center><h2 style='color:orange'> RANKING USER</h2></center>
        <?php show_posts(); ?>
    </div>
    <center><div id="columnchart_material" style="width: 600px; height: 500px;"></div></center>
  </body>
</html>