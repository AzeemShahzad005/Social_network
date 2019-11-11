 <?php
$con =mysqli_connect("localhost","root","","social_network") or die("Connection was not established");
function getTopics(){
	global $con;
	
	$get_topics="select * from topics";
	
	$run_topics=mysqli_query($con,$get_topics);
	
	while($row=mysqli_fetch_array($run_topics)){
		$topic_id=$row['topic_id'];
		$topic_title=$row['topic_title'];
		
		echo"<option value='$topic_id'>$topic_title</option>";
		}
}
	//function inserting posts
	function insertPost(){
		    if(isset($_POST['sub'])){
			global $con;
			global $user_id;
			$title = addslashes($_POST['title']);
			$content = addslashes($_POST['contant']);
			$topic = addslashes ($_POST['topic']);
			
			if ($content=='' OR $title==''){
			echo "<h2>Please enter title and topic description</h2>";
				
				exit();
			}
			else{
				$insert = "insert into posts (user_id,topic_id,post_title,post_content,post_date) values ('$user_id','$topic','$title','$content',NOW())";
			$run = mysqli_query($con,$insert);
			if ($run){
			echo "<h3>Posted to timeline , Looks great!</h3>";
			$update = "update users set posts = 'yes' where user_id='$user_id'";
			$run_update = mysqli_query($con,$update);
			
				}
			}
		}
		//function for displaying posts
		function get_posts(){
		global $con;
		$per_page=5;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			}
		else {
			$page=1;
			}	
		$start_from = ($page-1) * $per_page;
	 	$get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from, $per_page";
		$run_posts = mysqli_query($con,$get_posts);	
		
		while($row_posts=mysqli_fetch_array($run_posts)){
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$post_litle = $row_posts['post_title'];
			$content = substr($row_posts['post_content'],0,80);
			$post_date = $row_posts['post_date'];
			
			//getting the user who has posted the thread
			$user = "select * from users where user_id='$user_id' AND posts='yes'";
			
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['u_name'];
			$user_image = $row_user['u_image'];
			
			//Now displaying all at home
			echo "<div id='posts'> 
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
			<h3>$post_litle</h3>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;'> <button> See Replies or Reply to This </button></a>
			</div></br> ";
			}
			include("pagination.php");
			}
		
			function single_post(){
				
				echo"...In Function";
				
				global $con;
				
				if(isset($_GET['post_id'])){
				global $con;
				$get_id = $_GET['post_id'];	
				$get_posts = "select * from posts where post_id='$get_id'";
		$run_posts = mysqli_query($con,$get_posts);	
		
		$row_posts=mysqli_fetch_array($run_posts);
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$post_litle = $row_posts['post_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];
			
			//getting the user who has posted the thread
			$user = "select * from users where user_id='$user_id' AND posts='yes'";
			
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['u_name'];
			$user_image = $row_user['u_image'];
	
			//getting the user session
			$user_com =$_SESSION['u_email'];
            $get_com ="select * from users where u_email='$user_com'";
            $run_com = mysqli_query($con,$get_com);
            $row_com=mysqli_fetch_array($run_com);
            $user_com_id = $row_com['user_id'];
            $u_com_name = $row_com['u_name'];
			
			//Now displaying all at home
			echo "<div id='posts'> 
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
			<h3>$post_litle</h3>
			<p>$post_date</p>
			<p>$content</p>
			
			</div> ";
			include("comments.php");
			
			echo"
			<form action='' method='post' id='reply'>
			<textarea cols='50' rows='5' name='comment' placeholder='Write Your reply'></textarea><br/>
			<input type='submit' name='reply' value='Reply to            This'/>
			
		    </form>	";
			
			if(isset($_POST['reply'])){
				
			$comment = $_POST['comment'];
			
			$insert = "insert into comments (post_id,user_id,comment,comment_author,date) values ('$post_id','$user_id','comment','$u_com_name',NOW())";
			$run= mysqli_query($con,$insert);
			echo"<h2> Your Reply added!</h2>";
			}
				
				
				}
	 }
				
  }
  //function for getting the  categories or topics
	function get_Cats(){
		global $con;
		$per_page=5;
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
			}
		else {
			$page=1;
			}	
		$start_from = ($page-1) * $per_page;
		
		if(isset($_GET['topic'])){
		$topic_id = $_GET['topic'];
		}
		
		$get_posts = "select * from posts where topic_id='$topic_id' ORDER by 1 DESC LIMIT $start_from, $per_page";
		$run_posts = mysqli_query($con,$get_posts);	
		
		while($row_posts=mysqli_fetch_array($run_posts)){
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$post_litle = $row_posts['post_title'];
			$content = substr($row_posts['post_content'],0,80);
			$post_date = $row_posts['post_date'];
			
			//getting the user who has posted the thread
			$user = "select * from users where user_id='$user_id' AND posts='yes'";
			
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['u_name'];
			$user_image = $row_user['u_image'];
			
			//Now displaying all at home
			echo "<div id='posts'> 
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
			<h3>$post_litle</h3>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;'> <button> See Replies or Reply to This </button></a>
			</div></br> ";
			}
			include("pagination.php");
			}
			
			//function for getting search results
	function GetResults(){
		
		global $con;
		
		
		if(isset($_GET['search'])){
		$search_query = $_GET['u_query'];
		
		
		$get_posts = "select * from posts where post_title  like '%$search_query%' OR  post_content like '%$search_query%'  ORDER by 1 DESC LIMIT 5 ";
		
		$run_posts = mysqli_query($con,$get_posts);	
		$count_result = mysqli_num_rows($run_posts);
		if($count_result==0){
			echo"<h3 style='background:black; color:white; padding:10px;'>Sorry, We do not have results for this Keywords!</h3> ";
			exit();
			}
		
		while($row_posts=mysqli_fetch_array($run_posts)){
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$post_litle = $row_posts['post_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];
		
	                //getting the user who has posted the thread
			$user = "select * from users where user_id='$user_id' AND posts='yes'";
			
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['u_name'];
			$user_image = $row_user['u_image'];
			
			//now displaying all at home
			echo "<div id='posts'> 
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
			<h3>$post_litle</h3>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;'> <button> See Replies or Reply to This </button></a>
			</div></br> ";
			}
		}
		}
function user_posts(){
	
	echo".........In function";
		global $con;
	echo".........In function";	
		
		if(isset($_GET['u_id'])){
		
		$u_id= $_GET['u_id'];
			
		$get_posts = "select * from posts where user_id='$u_id' ORDER by 1 DESC LIMIT 5 ";
		$run_posts = mysqli_query($con,$get_posts);	
		
		while($row_posts=mysqli_fetch_array($run_posts))
		
		{
			$post_id = $row_posts['post_id'];
			$user_id = $row_posts['user_id'];
			$post_litle = $row_posts['post_title'];
			$content = $row_posts['post_content'];
			$post_date = $row_posts['post_date'];
			
			//getting the user who has posted the thread
			$user = "select * from users where user_id='$user_id' AND posts='yes'";
			$run_user = mysqli_query($con,$user);
			$row_user = mysqli_fetch_array($run_user);
			$user_name = $row_user['u_name'];
			$user_image = $row_user['u_image'];
			
			//Now displaying all at home
			echo "<div id='posts'> 
			<p><img src='user/user_images/$user_image' width='50' height='50'></p>
			<h3><a href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
			<h3>$post_litle</h3>
			<p>$post_date</p>
			<p>$content</p>
			<a href='single.php?post_id=$post_id' style='float:right;'> <button> See Replies or Reply to This </button></a>
			</div></br> ";
			}
		}
			}
			
function user_profile(){
	
	global $con;
	
	//if(isset($_GET['u_id'])){
	
		
		$user_id = $_GET['user_id'];
		
		$select = "select * from users where user_id='$user_id'";
		$run = mysqli_query($con,$select);
		$row= mysqli_fetch_array($run);
		
		$id = $row['user_id'];
		$image = $row['u_image'];
		$name = $row['u_name'];
		$country = $row['u_country'];
		$gender = $row['u_gender'];
		$last_login = $row['last_login'];
		$registration_date = $row['registration_date'];
		
		if($gender=='Male'){
			
			$msg = "Send him a message";
			
			}
			else{
				$msg="Send her a message";
				}
		echo"<div id='user_profile'>
		
		<img src='user/user_images/$image' width='150' height='150' />
		<br/>
		
		<p><strong>Name:</strong> $name </p></br>
		<p><strong>Genger:</strong> $gender </p></br>
		<p><strong>Country:</strong> $country </p></br>
		<p><strong>Last Login:</strong> $last_login </p></br>
		<p><strong>Member Since:</strong> $registration_date </p></br>
		<a href='messages.php?u_id=$id'><button>$msg</button></a><hr>
		";		
			
		//}
		
		new_members();
		
		echo"</div>";
	
	}
	
	function new_members(){
		
		if(isset($_GET['u_id'])){
		
		global $con;
		
		//Select New Members
		
		$user = "select * from users LIMIT 0,20";
		$run_user = mysqli_query($con,$user);
		
		
		echo" <br/><h2>New Members on this Site:</h2><hr>";
		while($row_user=mysqli_fetch_array($run_user)){
			
			$user_id = $row_user['user_id'];
			$user_name = $row_user['u_name'];
			$user_image = $row_user['u_image'];
			
			echo"
			<span>
			<a href='user_profile.php?u_id=$user_id'>
			<img src='user/user_images/$user_image' width='80' height='80' title='$user_name' style='float:left; margin:5px;'/>
			</a>
			</span>
			
			";
			
		}
			}
		}

?>
