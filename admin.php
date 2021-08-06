<?php 
session_start();
$_SESSION['username']="tun@gmail.com";
?>
<!DOCTYPE html>
<html>
<header>
    <title>Welcome to VDKSN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</header>
<style>
    body{
        overflow-x: hidden;
    }
    #centered1{
        position: absolute;
        font-size: 10vw;
        top: 30%;
        left: 30%;
        transform: translate(-50%, -50%);
    }

    #centered2{
        position: absolute;
        font-size: 10vw;
        top: 50%;
        left: 40%;
        transform: translate(-50%, -50%);
    }

    #centered3{
        position: absolute;
        font-size: 10vw;
        top: 70%;
        left: 30%;
        transform: translate(-50%, -50%);
    }

    #signup{
        width:60%;
        border-radius: 30px;

    }

    #login{
        width:60%;
        background-color: #fff;
        border: 1px solid #1da1f2;
        color: #1da1f2;
        border-radius: 30px;
    }

    #login:hover{
        width:60%;
        background-color: #fff;
        border: 2px solid #1da1f2;
        color: #1da1f2;
        border-radius: 30px;
    }

    .well{
        background-color: #187fab;
    }
    li {
            color: #f1f1f1;
          display: inline-block;
          width: 150px;
          height: 40px;
          line-height: 40px;
          margin-left: -5px;
  
    }
    ul {
            background: #00688B;
          list-style-type: none;
          overflow: hidden;
          width: 100%;
    }
    a {
  text-decoration: none;
  color: #fff;
  display: block;
}
 a:hover {
  background: #F1F1F1;
  color: #333;
}

</style>
<body>
    <div class = "row">
        <div class = "col-sm-12"> 
            <div class="well">
                <center><h1 style="color: white;">Vietnamese Digital Knowledge Social Network</h1></center>
            </div>
        </div>
    </div>
    <div class = "row">
        <div class = "col-sm-12"> 
        <div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                 <li><a href="home.php" class="navbar-brand">Trang chủ</a></li>
                 <li> <a href="#" class="navbar-brand">Posts <?php  show_posts()?></a></li>
                 <li><a href="admin_category.php" class="navbar-brand">Categories</a></li>
                 <li><a href="home.php" class="navbar-brand">Tags</a></li>
                 <li><a href="home.php" class="navbar-brand">Reports</a></li>
            </ul>
        </div>
    </div>
    </div> 
</body>
</html>
