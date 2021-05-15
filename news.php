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
		
	function checkInput(form) 
		{
	
			  var bgBad = "#FF9999";
			  var bgGood = "#66FFCC";
			  var valid = true;
			  var errmsg="";
			  
				  
			 /* Heading validation */ 		  
			 if (form.heading.value == "") {
				error_heading.innerHTML ="<img src='images/delete.gif' border='0'>&nbsp;&nbsp;Please enter Announcement Heading";
				setTimeout(function () {error_heading.innerHTML =""}, 10000);
				valid = false;
			  } else {
				error_heading.innerHTML ="";
				setColor(form.heading, bgGood);
			  }
			  	  
			  /* Details  validation */ 		  
			 if (form.details.value == "") {
				error_details.innerHTML ="<img src='images/delete.gif' border='0'>&nbsp;&nbsp;Please enter Announcement Details";
				setTimeout(function () {error_details.innerHTML =""}, 10000);
				valid = false;
			  } else {
				error_details.innerHTML ="";
				setColor(form.details, bgGood);
			  }
                 
			   
			return valid;
		}

	function isNumberKey(evt)
       {
		  var chCode = (evt.which) ? evt.which : event.keyCode
		  if (chCode != 46 && chCode > 31 
			&& (chCode < 48 || chCode > 57))
			 return false;
		  else
		  return true;
       }
		       
    function isAlpha(keyCode)
       {
         return ((keyCode >= 65 && keyCode <= 90) || keyCode == 8 || keyCode == 32 || keyCode == 9 || keyCode == 46)
       }
	
	function save()
		{
		var b=new Boolean();	
		b=checkInput(document.addnews);
		if (!b) 
			{
			ERROR.innerHTML ="<h4><img src='images/cross.png' border='0'>&nbsp;&nbsp;Error : Please correct the fields and try submitting again</h4>";
			setTimeout(function () {ERROR.innerHTML =""}, 12000);
			}
		else
			{
			document.addnews.action="newsactions.php?msg=save";
			document.addnews.submit();			
			}
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
				
			</div>	
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             <h3>All Announcements</h3>
							 <div align='right'>
							 <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                              Add Announcement
							</button>
							</div>
                        </div>
						
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Heading</th>
                                            <th>Detail</th>
						        			<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										include('conn.php');
										$fetch_basic_profile="select * from announcement order by id desc";	
										
										$basic_profile_rs= mysqli_query($con,$fetch_basic_profile);

										while($basic_profile_row = mysqli_fetch_array($basic_profile_rs)) 
											{
											$id=$basic_profile_row[0];
											echo "<tr>";
											echo "<td>".$basic_profile_row[1]."</td>";
											echo "<td>".$basic_profile_row[2]."</td>";
											echo "<td><a href='newsactions.php?id=$id&msg=delete'><img src='images/cross.png'></a></td>";
											echo "</tr>";
											} 
										?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            
        </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
			
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Add Announcement</h4>
			</div>
			<div class="modal-body">
			<DIV id="ERROR" style="color:red;font-weight:bold;"></DIV>
				<form name="addnews" enctype="multipart/form-data" method="post">
				 <table border="0" width="447" height="40">
					<tr>
						<td height="34" width="180" valign="top"><b>*Heading</b></td>
						<td height="34" width="7" valign="top"><b>:</b></td>
						<td height="34" width="238"><input name="heading" type="text" class="form-control" id="heading" /><br><DIV id="error_heading" style="color:red;"></DIV></td>
					</tr>
					<tr>
						<td height="34" width="180" valign="top"><b>*Details</b></td>
						<td height="34" width="7" valign="top"><b>:</b></td>
						<td height="34" width="238"><textarea rows="5" cols="80" name="details"  class="form-control" id="details"></textarea><br><DIV id="error_details" style="color:red;"></DIV></td>
					</tr>
				
				</table>
				
			</form>	
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary"  onClick="save();">Save</a>
			</div>
		</div>
	</div>
</div>

	
    <script src="assets/js/jquery-1.10.2.js"></script>
     
    <script src="assets/js/bootstrap.min.js"></script>
  
<<<<<<< HEAD
=======
     <!-- DATA TABLE SCRIPTS -->
>>>>>>> 2174e5b62a1bf8cc2c16a859233270829b2764f9
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
<<<<<<< HEAD

=======
         <!-- CUSTOM SCRIPTS -->
>>>>>>> 2174e5b62a1bf8cc2c16a859233270829b2764f9
   
    
   
</body>
</html>
