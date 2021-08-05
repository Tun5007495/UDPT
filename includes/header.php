<?php
include("includes/connection.php");
include("functions/functions.php");
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button"  class="navbar-toggle collapsed" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a href="home.php" class="navbar-brand">Q&A SocialNetwork</a>
        </div>
        <div class="collapse navbar-collapse" id="#bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <?php
                if($_SESSION['user_email']!="guest")
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

                <?php if($_SESSION['user_email']!="guest")
                { ?>
                    <li><a href='profile.php?<?php echo "u_id=$user_id" ?>'><?php echo "$first_name"; ?></a></li>
                    <!-- <li><a href="home.php">Home</a></li> -->
                    <li><a href="members.php">Find People</a></li>
                    <li><a href="messages.php?u_id=new">Messages</a></li> 
   
						
				<?php }
                else 
                { ?>
                    <li><a href="members.php">Find People</a></li>
                    <li><a href='signup.php'>SignUp</a></li>
                    <li><a href='signin.php'>SignIn</a></li>          
               <?php } ?> 
                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span>Categories</span></a>
                            <ul class='dropdown-menu'>
                                <?php 

                                        $qr_category="select * from categories";
                                        $run_category=mysqli_query($con, $qr_category);
                                        while($row=mysqli_fetch_array($run_category))
                                        {
                                            $category_name=$row['category_name']; 
                                            $category_id=$row['category_id'];?>
                                            <li>
                                                <a href="result.php?value=<?php echo $category_name;?> ">
                                                    <form class="navbar-form navbar-left" method="get" action="category_post.php">
                                                    <button type="submit" class="btn btn-info" name="search" value="<?php echo $category_id;?>" ><?php echo $category_name;?></button>
                                                    </form>
                                                </a>
                                                    
                                            </li>
                                            <?php
                                        }
                                ?>
                            </ul>
                        </li>
                         <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'><span>Tags</span></a>
                            <ul class='dropdown-menu'>
                                <?php 

                                        $qr_tag="select * from tags";
                                        $run_tag=mysqli_query($con, $qr_tag);
                                        while($row=mysqli_fetch_array($run_tag))
                                        {
                                            $tag_name=$row['tag_name']; 
                                            $tag_id=$row['tag_id'];?>
                                            <li>
                                                <a href="result.php?value=<?php echo $category_name;?> ">
                                                    <form class="navbar-form navbar-left" method="get" action="tag_post.php">
                                                    <button type="submit" class="btn btn-info" name="search" value="<?php echo $tag_id;?>" ><?php echo $tag_name;?></button>
                                                    </form>
                                                </a>
                                                    
                                            </li>
                                            <?php
                                        }
                                ?>
                            </ul>
                        </li>
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

            </ul>
            <ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<form class="navbar-form navbar-left" method="get" action="results.php">
						<div class="form-group">
							<input type="text" class="form-control" name="user_query" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-info" name="search">Search</button>
					</form>
				</li>
			</ul>
        </div> 
    </div>
</nav>