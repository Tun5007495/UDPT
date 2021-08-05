<!DOCTYPE html>
<?php
session_start();
include("includes/header.php");

if(!isset($_SESSION['user_email'])){
    header("location: index.php");
}
?>
<html>
<head>
    <?php
    if($_SESSION['user_email']!="guest")
    {
        $user = $_SESSION['user_email'];
        $get_user = "select * from users where user_email='$user'";
        $run_user = mysqli_query($con,$get_user);
        $row = mysqli_fetch_array($run_user);

        $user_name = $row['user_name'];
    }
    else
    {
        $user_name="guest";
    }

    ?>
    <title><?php echo "$user_name"; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css"></link>
</head>

<body>
<div class="row">
    <div id="insert_post" class="col-sm-12">
        <center>
        <form action="home.php?id=<?php echo $user_id; ?>" method="post" id="f" enctype="multipart/form-data">
        <textarea class="form-control" id="content" rows="4" name="content" placeholder="What's in your mind?"></textarea><br>
        <label class="btn btn-warning" id="upload_image_button">Select Image
            <input type="file" name="upload_image" size="30"></input>
        </label>
        <label class="btn btn-warning" for="tags" id="tags">Choose a tag for post:  </label>
            <select name="choosetag">
                <?php 

                $qr_tag="select * from tags";
                $run_tag=mysqli_query($con, $qr_tag);
                while($row=mysqli_fetch_array($run_tag))
                {
                    $tag_name=$row['tag_name']; 
                    $tag_id=$row['tag_id'];?>
                    <option value="<?php echo $tag_id;?>"><?php echo $tag_name;?></option>
                    <?php
                }
                ?>
            </select>
        </label>
        <label class="btn btn-warning" for="categories" id="categories">Choose category for post:  </label>
            <select name="choosecategory">
                <?php 

                $qr_category="select * from categories";
                $run_category=mysqli_query($con, $qr_category);
                while($row=mysqli_fetch_array($run_category))
                {
                    $category_name=$row['category_name']; 
                    $category_id=$row['category_id'];?>
                    <option value="<?php echo $category_id;?>"><?php echo $category_name;?></option>
                    <?php
                }
                ?>
            </select>
        </label>
        <br><br>
        <button id="btn-post" class="btn btn-success" name="sub">Post</button>
        </form>
        <?php insertPost(); ?>
        </center>
    </div>
</div>
<!--
<style>
aside {
  width: 50px;
  padding-left: 20px;
  margin-left: 50px;
  float: left;
}
.news
{
   padding-left: 700px;
}
</style>
<br><br>

<div>
    <aside><h1><p>Categories</p></h1></aside>
    <ul><br><br><br><br>
        <?php 
         $qr_category="select * from categories";
                $run_category=mysqli_query($con, $qr_category);
                while($row=mysqli_fetch_array($run_category))
                {
                    $category_name=$row['category_name']; 
                    $category_id=$row['category_id'];?>
                    <h4><li><?php echo $category_name;?></li></h4>
                    <?php
                }
                ?>
    </ul>
</div>

<div>
    <aside><h1><p>Categories</p></h1></aside>
    <ul><br><br><br><br>
        <?php 
         $qr_category="select * from categories";
                $run_category=mysqli_query($con, $qr_category);
                while($row=mysqli_fetch_array($run_category))
                {
                    $category_name=$row['category_name']; 
                    $category_id=$row['category_id'];?>
                    <h4><li><?php echo $category_name;?></li></h4>
                    <?php
                }
                ?>
    </ul>
</div> -->
<div class="row">                
        <center><h2 class="news"><strong >News Feed</strong></h2></center>
        <?php echo get_posts(); ?>
</div>

</body>
</html>