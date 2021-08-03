<?php

$con = mysqli_connect("localhost","root","","social_network") or die("Connection was not established");

if(isset($_GET['post_id'])){
    $post_id = $_GET['post_id'];

    
    $delete_commentvote="delete from commentvote where post_id='$post_id' ";
    $run_delete_commentvote=mysqli_query($con, $delete_commentvote);
    
    $delete_comment="delete from comments where post_id= '$post_id' ";
    $run_delete_comment=mysqli_query($con, $delete_comment);


    $delete_post = "delete from posts where post_id='$post_id'";

    $run_delete = mysqli_query($con, $delete_post);
    $num=mysqli_affected_rows($con);

    if($num!=0){
        echo "<script>alert('A Post have been deleted!')</script>";
        //echo "<script>window.open('..home/home.php, '_self')</script>";
    }


}

?>