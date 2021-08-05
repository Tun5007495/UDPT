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
    <title>Categories</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style2.css"></link>
</head>

<body>
<div class="row">
    <div class="col-sm-12">
        <center><h2>Posts</h2></center>
        <?php result(); ?>
    </div>
</div>
</body>
</html>

<?php
function result(){
    global $con;
    if(isset($_GET['search'])){
        $search_query = $_GET['search'];
    }

    $get_posts = "select * from posts where tag_id= '$search_query'";
    $run_posts = mysqli_query($con, $get_posts);

    while($row_posts = mysqli_fetch_array($run_posts)){
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = $row_posts['post_content'];
        $upload_image = $row_posts['upload_image'];
        $post_date = $row_posts['post_date'];

        $post_point=substr($row_posts['PostPoint'],0,20);

        //Lay so luong comment trong bai post
        $comment="select count(*) as CommentNumber from comments where post_id='$post_id' ";
        $run_comment = mysqli_query($con, $comment);
        $row_comment = mysqli_fetch_array($run_comment);
        $post_comment_point=substr($row_comment['CommentNumber'],0,20);

        $user = "select * from users where user_id = '$user_id' AND posts='yes'";

        $run_user = mysqli_query($con, $user);
        $row_user = mysqli_fetch_array($run_user);

        $user_name = $row_user['user_name'];
        $first_name = $row_user['f_name'];
        $last_name = $row_user['l_name'];
        $user_image = $row_user['user_image'];

        //display posts

        if($content == "No" && strlen($upload_image)>= 1){
            echo"
                <div class='row'>
                    <div class='col-sm-3'>
                    </div>
                    <div id='posts' class='col-sm-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='img_circle' width='100px' height='100px'></p>
                            </div>
                            <div class='col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color #3897f0;' href='user_profile.php?u_id=$user'>$user_name</a></h3>
                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
                                <h2><p>$post_point 👍, $post_comment_point &#9997</p></h2>
                                </div>
                                    <a href = 'single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View more</button></a><br>
                                </div><br>
                            </div>
                        </div><br>  
                    </div>
                    <div class='col-sm-3'>
                    </div>
                </div><br><br>
            ";
        }

        else if(strlen($content) >= 1 && strlen($upload_image) >=1){
            echo"
                <div class='row'>
                    <div class='col-sm-3'>
                    </div>
                    <div id='posts' class='col-sm-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='img_circle' width='100px' height='100px'></p>
                            </div>
                            <div class='col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color #3897f0;' href='user_profile.php?u_id=$user'>$user_name</a></h3>
                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                                <h3><p>$content</p></h3>
                                <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
                                <h2><p>$post_point 👍, $post_comment_point &#9997</p></h2>
                                </div>
                                    <a href = 'single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View more</button></a><br>
                                </div><br>
                            </div>
                        </div><br>  
                    </div>
                    <div class='col-sm-3'>
                    </div>
                </div><br><br>
            ";
        }
        else{
            echo"
                <div class='row'>
                    <div class='col-sm-3'>
                    </div>
                    <div id='posts' class='col-sm-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='img_circle' width='100px' height='100px'></p>
                            </div>
                            <div class='col-sm-6'>
                                <h3><a style='text-decoration:none; cursor:pointer; color #3897f0;' href='user_profile.php?u_id=$user'>$user_name</a></h3>
                                <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                            </div>
                            <div class='col-sm-4'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='col-sm-12'>
                            <h3><p>$content</p></h3>
                            <h2><p>$post_point 👍, $post_comment_point &#9997</p></h2>
                                </div>
                                    <a href = 'single.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>View more</button></a><br>
                                </div><br>
                            </div>
                        </div><br>
                            
                    </div>
                    <div class='col-sm-3'>
                    </div>
                </div><br><br>
            ";
        }

    }
}
?>