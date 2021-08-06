<?php
include("includes/connection.php");
include("functions/functions.php");
include("admin.php");
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                if($_SESSION['user_email']=="tun@gmail.com")
                {
                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email='$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id']; 
                    $user_name = $row['user_name'];
                    $first_name = $row['f_name'];
                    $last_name = $row['l_name'];
                    $describe_user = $row['describe_user'];
                    $Relationship_status = $row['Relationship'];
                    $user_pass = $row['user_pass'];
                    $user_email = $row['user_email'];
                    $user_country = $row['user_country'];
                    $user_gender = $row['user_gender'];
                    $user_birthday = $row['user_birthday'];
                    $user_image = $row['user_image'];
                    $user_cover = $row['user_cover'];
                    $recovery_account = $row['recovery_account'];
                    $register_date = $row['user_reg_date'];

                    $user_posts = "select * from posts where user_id='$user_id'"; 
                    $run_posts = mysqli_query($con,$user_posts); 
                    $posts = mysqli_num_rows($run_posts);
                }

                ?>

                <?php if($_SESSION['user_email']=="tun@gmail.com")
                { ?>
                    <li><a href='profile.php?<?php echo "u_id=$user_id" ?>'><?php echo "$first_name"; ?></a></li>
                    <!-- <li><a href="home.php">Home</a></li> -->
                    <li><a href="members.php">Find People</a></li>
                    <li><a href="messages.php?u_id=new">Messages</a></li>        
               <?php } ?> 

                        <?php if($_SESSION['user_email']!="guest")
                { ?>

                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span><i class='glyphicon glyphicon-chevron-down'></i> See more...</span></a>
                            <ul class='dropdown-menu'>
                                <li>
                                    <a href='my_post.php? <?php echo "u_id=$user_id" ?>'>My Posts <span class='badge badge-secondary'> <?php echo $posts ?> </span></a>
                                </li>
                                <li>
                                    <a href='edit_profile.php?<?php echo "u_id=$user_id" ?>'>Edit Account</a>
                                </li>
                                <li role='separator' class='divider'></li>
                                <li>
                                    <a href='logout.php'>Logout</a>
                                </li>
                            </ul>
                        </li>
                    <?php }?>
                            <?php if($_SESSION['user_email']=="tun@gmail.com")
                            {

                               echo " <li><a href='admin.php'>Admin</a></li>";    
                            }
                            ?>

            </ul>
            
        </div> 
    </div>
</nav>