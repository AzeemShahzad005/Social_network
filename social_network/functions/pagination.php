<?php
$query = "select * from posts";
$result = mysqli_query($con,$query);
//count the total records
$total_posts = mysqli_num_rows($result);
//Using ceil function to divide the total records on per page
$total_pages = ceil($total_posts / $per_page);
//Going to First page 
echo "
<center>
<div id='pagination'>
<a href='home.php?page1'>First Page</a>
";
for ($i=1; $i<=$total_pages; $i++){
	echo "<a href='home.php?page=$i'>$i</a>";
	}
//Going for Last page
echo  "<a href='home.php?page=$total_pages'>Last Page</a></center></div>";	


?> 