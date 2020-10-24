<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <title><?php include('title.php'); ?></title>
    <link rel="stylesheet" href="css/loginstyle.css" media="screen" type="text/css" />
    <script src="js/modernizr.js"></script>
	<script type="text/javascript" src="js/customalert.js"></script>
	<link rel="stylesheet" type="text/css" href="css/customalert.css" />
	<script src="js/jquery.min.js" type="text/javascript"></script> 
				
		<script type="text/javascript">

		function setColor(el, bg) 
		{
		  if (el.style) el.style.backgroundColor = bg;
		}
		
		function validateLoginForm(form) 
		{
		  var bgBad = "lightyellow";
		  var bgGood = "lightgreen";
		  var valid = true;
		  var errmsg="";
		  
		  
		   /* Profile Id validation */
		  if (form.username.value == "") {
		    valid = false;
		    setColor(form.username, bgBad);
		  
		  } else {
		    setColor(form.username, bgGood);
		  }
		 
		  /* Password validation */
		  if (form.password.value == "") {
		    valid = false;
		    setColor(form.password, bgBad);
		  
		  } else {
		    setColor(form.password, bgGood);
		  }
				  
		errmsg=errmsg+"\n Please fill both the fields ";
		
		if (!valid) 
			createCustomAlert(errmsg,"","Errors");
			
			
		return valid;
		}
	</script>
	<script src="js/js_disable_right_click.js" type="text/javascript"></script>
    <script src="js/js_disable_right_click_cfg.js" type="text/javascript"></script>
	<script src='assets/js/jquery.js'></script>
</head>
<body>
<form name="login" class="login-form" action="login.php" method="post" onSubmit="return validateLoginForm(this)">
<div class="stand">
  <div class="outer-screen">
   <h1>Masjid Suffah</h1>
    <div class="inner-screen">
	   <?php
	if(isset($_GET['msg']))
		{
		$param=$_GET['msg'];
		if($param == "failed")
			{
			echo "<center><img src='images/warning.gif'><font face='calibri'> Invalid Username / Password</font></center>";
			}
		}	
	?>
      <div class="form">
        <input type="text" name="username" id="username"  class="zocial-dribbble" placeholder="Enter your Username" />
        <input type="password" name="password" id="password"  placeholder="Password" />
         <input type="submit" value="Login" name="submit"/>
      </div> 
    </div> 
  </div> 
</div>
</form>

</body>

</html>