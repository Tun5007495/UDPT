<?php

$con = mysqli_connect("localhost","root","","social_network") ;

//function for inserting post

function insertPost()
{
	if(isset($_POST['sub']))
	{
		global $con;
		global $user_id;

		$content = htmlentities($_POST['content']);
		$upload_image = $_FILES['upload_image']['name'];
		$image_tmp = $_FILES['upload_image']['tmp_name'];
		$random_number = rand(1, 100);
		$tag=$_POST['choosetag'];
		$category=$_POST['choosecategory'];
		if(strlen($content) > 250){
			echo "<script>alert('Please Use 250 or less than 250 words!')</script>";
			echo "<script>window.open('ho/me.php', '_self')</script>";
		}else{
			if(strlen($upload_image) >= 1 && strlen($content) >= 1){
				move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
				$insert = "insert into posts (user_id, post_content, upload_image, post_date, tag_id, category_id) values('$user_id', '$content', '$upload_image.$random_number', NOW(), '$tag', '$category')";

				$run = mysqli_query($con, $insert);

				if($run){
					echo "<script>alert('Your Post updated a moment ago!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";

					$update = "update users set posts='yes' where user_id='$user_id'";
					$run_update = mysqli_query($con, $update);
				}

				exit();
			}else{
				if($upload_image=='' && $content == ''){
					echo "<script>alert('Error Occured while uploading!')</script>";
					echo "<script>window.open('home.php', '_self')</script>";
				}else
				{
					if($content=='')
					{
						move_uploaded_file($image_tmp, "imagepost/$upload_image.$random_number");
						$insert = "insert into posts (user_id,post_content,upload_image,post_date,tag_id, category_id) values ('$user_id','No','$upload_image.$random_number',NOW(),'$tag','$category')";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}

						exit();
					}
					else
					{
						$insert = "insert into posts (user_id,post_content,post_date, tag_id,category_id) values ('$user_id','$content',NOW(), '$tag', '$category')";
						$run = mysqli_query($con, $insert);

						if($run){
							echo "<script>alert('Your Post updated a moment ago!')</script>";
							echo "<script>window.open('home.php', '_self')</script>";

							$update = "update users set posts='yes' where user_id='$user_id'";
							$run_update = mysqli_query($con, $update);
						}
					}
				}
			}
		}
	}

}


