<!--Content Area starts-->
<div id="content">
 <div class="left"> <img src="images/social-media-history-large-header-1200x0.png" style="float:left; margin:-left:-60px" /> 
 </div>
 <div class="right">
 <form  class="form2" action="" method="post">
 <h1>Create a new account</h1>
 <table>
 <tr>  
 <td align="right">Name: </td>
 <td>
 
 <input type="text" name="u_name" placeholder="Enter your Name" required="required"/> 
 </td>
 </tr>
 
  <tr>  
 <td align="right">Password: </td>
 <td>
 <input type="password" name="u_pass" placeholder="Enter your Password" required="required"/> 
 </td>
 </tr>
 <tr>  
 <td align="right">Email: </td>
 <td>
 <input type="email" name="u_email" placeholder="Enter your Email" required="required"/> 
 </td>
 </tr>
 
  <tr>  
 <td align="right">Country: </td>
 <td>
 <select name="u_country" required >
 <option value="" selected disabled hidden>Select Country</option>
 <option> Pakistan </option>
 <option> India </option>
 <option> Dubai </option>
 <option> UK </option>
 <option> USA </option>
 </select>
 </td>
 </tr>
 <tr>  
 <td align="right">Gender: </td>
 <td>
 <select name="u_gender" required>
 <option value="" selected disabled hidden>Select Gender</option>
 <option> Male </option>
 <option> Female </option>
 </select>
 </td>
 </tr>
 <tr>  
 <td align="right">Birthday: </td>
 <td>
 <input id="demo" type="date" name="u_birthday"  required="required" /> 
 </td></tr>
 <tr>
 <td align="right"></td>
 <td> <button name="sign_up">Signup</button>
  </td>
 </tr>

 
 </table>
 </form>
 <?php include("user_insert.php"); ?>
 </div>
</div>
 <!--Content Area Ends-->
 