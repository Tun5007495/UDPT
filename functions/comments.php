<?php
    $get_id = $_GET['post_id'];

    $get_com = "select * from comments where post_id = '$get_id' ORDER by 1 DESC";

    $run_com = mysqli_query($con, $get_com);

    if($_SESSION['user_email']!="guest")
    {
    $user_com = $_SESSION['user_email'];
    $get_vote_cmt = "select * from users where user_email='$user_com'";
    $run_vote_cmt = mysqli_query($con, $get_vote_cmt);
    $row_vote_cmt = mysqli_fetch_array($run_vote_cmt);

    $user_vote_cmt = $row_vote_cmt['user_id'];
    }
    //echo $user_vote_cmt;
    else
    {
        $user_vote_cmt="guest";
    }

            $post=$row['post_id'];

    while($row = mysqli_fetch_array($run_com))
    {
        $com = $row['comment'];
        $com_name = $row['comment_author'];
        $date = $row['date'];
        $point=$row['CommentPoint'];

        //id cua moi comment
        $id=$row['com_id'];

        $qr="select * from commentvote where com_id='$id' and user_vote_cmt= '$user_vote_cmt' ";
        $run=mysqli_query($con, $qr);

        $num=mysqli_num_rows($run);
        //$row=mysqli_fetch_array($run);
        echo"
            <div class='row'>
                <div class='col-md-6 col-md-offset-3'>
                    <div class='panel panel-info'>
                        <div class='panel-body'>
                            <div>
                                <h4><strong>$com_name</strong><i> commented</i> on $date</h4>
                                <p class='text-primary' style='margin-left:5px;font-size:20px;'>$com</p>
                                <h3> <p>$point 👍</p> </h3>

                                    <!-- top-header -->
                                    <div class='agile-main-top'>
                                        <div class='container-fluid'>
                                            <div class='row main-top-w3l py-2'>
                                                <div class='col-lg-4 header-most-top'> 
                                                    ";
                                                    echo "

                                                    <form method='post'>
                                                    <input type='submit' name='commentvote' id='commentvote' value=";
                                                    if($num==1)
                                                    {
                                                        echo "👍";
                                                    }
                                                    else
                                                    {
                                                        echo "👎";
                                                    }
                                                    echo"
                                                     class='btn btn-success'  /> 
                                                    </form>";

                                                    if($num==1)
                                                        echo"You liked this comment";
                                                    else
                                                        echo"Like this comment?"; 
                                                    echo     "   
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";



    }
             if(isset($_POST['commentvote']))
        {
            if($_SESSION['user_email']!="guest")   
            {

                if($num==1)
                { //chay oke
                    $delete_qr="delete from commentvote where com_id='$id' and user_vote_cmt='$user_vote_cmt'";
                    if(mysqli_query($con, $delete_qr))
                    {
                        $update_qr="update comments set CommentPoint=CommentPoint-1 where com_id='$id'";
                        $run=mysqli_query($con, $update_qr);
                        //$result=mysqli_affected_rows($con);
                    }
                }
                else
                {
                    $insert_qr="insert into commentvote (com_id,post_id, user_vote_cmt) values('$id','$get_id','$user_vote_cmt')  ";
                   if(mysqli_query($con, $insert_qr))
                    {
                        $update_qr="update comments set CommentPoint=CommentPoint+1 where com_id='$id' ";
                        $run=mysqli_query($con, $update_qr);
                    //$result=mysqli_affected_rows($con);
                    }

                }
                //echo "<script>alert('OK!')</script>";
            } 
            else
            {
                echo "<script>alert('Please Sign In!')</script>";
                //header("location: signin.php");
            } 
        }

?>