function get_posts(){
	global $con;
	$per_page = 4;

	if(isset($_GET['page'])){
		$page = $_GET['page'];
	}
	else{
		$page = 1;
	}
	$start_from= ($page-1) * $per_page;

	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";

	$run_posts = mysqli_query($con, $get_posts);
	
	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = substr($row_posts['post_content'],0,1000);
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$user = "select * from users where user_id= '$user_id' AND posts='yes'";
		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];	
		
		$post="select * from posts where post_id='$post_id' ";
		$run_post = mysqli_query($con, $post);
		$row_post = mysqli_fetch_array($run_post);
		$post_point=substr($row_post['PostPoint'],0,20);

		$comment="select count(*) as CommentNumber from comments where post_id='$post_id' ";
		$run_comment = mysqli_query($con, $comment);
		$row_comment = mysqli_fetch_array($run_comment);
		$post_comment_point=substr($row_comment['CommentNumber'],0,20);


		$user_com = $_SESSION['user_email'];
		$get_com = "select * from users where user_email='$user_com'";
		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);


		//$user_com_id = $row_com['user_id'];
		//$user_com_name =() $row_com['user_name'];
		//$user_com_email=$row_com['user_email'];
		$user_com_id = ($_SESSION['user_email']!="guest")? $row_com['user_id'] : "guest";
		$user_com_name = ($_SESSION['user_email']!="guest")? $row_com['user_name'] : "guest";
		$user_com_email = ($_SESSION['user_email']!="guest")? $row_com['user_email'] : "guest";
		

		$qr="select * from vote where post_id='$post_id' and user_vote='$user_com_id'";
		$run_vote=mysqli_query($con, $qr);
		$num_of_vote=mysqli_num_rows($run_vote);
		$row_vote=mysqli_fetch_array($run_vote);

		//Displaying posts from database

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
								<h3><a style='text-decoration:none; cursor:pointer; color #3897f0;'  href='user_profile.php?u_id=";echo $user_id;
								 echo" '>"; echo $user_name; echo " </a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
															<!-- top-header -->
									<div class='agile-main-top'>
										<div class='container-fluid'>
											<div class='row main-top-w3l py-2'>
												
												";
													$temp=0;
											        if($num_of_vote==1)
											        {										        	
											        	$temp=1;
											        }

											       	

											       	echo"
											       	 
											       	<a href='single.php?post_id=$post_id' style='float:right;' ><button class='btn btn-info' >Comment</button></a><br> 
											       	";

											       	if($temp==1)
											       		echo"You liked this post";
											       	else
											       		echo"Like this post?";
											       	echo"
											    
											</div>
										</div>
									</div>

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
								<h3><a style='text-decoration:none; cursor:pointer; color #3897f0;'  href='user_profile.php?u_id=";echo $user_id;
								 echo" '>"; echo $user_name; echo " </a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
								<h3> <p>$content</p> </h3>
								
								<img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
								<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
								<!-- top-header -->
									<div class='agile-main-top'>
										<div class='container-fluid'>
											<div class='row main-top-w3l py-2'>
												
													
													";
													$temp=0;
											        if($num_of_vote==1)
											        {										        	
											        	$temp=1;
											        }
													
											       	echo"
											       	 
											       	 <a href='single.php?post_id=$post_id' style='float:right;' ><button class='btn btn-info' >Comment</button></a><br>	
											       	";

											       	if($temp==1)
											       		echo"You liked this post";
											       	else
											       		echo"Like this post?";
											       	echo"	

											     
											</div>
										</div>
									</div>
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
								<h3><a style='text-decoration:none; cursor:pointer; color #3897f0;'  href='user_profile.php?u_id=";echo $user_id;
								 echo" '>"; echo $user_name; echo " </a></h3>
								<h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
							</div>
							<div class='col-sm-4'>
							</div>
						</div>
						<div class='row'>
							<div class='col-sm-12'>
							<h3><p>$content</p></h3>
							<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
							<!-- top-header -->
									<div class='agile-main-top'>
										<div class='container-fluid'>
											<div class='row main-top-w3l py-2'>
												

												";
													$temp=0;
											        if($num_of_vote==1)
											        {										        	
											        	$temp=1;
											        }

											       	echo"
											       <a href='single.php?post_id=$post_id' style='float:right;' ><button class='btn btn-info' >Comment</button></a><br>
											       	";

											       	if($temp==1)
											       		echo"You liked this post";
											       	else
											       		echo"Like this post?";
											       	echo"
											    
											</div>
										</div>
									</div>

							</div>
						</div><br>

							
					</div>
					<div class='col-sm-3'>

					</div>
				</div><br><br>
			";
		}
	}

	include("pagination.php");
}

