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
					  
			  /* Photo validation  		*/  
			 if (form.filename.value.length < 10 ) {
				error_photo.innerHTML ="<img src='images/delete.gif' border='0'>&nbsp;&nbsp;Please select a CSV file to upload";
				setTimeout(function () {error_photo.innerHTML =""}, 10000);
				valid = false;
			  } else {
				error_photo.innerHTML ="";
				setColor(form.filename, bgGood);
			  }
			  
			return valid;
		}	
	
	   
	function CheckPhotoExt()
	{
		var fup = document.getElementById('filename');
     	var fileName = fup.value;
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
		if(ext == "csv" || ext == "CSV")
			{
			return true;
			} 
		else
		{
			fileName="";
			error_photo.innerHTML="Upload .csv files only";
			document.getElementById('filename').value="";
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
							<b>Import CSV</b>
						</div>
						<div class="panel-body">
						<form name="addPhoto" enctype="multipart/form-data" method="post">
							<table>
								
								<tr>
									<td height="43" width="188" align="center"><FONT face=Verdana color=#e30102 size=-2>
									*</FONT><FONT face="Verdana, Arial, Helvetica" color=#000000 size=2>
									 Choose File</font>
									 
									</td>
									<td height="43" width="234"><DIV id="error_photo" style="color:red;"></DIV><br><input type="hidden" name="MAX_FILE_SIZE" value="2000000">
									<input name="filename" type="file" id="filename" onchange="return CheckPhotoExt();" class="form-control"/>
									
									</td>
								</tr>
								<tr>
									<td align='center'><a href="#" class="btn btn-primary" onClick="save();">Upload</a></td>
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
