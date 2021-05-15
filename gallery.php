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
    <style>
        .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
        background-color: #e67e22 !important;
        }
        .btn {
          outline-color: #e67e22 !important;
        }
    </style>
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
			  
			 /* Title  validation */ 		  
			 if (form.title.value == "") {
				error_title.innerHTML ="<img src='images/delete.gif' border='0'>&nbsp;&nbsp;Please enter Photo Title";
				setTimeout(function () {error_title.innerHTML =""}, 10000);
				valid = false;
			  } else {
				error_title.innerHTML ="";
				setColor(form.title, bgGood);
			  }
			
			  
			  /* Photo validation  		*/  
			 if (form.photo.value.length < 10 ) {
				error_photo.innerHTML ="<img src='images/delete.gif' border='0'>&nbsp;&nbsp;Please select a Photo to upload";
				setTimeout(function () {error_photo.innerHTML =""}, 10000);
				valid = false;
			  } else {
				error_photo.innerHTML ="";
				setColor(form.photo, bgGood);
			  }
			  
			return valid;
		}	
	
	   
	function CheckPhotoExt()
	{
		var fup = document.getElementById('photo');
     	var fileName = fup.value;
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		if(ext == "jpg" || ext == "png" || ext == "gif" || ext == "bmp" || ext == "JPG" || ext == "PNG" || ext == "GIF" || ext == "BMP")
			{
			return true;
			} 
		else
		{
			fileName="";
			error_photo.innerHTML="Upload .jpg,.png,.gif,.bmp files only";
			document.getElementById('photo').value="";
			fup.focus();
			return false;
		}
	}
	
	function save()
		{
		var b=new Boolean();	
		b=checkInput(document.addPhoto);
		if (!b) 
			{
			ERROR.innerHTML ="<h4><img src='images/cross.png' border='0'>&nbsp;&nbsp;Error : Please correct the fields and try submitting again</h4>";
			setTimeout(function () {ERROR.innerHTML =""}, 12000);
			}
		else
			{
			document.addPhoto.action="galleryactions.php?msg=save";
			document.addPhoto.submit();			
			}
		}
		
		
    
		
	</script>
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
							<b>Gallery</b>
						</div>
						<div class="panel-body">
							<?php
								include('conn.php');
								include('zoom.php');
								$result = mysqli_query($con,"SELECT * FROM tbl_gallery order by photoid desc") or die('Query Not Executed');
								$i=0;
								echo "<marquee behavior=scroll direction=left scrollamount=7 onmouseout=this.start() onmouseover=this.stop() scrolldelay=90 style='background-color:white;'>"; 
								while($row = mysqli_fetch_array($result)){
									 echo "<a href='gallery/" . $row['name'] . "' rel='lightbox1' class='effectable'><img src='gallery/" . $row['name'] . "' width=50 height=50 title=".$row['title']."/></a>";
								 echo "<a href='galleryactions.php?id=$row[photoid]&msg=delete'><img src=images/cross.png border=0 width=25 height=25></a>";
								}
								echo "</marquee>";
							?>	
						</div>
					</div>            
				</div>
				<?php
				include('conn.php');
				$fetch_noofphotos="select count(*) mycount from tbl_gallery";	

				$noofphotos_rs= mysqli_query($con,$fetch_noofphotos);

					while($noofphotos_row = mysqli_fetch_array($noofphotos_rs)) 
					{
					$count=$noofphotos_row[0];
					}
				if($count < 10) {		
				?>
				<div class="col-md-6 col-sm-12 col-xs-12">                     
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Add New Photos</b>
						</div>
						<div class="panel-body">
						<form name="addPhoto" enctype="multipart/form-data" method="post">
							<table>
								<tr>
									<td height="43" width="188" align="center"><FONT face=Verdana color=#e30102 size=-2>
									*</FONT><FONT face="Verdana, Arial, Helvetica" color=#000000 size=2>
									 Title</font>
									</td>
									<td height="43" width="234"><DIV id="error_title" style="color:red;"></DIV><br><input type="text" name="title" class="form-control">
									
									</td>
								</tr>
								<tr>
									<td height="43" width="188" align="center"><FONT face=Verdana color=#e30102 size=-2>
									*</FONT><FONT face="Verdana, Arial, Helvetica" color=#000000 size=2>
									 Choose File</font>
									 
									</td>
									<td height="43" width="234"><DIV id="error_photo" style="color:red;"></DIV><br><input type="hidden" name="MAX_FILE_SIZE" value="2000000">
									<input name="photo" type="file" id="photo" onchange="return CheckPhotoExt();" class="form-control"/>
									
									</td>
								</tr>
								<tr>
									<td align='center'><a href="#" class="btn btn-primary"  onClick="save();">Upload</a></td>
								</tr>
							<table>
						</form>	
						</div>
					</div>            
				</div> 
				<?php
				}
				else {
				?>
				<div class="col-md-6 col-sm-12 col-xs-12">                     
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Add New Photos</b>
						</div>
						<div class="panel-body">
							<h3>You can upload Maximum 10 Photos.</h3>
						</div>
					</div>            
				</div> 	
				
				<?php
				}
				?>
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
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