function single_post()
{
	if(isset($_GET['post_id']))
	{
		global $con;

		$get_id = $_GET['post_id'];
		// Lay bai viet co ma post_id
		$get_posts = "select * from posts where post_id = '$get_id'";

		$run_posts = mysqli_query($con, $get_posts);

		$row_posts = mysqli_fetch_array($run_posts);


		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		//

		//$post="select * from posts where post_id='$post_id' ";
		//$run_post = mysqli_query($con, $post);
		//$row_post = mysqli_fetch_array($run_post);
		$post_point=substr($row_posts['PostPoint'],0,20);

		//Lay so luong comment trong bai post
		$comment="select count(*) as CommentNumber from comments where post_id='$post_id' ";
		$run_comment = mysqli_query($con, $comment);
		$row_comment = mysqli_fetch_array($run_comment);
		$post_comment_point=substr($row_comment['CommentNumber'],0,20);



		/*
		$report="select * from report where post_id='$post_id'";
		$run_report=mysqli_query($con, $report);
		$row_report=mysqli_fetch_array($run_report);
		*/
		//user cua bai post
		$user = "select * from users where user_id = '$user_id' AND posts='yes'";

		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);
		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];


		//user dang nhap trong comment
		$user_com = $_SESSION['user_email'];
		$get_com = "select * from users where user_email='$user_com'";
		$run_com = mysqli_query($con, $get_com);
		$row_com = mysqli_fetch_array($run_com);

		//$user_com_id = $row_com['user_id'];
		//$user_com_name = $row_com['user_name'];
		//$user_com_email=$row_com['user_email'];
		$user_com_id = ($_SESSION['user_email']!="guest")? $row_com['user_id'] : "guest";
		$user_com_name = ($_SESSION['user_email']!="guest")? $row_com['user_name'] : "guest";
		$user_com_email = ($_SESSION['user_email']!="guest")? $row_com['user_email'] : "guest";

		//vote:
		$qr="select * from vote where post_id='$post_id' and user_vote='$user_com_id'";
		$run_vote=mysqli_query($con, $qr);
		$num_of_vote=mysqli_num_rows($run_vote);
		$row_vote=mysqli_fetch_array($run_vote);


		if(isset($_GET['post_id'])){
			$post_id = $_GET['post_id'];
		}

		$get_posts = "select * from users where post_id='$post_id'";
		$run_user = mysqli_query($con, $get_posts);

		$post_id = $_GET['post_id'];

		$post = $_GET['post_id'];
		$get_user = "select * from posts where post_id='$post'";
		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);
		
		$p_id = $row['post_id'];

		if($p_id != $post_id)
		{
			echo "<script>alert('ERROR')</script>";
			echo "<script>window.open('home.php' , '_self')</script>";

		}
		else
		{
			if($content == "No" && strlen($upload_image)>= 1)
			{
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
																	<!-- top-header -->
									<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
									<div class='agile-main-top'>
										<div class='container-fluid'>
											<div class='row main-top-w3l py-2'>
												<div class='col-lg-4 header-most-top'>
													<!-- <button class='btn btn-danger' name='like'> ????</button> -->";

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
											       		echo "????";
											       		//echo"You liked this post";

											       	}
											       	else
											       	{
											       		echo "????";
											       		//echo "You unvote";
											       		//echo"Like this post?";

											       	}
											       	echo"
											       	 class='btn btn-success'  />
											       	</form>";

											       	if($temp==1)
											       		echo"You liked this post";
											       	else
											       		echo"Like this post?";
											       echo "

												</div>
												<div class='col-lg-8 header-right mt-lg-0 mt-2'>
													<!-- header lists -->


													<a href='#' data-toggle='modal' data-target='#report' class='btn btn-danger' >
																 Report </a>
													<!-- //header lists -->
												</div>
											</div>
										</div>
									</div>

								</div>
							</div><br>	
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";
			}
			else if(strlen($content) >= 1 && strlen($upload_image) >=1)
			{
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
									<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
								<!-- top-header -->
									<div class='agile-main-top'>
										<div class='container-fluid'>
											<div class='row main-top-w3l py-2'>
												<div class='col-lg-4 header-most-top'>
													<!-- <button class='btn btn-danger' name='like'> ????</button> -->";

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
											       		echo "????";
											       		//echo"You liked this post";

											       	}
											       	else
											       	{
											       		echo "????";
											       		//echo "You unvote";
											       		//echo"Like this post?";

											       	}
											       	echo"
											       	 class='btn btn-success'  />
											       	</form>";

											       	if($temp==1)
											       		echo"You liked this post";
											       	else
											       		echo"Like this post?";
											       echo "

												</div>
												<div class='col-lg-8 header-right mt-lg-0 mt-2'>
													<!-- header lists -->


													<a href='#' data-toggle='modal' data-target='#report' class='btn btn-danger' >
																 Report </a>
													<!-- //header lists -->
												</div>
											</div>
										</div>
									</div>


									<!-- <button class='btn btn-danger' style='background-color:red name='report'> Report</button> -->
								<!-- top-header -->
									<div class='agile-main-top'>
										<div class='container-fluid'>
											<div class='row main-top-w3l py-2'>
												<div class='col-lg-4 header-most-top'>
													
												</div>
												<div class='col-lg-8 header-right mt-lg-0 mt-2'>
													<!-- header lists -->

													<!-- //header lists -->
												</div>
											</div>
										</div>
									</div>
									<!-- modals -->
									<!-- report -->
									<div class='modal fade' id='report' tabindex='-1' role='dialog aria-hidden='true'  >
										<div class='modal-dialog' role='document' style='background: tomato' >
											<div class=modal-content'  >
												<div class='modal-header'>
													<h5 class='modal-title text-center'>Report Post</h5>
													<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
														<span aria-hidden='true'>&times;</span>
													</button>
												</div>
												<div class=modal-body>
													<form action='#' method='post'>
														<div class='form-group'>
															<label class='col-form-label'>Email</label>
															<input type='text' class='form-control' placeholder='' name='email_report' required='' value='$user_com_email'>
														</div>
														<div class='form-group'>
															<label class='col-form-label'>Content Report</label>
															<input type='text' class='form-control' placeholder='' name='content_report' required=''>
														</div>
														<div class='right-w3l' >
															<input type='submit' class='form-control' name='send_admin' value='Send report' style='background: Turquoise; color:black;border:solid;margin:auto; box-sizing:content-box; width: 100px; height: 20px;padding: 10px;'>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><br>	
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>
				";
			}
			else
			{
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
								<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
								

								<!-- top-header -->
									<div class='agile-main-top'>
										<div class='container-fluid'>
											<div class='row main-top-w3l py-2'>
												<div class='col-lg-4 header-most-top'>
													<!-- <button class='btn btn-danger' name='like'> ????</button> -->";

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
											       		echo "????";
											       		//echo"You liked this post";

											       	}
											       	else
											       	{
											       		echo "????";
											       		//echo "You unvote";
											       		//echo"Like this post?";

											       	}
											       	echo"
											       	 class='btn btn-success'  />
											       	</form>";

											       	if($temp==1)
											       		echo"You liked this post";
											       	else
											       		echo"Like this post?";
											       echo "

												</div>
												<div class='col-lg-8 header-right mt-lg-0 mt-2'>
													<!-- header lists -->


													<a href='#' data-toggle='modal' data-target='#report' class='btn btn-danger' >
																 Report </a>
													<!-- //header lists -->
												</div>
											</div>
										</div>
									</div>
									<!-- modals -->
									<!-- report -->
									<div class='modal fade' id='report' tabindex='-1' role='dialog aria-hidden='true'  >
										<div class='modal-dialog' role='document' style='background: tomato' >
											<div class=modal-content'  >
												<div class='modal-header'>
													<h5 class='modal-title text-center'>Report Post</h5>
													<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
														<span aria-hidden='true'>&times;</span>
													</button>
												</div>
												<div class=modal-body>
													<form action='#' method='post'>
														<div class='form-group'>
															<label class='col-form-label'>Email</label>
															<input type='text' class='form-control' placeholder='' name='email_report' required='' value='$user_com_email'>
														</div>
														<div class='form-group'>
															<label class='col-form-label'>Content Report</label>
															<input type='text' class='form-control' placeholder='' name='content_report' required=''>
														</div>
														<div class='right-w3l' >
															<input type='submit' class='form-control' name='send_admin' value='Send report' style='background: Turquoise; color:black;border:solid;margin:auto; box-sizing:content-box; width: 100px; height: 20px;padding: 10px;'>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div><br>
								
						</div>
						<div class='col-sm-3'>
						</div>
					</div><br><br>";
				}
				if(isset($_POST['send_admin']))
				{
					if($_SESSION['user_email']!="guest") 
					{
						$report = htmlentities($_POST['content_report']);

						if($report == "")
						{
						echo "<script>alert('Please enter your report!')</script>";
						//echo "<script>window.open('single.php?post_id = $post_id' , '_self')</script>";
						}
						else
						{
							$insert= "insert into report(post_id, user_report, username_report, email_report, content, date) values('$post_id', '$user_com_id','$user_com_name','$user_com_email','$report',NOW())";
							$run=mysqli_query($con, $insert);
							if($run)
							{
								echo "<script>alert('Your report is processing!')</script>";
							}

						}//echo "<script>window.open('single.php?post_id = $post_id' , '_self')</script>";
					
					}
					else
					{
						echo "<script>alert('Please Sign In!')</script>";
					}
					
				}
		}
			 //else condition ending

			include("comments.php");

			echo"
			<div class='row'>
                <div class='col-md-6 col-md-offset-3'>
                    <div class='panel panel-info'>
                        <div class='panel-body'>
							<form action = '' method='post' class='form-inline'>
							<textarea placeholder = 'Write your comment here!' class ='pb-cmnt-textarea' name = 'comment'></textarea>
							<button class = 'btn btn-info pull-right' name='reply'>Comment</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			";

			if(isset($_POST['reply']))
			{
				if($_SESSION['user_email']!="guest") 
				{
					$comment = htmlentities($_POST['comment']);

					if($comment == "")
					{
						echo "<script>alert('Please enter your comment!')</script>";
						//echo "<script>window.open('single.php?post_id = $post_id' , '_self')</script>";
					}
					else
					{
						$insert = "insert into comments (post_id, user_id, comment, comment_author,date) values ('$post_id','$user_id','$comment','$user_com_name',NOW())";

						$run = mysqli_query($con, $insert);
						if($run)
						{
							
							//echo "<script>
							echo "<script>alert('Your comment added!')</script>";
							//echo "<script>window.open('single.php?post_id='.'$post_id')</script> ";
						}
							//echo "<script>window.location('single.php?post_id='.'$post_id')</script>";
							
					}
				}
				else
				{
					echo "<script>alert('Please Sign In!')</script>";
				}
				
			}
			if(isset($_POST['vote']))
			{
				
				if($_SESSION['user_email']!="guest") 
				{
					//$result=false;
					if($num_of_vote==1)
					{
						$delete_qr="delete from vote where post_id='$post_id' and user_vote='$user_com_id'";
						$run= mysqli_query($con, $delete_qr);
						$update_qr="update posts set PostPoint=PostPoint-1 where post_id='$post_id' ";
						$run=mysqli_query($con, $update_qr);
						//$result=mysqli_affected_rows($con);
					}
					else
					{
						$insert_qr="insert into vote(post_id, user_vote, date) values('$post_id','$user_com_id',NOW())";
						$run=mysqli_query($con, $insert_qr);
						$update_qr="update posts set PostPoint=PostPoint+1 where post_id='$post_id' ";
						$run=mysqli_query($con, $update_qr);
						//$result=mysqli_affected_rows($con);

					}
				}
				else
				{
					echo "<script>alert('Please Sign In!')</script>";
				}


				/*if($temp==1)
				{
					$update="update table vote set statusvote='0' where user_vote='$user_com_id' and post_id='$post_id'  ";
														    //$con->query($update);
					$run=mysqli_query($con, $update);
					if($run)
					{
						echo "<script>alert('Your report is processing!')</script>";
					}
					echo"You unvote, you can like!";
				}
				elseif($temp==0)
				{
					$update="update table vote set statusvote='1' where user_vote='$user_com_id' and post_id='$post_id'  ";
															     
					$run=mysqli_query($con, $update);
														    //$con->query($update);
														        		//$num_of_run=mysqli_num_rows($run);
					if($run)
					{
						echo "<script>alert('Your report is processing!')</script>";
					}
					echo"You liked, please reload page!";
				}
				else
				{
					$insert="insert into vote(post_id, user_vote, date) values('$post_id','$user_com_id',NOW()) ";
					 $run=mysqli_query($con, $insert);
														    //$num_of_run=mysqli_num_rows($run);
					if($run)
					{
						echo "<script>alert('Your report is processing!')</script>";
					}
					echo"insert new";
				}	 */	
			}			
		}
	
}

