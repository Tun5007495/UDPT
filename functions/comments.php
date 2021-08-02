<?php
    $get_id = $_GET['post_id'];

    $get_com = "select * from comments where post_id = '$get_id' ORDER by 1 DESC";

    $run_com = mysqli_query($con, $get_com);

       



    while($row = mysqli_fetch_array($run_com)){
        $com = $row['comment'];
        $com_name = $row['comment_author'];
        $date = $row['date'];
        $point=$row['CommentPoint'];

        //id cua moi comment
        $id=$row['com_id'];

        $qr="select * from commentvote where comment_id='$id' ";
        $run=mysqli_query($con, $qr);
        $num=mysqli_num_rows($run);
        $row=mysqli_fetch_array($run);
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
<!--                                <div class='agile-main-top'>
                                        <div class='container-fluid'>
                                            <div class='row main-top-w3l py-2'>
                                                <div class='col-lg-4 header-most-top'> -->
                                                    ";
/*
                                                    $temp=0;
                                                    if($num_of_vote==1)
                                                    {                                       
                                                        $temp=1;
                                                    }

                                                    echo "

                                                    <form method='post'>
                                                    <input type='submit' name='vote' id='vote' value=";
                                                    if($temp==1)
                                                    {
                                                        echo "👍";
                                                    }
                                                    else
                                                    {
                                                        echo "👎";
                                                    }
                                                    echo"
                                                     class='btn btn-default'  /> 
                                                    </form>";

                                                    if($temp==1)
                                                        echo"You liked this post";
                                                    else
                                                        echo"Like this post?"; */
                                                    echo     "   
                                           <!--       </div>
                                            </div>
                                        </div>
                                    </div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

?>