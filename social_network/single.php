<?php
session_start();
include("includes/connection.php");
include("functions/functions.php");


if (!isset($_SESSION['u_email'])){
	header("location:index.php");
}
else{
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="styles/home_style.css" media="all"/>
</head>

<body>

<!--container starts-->
<div class="container">

<!--Header wrap starts-->
<div id="head_wrap">

<!--Header starts-->
<div id="header">
   <ul id="menu">
   <li><a href="home.php">Home</a></li>
   <li><a href="contact.php">Contact</a></li>
     <li><a href="members.php">Members</a></li>
     <strong>Topics:</strong>
      <?php
	  	$get_topic="select * from topics";
	$run_topics=mysqli_query($con,$get_topic);
	
	while($row=mysqli_fetch_array($run_topics)){
		$topic_id=$row['topic_id'];
		$topic_title=$row['topic_title'];
		
		echo"<li><a href='topic.php?topic=$topic_id'>$topic_title</a></li>";
		}
	  
	  ?>
      
     </ul>
  <form method="post" action="results.php" id="form1">
  <input type="text" name="u_query" placeholder="Search a Members"/>
  <input type="submit" name="search" value="Search"/>
  </form> 
   
</div>
<!--header end-->
</div>
<!--head wrap end-->


<!--Content area starts-->
<div class="contant">
<!--user timeline starts-->
<div id="u_timeline">
<div id="u_details">
<?php
$user =$_SESSION['u_email'];
$get_user ="select * from users where u_email='$user'";
$run_user = mysqli_query($con,$get_user);
$row=mysqli_fetch_array($run_user);
$user_id = $row['user_id'];
$u_name = $row['u_name'];
$u_country = $row['u_country'];
$u_image = $row['u_image'];
$registration_date = $row['registration_date'];
$last_login = $row['last_login'];

$user_posts= " select * from posts where user_id='$user_id'";
$run_posts = mysqli_query($con,$user_posts);
$posts=mysqli_num_rows($run_posts);

//getting the number of unread massages
$sel_msg="select * from messages where reciver='$user_id' AND status='unread' ORDER by 1 DESC";
$run_msg = mysqli_query($con,$sel_msg);
$count_msg=mysqli_num_rows($run_msg);

echo "
<center><img src='user/user_images/$u_image' width='200px' height='200px'/></center>
<hr width='200px'>
<div id='u_mention'>
<p><strong>Name:</strong>$u_name</p>
<p><strong>Country:</strong>$u_country</p>
<p><strong>Last Login:</strong>$last_login</p>
<p><strong>Member Since:</strong>$registration_date</p>
<hr width='200px'>
<p><a href='my_message.php?inbox&u_id=$user_id'><strong>Messages&nbsp;</strong>($count_msg)</a></p>
<p><a href='my_posts.php?u_id='$user_id'><strong>My Posts($posts)</strong></a></p>
<p><a href='edit_profile.php?u_id='$user_id'><strong>Edit account</strong></a></p>
<p><a href='logout.php'><strong>Logout</strong></a></p>
 </div>";
?>
</div>
</div>
<!--user timeline ends starts-->

<!--Content timeline starts-->
<div id="content_timeline">

       <?php
		 single_post();
		
		?>  
</div>
 <!--Content timeline ends-->
</div>
<!--Content area Ends-->
</div>
<!--container end-->

</body>
</html>
<?php }  ?>