function user_posts(){
	global $con;
	//session_start();
	if(isset($_GET['u_id'])){
		$u_id = $_GET['u_id'];
	}
	//echo $u_id;
	$get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5";

	$run_posts = mysqli_query($con, $get_posts);

	while($row_posts = mysqli_fetch_array($run_posts)){
		$post_id = $row_posts['post_id'];
		$user_id = $row_posts['user_id'];
		$content = $row_posts['post_content'];
		$upload_image = $row_posts['upload_image'];
		$post_date = $row_posts['post_date'];

		$post="select * from posts where post_id='$post_id' ";
		$run_post = mysqli_query($con, $post);
		$row_post = mysqli_fetch_array($run_post);
		$post_point=substr($row_post['PostPoint'],0,20);

		$comment="select count(*) as CommentNumber from comments where post_id='$post_id' ";
		$run_comment = mysqli_query($con, $comment);
		$row_comment = mysqli_fetch_array($run_comment);
		$post_comment_point=substr($row_comment['CommentNumber'],0,20);

		$user = "select * from users where user_id = '$user_id' AND posts='yes'";

		$run_user = mysqli_query($con, $user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		if(isset($_GET['u_id'])){
			$u_id = $_GET['u_id'];
		}
		$getuser = "select user_email from users where user_id = '$u_id'";
		$run_user = mysqli_query($con, $getuser);
		$row = mysqli_fetch_array($run_user);

		$user_email = $row['user_email'];

		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email = '$user'";

		$run_user = mysqli_query($con, $get_user);
		$row = mysqli_fetch_array($run_user);

		$user_id = $row['user_id'];
		$u_email = $row['user_email'];

		if($u_email != $user_email){
			echo"<script>window.open('my_post.php?u_id = $user_id', '_self')</script>";
		}else{
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
									<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
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
									<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
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
								<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
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
}

function results(){
	global $con;
	if(isset($_GET['search'])){
		$search_query = htmlentities($_GET['user_query']);
	}

	$get_posts = "select * from posts where post_content like '%$search_query%' OR upload_image like '%$search_query%'";
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
								<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
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
								<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
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
							<h2><p>$post_point ????, $post_comment_point &#9997</p></h2>
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

function show_users()
    {
    	global $con;
        $qr="select * from users order by userpoint desc limit 10";
        $run=mysqli_query($con, $qr);
        $num= mysqli_num_rows($run);
        $temp=1;
    echo"
    <style>
	table, th, td {
		font-size:30px;
	}
	</style>
    <div>
    <table style='width:70%; color:orange;' align='center'>
        <tr style='color:red'>
        	<th>TOP</th>
            <th>User name</th>
            <th>First name</th>
            
            <th>Email</th>
            <th>Point</th>

        </tr>";
        while($row_users=mysqli_fetch_array($run))
            {
            	echo "<tr style='color:black'>";

                $user_id = $row_users['user_id'];
                $user_name = $row_users['user_name'];
                $f_name = $row_users['f_name'];
                $email = $row_users['user_email'];
                $point = $row_users['userpoint'];   
               // $img=$row_users['user_image'];
                echo"
                <td>"; echo $temp; echo "</td>";     
                echo"
                <td>"; echo "<a style='color:black' href='user_profile.php?u_id="; echo $user_id; echo" '</a>";echo "$user_name </td>";
                echo"
                <td>"; echo $f_name; echo "</td>";
                //echo "<td>"; echo $img; echo "</td>";

                echo"
                <td>"; echo $email; echo "</td>";
                echo"
                <td>"; echo $point; echo "</td>";
				echo "</tr>";
				$temp=$temp+1;
            }
        while($temp!=11)
        {
        	    echo "<tr style='color:black'>";
  
               // $img=$row_users['user_image'];
                echo"
                <td>"; echo $temp; echo "</td>";     
                echo"
                <td>"; echo "</td>";
                echo"
                <td>";  echo "</td>";
                //echo "<td>"; echo $img; echo "</td>";

                echo"
                <td>"; echo "</td>";
                echo"
                <td>";  echo "</td>";
				echo "</tr>";
				$temp=$temp+1;
        }
            echo "
        

    </table>
  </div>";
}


function show_posts()
    {
    	global $con;
        $qr="select * from posts order by postpoint desc limit 10";
        $run=mysqli_query($con, $qr);
        $num= mysqli_num_rows($run);
        $temp=1;
    echo"
    <style>
	table, th, td {
		border: 1px solid black;
		font-size:30px;
	}
	</style>
    <div>
    <table style='width:70%; color:orange;' align='center' s>
        <tr style='color:red'>
        	<th>TOP</th>
            <th>User Create</th>
            <th>Content</th>
            <th>Point</th>

        </tr>";
        while($row_posts=mysqli_fetch_array($run))
            {
            	echo "<tr style='color:black'>";
            	$post_id = $row_posts['post_id']; 
                $content = $row_posts['post_content'];
                $user_id = $row_posts['user_id']; 
                $point = $row_posts['PostPoint'];  


                $user="select * from users where user_id='$user_id'";
                $run_user=mysqli_query($con, $user);
                $result_user=mysqli_fetch_array($run_user);

                $user_name=$result_user['user_name'];
                $f_name=$result_user['f_name']; 

               // $img=$row_users['user_image'];
                echo"
                <td>"; echo $temp; echo "</td>";     
                echo"
                <td>"; echo "<a style='color:black' href='user_profile.php?u_id="; echo $user_id; echo" '</a>";echo "$user_name </td>";
                //echo" <td>"; echo $f_name; echo "</td>";
                //echo "<td>"; echo $img; echo "</td>";
                //<td>"; echo $content; echo "</td>";
                echo"
                
                <td>"; echo "<a style='color:black' href='single.php?post_id="; echo $post_id; echo" '</a>";echo  "$content</td>";
                echo"
                <td>"; echo $point; echo "</td>";
				echo "</tr>";
				$temp=$temp+1;
            }
                    while($temp!=11)
        {
        	    echo "<tr style='color:black'>";
  
               // $img=$row_users['user_image'];
                echo"
                <td>"; echo $temp; echo "</td>";     
                echo"
                <td>"; echo "</td>";
                echo"
                <td>";  echo "</td>";
                //echo "<td>"; echo $img; echo "</td>";

                echo"
                <td>"; echo "</td>";
                echo"
                <td>";  echo "</td>";
				echo "</tr>";
				$temp=$temp+1;
        }
            echo "

    </table>
  </div><br><br>";
}
function search_user(){
	global $con;

	if(isset($_GET['search_user_btn'])){
		$search_query = htmlentities($_GET['search_user']);
		$get_user = "select * from users where f_name like '%$search_query%' OR l_name like '%$search_query%' OR user_name like '%$search_query%'";
	}
	else{
		$get_user = "select * from users";
	}

	$run_user = mysqli_query($con, $get_user);
	while($row_user = mysqli_fetch_array($run_user)){
		$user_id = $row_user['user_id'];
		$f_name = $row_user['f_name'];
		$l_name = $row_user['l_name'];
		$username = $row_user['user_name'];
		$user_image = $row_user['user_image'];

		echo"
		<div class='row'>
			<div class='col-sm-3'>
			</div>
			<div class='col-sm-6'>
				<div class='row' id='find_people'>
					<div class='col-sm-4'>
						<a href='user_profile.php?u_id=$user_id'>
						<img src='users/$user_image' width='150px' height='140px' title='$username' style='float:left; margin:1px;'/>
						</a>
					</div><br><br>
					<div class='col-sm-6'>
						<a style='text-decoration:none;cursor:pointer;color:#3897f0;' href='user_profile.php?u_id=$user_id'>
						<strong><h2>$f_name $l_name</h2></strong>
						</a>	
					</div>
					<div class='col-sm-3'>
					</div>
				</div>
			</div>
			<div class='col-sm-4'>
			</div>
		</div><br>
		";
	}
}

?>
