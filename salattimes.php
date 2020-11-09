<?php include('logincommon.php'); 
include('zoom.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> <?php include('title.php'); ?></title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
      <!-- MORRIS CHART STYLES-->
      <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
	   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
  <link href="assets/css/bootstrap.css" rel="stylesheet" />
  <script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
   <link href="plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/custom.css" rel="stylesheet" />
  
      <style>
      
      .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
    background-color: #e67e22 !important;
}
.btn {
  outline-color: #e67e22 !important;
}

         tr{
         margin-bottom:15px;
         }
         .table-responsive-stack tr {
         display: -webkit-box;
         display: -ms-flexbox;
         display: flex;
         -webkit-box-orient: horizontal;
         -webkit-box-direction: normal;
         -ms-flex-direction: row;
         flex-direction: row;
         }
         .table-responsive-stack td,
         .table-responsive-stack th {
         display:block;
         /*      
         flex-grow | flex-shrink | flex-basis   */
         -ms-flex: 1 1 auto;
         flex: 1 1 auto;
         }
         .table-responsive-stack .table-responsive-stack-thead {
         font-weight: bold;
         }
         @media screen and (max-width: 768px) {
         .table-responsive-stack tr {
         -webkit-box-orient: vertical;
         -webkit-box-direction: normal;
         -ms-flex-direction: column;
         flex-direction: column;
         border-bottom: 3px solid #ccc;
         display:block;
         }
         /*  IE9 FIX   */
         .table-responsive-stack td {
         float: left\9;
         width:100%;
         }
         }
      </style>
  
      <script src="assets/js/jquery-1.10.2.js"></script>
      <script type="text/javascript">
	  function save()
		{
			document.addsalattime.action="salattimeactions.php?msg=save";
			document.addsalattime.submit();			
		}
		
		function update()
		{
			document.editsalattime.action="salattimeactions.php?msg=update";
			document.editsalattime.submit();	
		}
		
		function setColor(el, bg) 
		{
		  if (el.style) el.style.backgroundColor = bg;
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
		
		function checkCSVInput(form) 
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
		
		function saveCSV()
		{
		var b=new Boolean();	
		b=checkCSVInput(document.addPhoto);

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
                  <?php
                     if(isset($_GET['msg']))
                     	{
                     		$param=$_GET['msg'];
                     		if($param == "edit")
                     			{
                     			include("conn.php");
                     			$id = $_GET['id'];
                     			$fetch_existing_details_query="SELECT * FROM salat_times where id='$id'";
                     			$existing_details_rs= mysqli_query($con,$fetch_existing_details_query);
                     			
                     			while($exiting_details_row = mysqli_fetch_array($existing_details_rs)) 
                     				{
                     				$id=$exiting_details_row[0];
									$prayerDate  = $exiting_details_row[1];
									$fajr_beginning = $exiting_details_row[2]; 
									$fajr_athan  = $exiting_details_row[3];  
									$fajr_iqama  = $exiting_details_row[4];  
									$thuhr_beginning  = $exiting_details_row[5];  
									$thuhr_athan  = $exiting_details_row[6];  
									$thuhr_iqama  = $exiting_details_row[7];  
									$asr_beginning_shafi  = $exiting_details_row[8];  
									$asr_beginning_hanafi  = $exiting_details_row[9];  
									$asr_athan  = $exiting_details_row[10];  
									$asr_iqama  = $exiting_details_row[11];  
									$maghrib_athan  = $exiting_details_row[12];   
									$maghrib_iqama  = $exiting_details_row[13];  
									$isha_beginning  = $exiting_details_row[14];  
									$isha_athan  = $exiting_details_row[15];  
									$isha_iqama  = $exiting_details_row[16];  
									$shurooq = $exiting_details_row[17];  
                     		        } 			
								if($prayerDate == '00:00')
									$prayerDate ='';
								if($fajr_beginning == '00:00')
									$fajr_beginning ='';
								if($fajr_athan == '00:00')
									$fajr_athan ='';
								if($fajr_iqama == '00:00')
									$fajr_iqama ='';
								if($thuhr_beginning == '00:00')
									$thuhr_beginning ='';
								if($thuhr_athan == '00:00')
									$thuhr_athan ='';
								if($thuhr_iqama == '00:00')
									$thuhr_iqama ='';
								if($asr_beginning_shafi == '00:00')
									$asr_beginning_shafi ='';
								if($asr_beginning_hanafi == '00:00')
									$asr_beginning_hanafi ='';
								if($maghrib_athan == '00:00')
									$maghrib_athan ='';
								if($asr_iqama == '00:00')
									$asr_iqama ='';
								if($asr_athan == '00:00')
									$asr_athan ='';
								if($maghrib_iqama == '00:00')
									$maghrib_iqama ='';
								if($isha_beginning == '00:00')
									$isha_beginning ='';
								if($isha_athan == '00:00')
									$isha_athan ='';
								if($isha_iqama == '00:00')
									$isha_iqama ='';
								if($shurooq == '00:00')
									$shurooq ='';
                     			?>
                  <DIV id="ERROR1" style="color:red;font-weight:bold;"></DIV>
				 <div class="modal-body">
				  <h4 class="modal-title" id="myModalLabel">Update Salat Time</h4><br><br>
				<form name="editsalattime" method="post">
					 <input type="hidden" id="id" value="<?php echo $id; ?>" name="id"/>
                     <table class="table-responsive-stack">
                        <tr>
                           <td height="32" width="120"><b>*Prayer Date:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="prayerDate" data-link-format="yyyy-mm-dd">
                                 <input class="form-control" size="16" type="text" value="<?php echo $prayerDate; ?>" name="prayerDate" id="prayerDate"  readonly>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Fajr Begining:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="fajr_beginning">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $fajr_beginning; ?>" style="width:158px"  id="fajr_beginning" name="fajr_beginning"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                            </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Fajr Athan:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="fajr_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $fajr_athan; ?>" style="width:166px" id="fajr_athan"  name="fajr_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Fajr Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="fajr_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $fajr_iqama; ?>" style="width:158px"  id="fajr_iqama" name="fajr_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
							</td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Thuhr Beginning:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="thuhr_beginning">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $thuhr_beginning; ?>" style="width:166px" id="thuhr_beginning" name="thuhr_beginning"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Thuhr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="thuhr_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $thuhr_athan; ?>" style="width:158px" id="thuhr_athan"  name="thuhr_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                             </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Thuhr Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="thuhr_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $thuhr_iqama; ?>" style="width:166px" id="thuhr_iqama" name="thuhr_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Beginning Shafi:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_beginning_shafi">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_beginning_shafi; ?>"style="width:158px" id="asr_beginning_shafi" name="asr_beginning_shafi"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                            </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Asr Beginning Hanafi:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_beginning_hanafi">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_beginning_hanafi; ?>" style="width:166px" id="asr_beginning_hanafi" name="asr_beginning_hanafi"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_athan; ?>" style="width:158px"  id="asr_athan" name="asr_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Asr Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_iqama; ?>" style="width:166px" id="asr_iqama" name="asr_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Maghrib Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="maghrib_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $maghrib_athan; ?>" style="width:158px" id="maghrib_athan" name="maghrib_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Maghrib Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <input  class="form-control" size="16" type="text" style="width:250px" id="maghrib_iqama" value="<?php echo $maghrib_iqama; ?>" name="maghrib_iqama"//>
                            </td>
                           <td height="32" width="169" align="center"><b>*Isha Beginning:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="isha_beginning">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $isha_beginning; ?>" style="width:158px" id="isha_beginning" name="isha_beginning"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Isha Athan:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="isha_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $isha_athan; ?>" style="width:166px" id="isha_athan" name="isha_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Isha Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="isha_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $isha_iqama; ?>" style="width:158px" id="isha_iqama" name="isha_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Shurooq:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="shurooq">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $shurooq; ?>" style="width:166px" id="shurooq" name="shurooq"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                            </td>
                           <td height="32" width="169" align="center"></td>
                           <td height="32" width="285" align="left">
                           </td>
                        </tr>
                     </table>
                  </form>	
				  </div>
				   <div class="modal-footer">
                  <a href="#" class="btn btn-primary"  onClick="update();">Update</a>
				</div>
                  <?php
							
						}
                     }
                     ?>	
               </div>
               <div class="col-md-12">
                  <!-- Advanced Tables -->
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h3>All Salat Times</h3>
                        <div align='right'>
                           <a class="btn btn-primary btn-lg" href="export.php">
                           Export CSV
                           </a>
						   <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1">
                           Import CSV
                           </button>
                           <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                           Add Salat Time
                           </button>		
                        </div>
                     </div>
                     <div class="panel-body">
                        <div class="table-responsive">
                              <div id="alert_message"></div>
								<table id="user_data" class="table table-bordered table-striped">
								 <thead>
								  <tr>
								    <th>Delete</th>
									<th>Prayer Date</th>
									<th>Fajr Beginning</th>
									<th>Fajr Athan</th>
									<th>Fajr Iqama</th>
									<th>Thuhr Beginning</th>
									<th>Thuhr Athan</th>
									<th>Thuhr Iqama</th>
									<th>Asr Beginning Shafi</th>
									<th>Asr Beginning Hanafi</th>
									<th>Asr Athan</th>
									<th>Asr Iqama</th>
									<th>Maghrib Athan</th>
									<th>Maghrib Iqama</th>
									<th>Isha beginning</th>
									<th>Isha Athan</th>
									<th>Isha Iqama</th>
									<th>Shurooq</th>
						
								  </tr>
								 </thead>
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
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Add Salat Time</h4>
               </div>
               <div class="modal-body">
                  <DIV id="ERROR" style="color:red;font-weight:bold;"></DIV>
                  <form name="addsalattime" method="post">
                     <table class="table-responsive-stack">
                        <tr>
                           <td height="32" width="120"><b>*Prayer Date:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_date" data-date="" data-date-format="yyyy-mm-dd" data-link-field="prayerDate" data-link-format="yyyy-mm-dd">
                                 <input class="form-control" size="16" type="text" value="" readonly>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="prayerDate" value="" name="prayerDate"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Fajr Begining:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date-format="hh:ii" data-link-field="fajr_beginning"  data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="fajr_beginning" value="" name="fajr_beginning" /><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Fajr Athan:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="fajr_athan" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="fajr_athan" value="" name="fajr_athan"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Fajr Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="fajr_iqama" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="fajr_iqama" value="" name="fajr_iqama"//><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Thuhr Beginning:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="thuhr_beginning" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="thuhr_beginning" value="" name="thuhr_beginning"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Thuhr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="thuhr_athan" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="thuhr_athan" value="" name="thuhr_athan"//><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Thuhr Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="thuhr_iqama"   data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="thuhr_iqama" value="" name="thuhr_iqama"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Beginning Shafi:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_beginning_shafi" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="asr_beginning_shafi" value="" name="asr_beginning_shafi"//><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Asr Beginning Hanafi:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_beginning_hanafi" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="asr_beginning_hanafi" value="" name="asr_beginning_hanafi"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_athan" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="asr_athan" value="" name="asr_athan"//><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Asr Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="asr_iqama" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="asr_iqama" value="" name="asr_iqama"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Maghrib Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="maghrib_athan" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="maghrib_athan" value="" name="maghrib_athan"//><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Maghrib Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <input  class="form-control" size="16" type="text" style="width:250px" id="maghrib_iqama" value="" name="maghrib_iqama"  />
                            </td>
                           <td height="32" width="169" align="center"><b>*Isha Beginning:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="isha_beginning" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="isha_beginning" value="" name="isha_beginning"//><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Isha Athan:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="isha_athan" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="isha_athan" value="" name="isha_athan"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Isha Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="isha_iqama" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:158px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="isha_iqama" value="" name="isha_iqama"//><br>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Shurooq:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="shurooq" data-link-format="hh:ii">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="shurooq" value="" name="shurooq"/><br>
                           </td>
                           <td height="32" width="169" align="center"></td>
                           <td height="32" width="285" align="left">
                           </td>
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
	  
	   <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-md">
            <div class="modal-content">
			 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Import CSV</h4>
               </div>
                   <div class="modal-body">
					
						<form name="addPhoto" enctype="multipart/form-data" method="post">
							<table>
								
								<tr>
									<td height="43" width="188" align="center"><FONT face=Verdana color=#e30102 size=-2>
									*</FONT><FONT face="Verdana, Arial, Helvetica" color=#000000 size=2>
									 Choose File</font>
									 
									</td>
									<td height="43" width="400"><DIV id="error_photo" style="color:red;"></DIV><br><input type="hidden" name="MAX_FILE_SIZE" value="2000000">
									<input name="filename" type="file" id="filename" onchange="return CheckPhotoExt();" class="form-control"/>
									
									</td>
								</tr>
								<tr>
									<td align='center' colspan="2"><br><a href="#" class="btn btn-primary" onClick="saveCSV();">Upload</a></td>
								</tr>
								
								<tr>
									
									<td height="43" width="400"  colspan="2" align="center">
									 <br><a href="sample/Salat_Times.csv">Click Here</a> to download the sample csv<br>
									</td>
								</tr>
							
							<table>
						</form>	
	              </div>
            </div>
         </div>
      </div>
	  
      <!-- /. PAGE WRAPPER  -->
      <!-- /. WRAPPER  -->
      <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
      <!-- JQUERY SCRIPTS 
      <script src="assets/js/jquery-1.10.2.js"></script>-->
	  <script src="assets/js/jquery.min.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
      <script src="assets/js/bootstrap.min.js"></script>
      <!-- METISMENU SCRIPTS -->
      <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- DATA TABLE SCRIPTS -->
<script src="plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
	  <!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
     
      <script type="text/javascript" src="js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
      <script type="text/javascript">
         $('.form_datetime').datetimepicker({
             //language:  'fr',
             weekStart: 1,
             todayBtn:  1,
         autoclose: 1,
         todayHighlight: 1,
         startView: 2,
         forceParse: 0,
             showMeridian: 1
         });
         $('.form_date').datetimepicker({
             language:  'fr',
             weekStart: 1,
             todayBtn:  1,
         autoclose: 1,
         todayHighlight: 1,
         startView: 2,
         minView: 2,
         forceParse: 0
         });
         $('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
      </script>
	   <!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
<!-- end - This is for export functionality only -->
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
	"bFilter": false,
	"scrollX": true,
	"order" : [],
    "ajax" : {
     url:"timemgmt/fetch.php",
     type:"POST"
    }
   });
  
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"timemgmt/update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var first_name = $('#data1').text();
   var last_name = $('#data2').text();
   if(first_name != '' && last_name != '')
   {
    $.ajax({
     url:"timemgmt/insert.php",
     method:"POST",
     data:{first_name:first_name, last_name:last_name},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"timemgmt/delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });
</script>
   </body>
</html>