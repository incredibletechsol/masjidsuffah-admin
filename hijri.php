<?php include('logincommon.php'); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> <?php include('title.php'); ?></title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
   
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	
	<script src="assets/js/jquery-1.10.2.js"></script>
	
	<script type="text/javascript">

	function setColor(el, bg) 
		{
		  if (el.style) el.style.backgroundColor = bg;
		}

	
	 function save()
		{
		document.addDays.action="salattimeactions.php?msg=updatehijridays";
		document.addDays.submit();			
		}
		
	</script>
		  <style>
      
      .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
        background-color: #e67e22 !important;
        }
        .btn {
          outline-color: #e67e22 !important;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <?php include('nav.php'); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
			   <div class="row"> 
				
				<div class="col-md-6 col-sm-12 col-xs-12">                     
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Hijri Date Adjustment</b>
						</div>
						<div class="panel-body">
						    <?php
						    include("conn.php");
                     			$id = $_GET['id'];
                     			$fetch_existing_details_query="SELECT * FROM configuration where config_name='hijri_adjust_days'";
                     			
                     			$existing_details_rs= mysqli_query($con,$fetch_existing_details_query);
                     			
                     			while($exiting_details_row = mysqli_fetch_array($existing_details_rs)) 
                     				{
                     				    $days=$exiting_details_row['config_value'];
                     				}
						    ?>
						<form name="addDays" enctype="multipart/form-data" method="post">
							<table>
								
								<tr>
									<td height="43" width="188" align="center"><FONT face=Verdana color=#e30102 size=-2>
									*</FONT><FONT face="Verdana, Arial, Helvetica" color=#000000 size=2>
									 Current Hijri Adjust Days</font>
									 
									</td>
									<td height="43" width="234"><DIV id="error_days" style="color:red;"></DIV><br>
									
									
									<select name="days" id="days" style="width:120px;" class="form-control">
										<?php
											$daysOptions  = array('-2', '-1', '0', '1', '2');
											
											foreach($daysOptions  as $option){
												if($days == $option){
													echo "<option selected='selected' value='$option'>$option</option>" ;
												}else{
													echo "<option value='$option'>$option</option>" ;
												}
											}
										?>
										</select>
									
									</td>
								</tr>
								<tr>
									<td align='center'><a href="#" class="btn btn-primary" onClick="save();">Update</a></td>
								</tr>
							<table>
						</form>	
						</div>
					</div>            
				</div> 
				
		   </div>
		</div>
    </div>


	
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>

    

    
   
</body>
</html>
