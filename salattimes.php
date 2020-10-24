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
      <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
      <!-- CUSTOM STYLES-->
      <link href="assets/css/custom.css" rel="stylesheet" />
      <!-- GOOGLE FONTS-->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
      <!-- TABLE STYLES-->
      <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
      <link rel="stylesheet" type="text/css" media="all" href="css/jsDatePick_ltr.min.css" />
      <script type="text/javascript" src="js/jsDatePick.min.1.3.js"></script>
      <style>
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
								if($prayerDate == '0000-00-00 00:00:00')
									$prayerDate ='';
								if($fajr_beginning == '0000-00-00 00:00:00')
									$fajr_beginning ='';
								if($fajr_athan == '0000-00-00 00:00:00')
									$fajr_athan ='';
								if($fajr_iqama == '0000-00-00 00:00:00')
									$fajr_iqama ='';
								if($thuhr_beginning == '0000-00-00 00:00:00')
									$thuhr_beginning ='';
								if($thuhr_athan == '0000-00-00 00:00:00')
									$thuhr_athan ='';
								if($thuhr_iqama == '0000-00-00 00:00:00')
									$thuhr_iqama ='';
								if($asr_beginning_shafi == '0000-00-00 00:00:00')
									$asr_beginning_shafi ='';
								if($asr_beginning_hanafi == '0000-00-00 00:00:00')
									$asr_beginning_hanafi ='';
								if($maghrib_athan == '0000-00-00 00:00:00')
									$maghrib_athan ='';
								if($asr_iqama == '0000-00-00 00:00:00')
									$asr_iqama ='';
								if($asr_athan == '0000-00-00 00:00:00')
									$asr_athan ='';
								if($maghrib_iqama == '0000-00-00 00:00:00')
									$maghrib_iqama ='';
								if($isha_beginning == '0000-00-00 00:00:00')
									$isha_beginning ='';
								if($isha_athan == '0000-00-00 00:00:00')
									$isha_athan ='';
								if($isha_iqama == '0000-00-00 00:00:00')
									$isha_iqama ='';
								if($shurooq == '0000-00-00 00:00:00')
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="fajr_beginning">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $fajr_beginning; ?>" style="width:158px"  id="fajr_beginning" name="fajr_beginning"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                            </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Fajr Athan:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="fajr_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $fajr_athan; ?>" style="width:166px" id="fajr_athan"  name="fajr_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Fajr Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="fajr_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $fajr_iqama; ?>" style="width:158px"  id="fajr_iqama" name="fajr_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
							</td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Thuhr Beginning:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="thuhr_beginning">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $thuhr_beginning; ?>" style="width:166px" id="thuhr_beginning" name="thuhr_beginning"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Thuhr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="thuhr_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $thuhr_athan; ?>" style="width:158px" id="thuhr_athan"  name="thuhr_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                             </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Thuhr Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="thuhr_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $thuhr_iqama; ?>" style="width:166px" id="thuhr_iqama" name="thuhr_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Beginning Shafi:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_beginning_shafi">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_beginning_shafi; ?>"style="width:158px" id="asr_beginning_shafi" name="asr_beginning_shafi"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                            </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Asr Beginning Hanafi:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_beginning_hanafi">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_beginning_hanafi; ?>" style="width:166px" id="asr_beginning_hanafi" name="asr_beginning_hanafi"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_athan; ?>" style="width:158px"  id="asr_athan" name="asr_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Asr Iqama:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $asr_iqama; ?>" style="width:166px" id="asr_iqama" name="asr_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Maghrib Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="maghrib_athan">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="isha_beginning">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $isha_beginning; ?>" style="width:158px" id="isha_beginning" name="isha_beginning"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Isha Athan:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="isha_athan">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $isha_athan; ?>" style="width:166px" id="isha_athan" name="isha_athan"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                           <td height="32" width="169" align="center"><b>*Isha Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="isha_iqama">
                                 <input  class="form-control" size="16" type="text" value="<?php echo $isha_iqama; ?>" style="width:158px" id="isha_iqama" name="isha_iqama"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                           </td>
                        </tr>
                        <tr>
                           <td height="32" width="120"><b>*Shurooq:</b></td>
                           <td height="32" width="246" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="shurooq">
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
                           <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                           Add Salat Time
                           </button>		
                        </div>
                     </div>
                     <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover" id="dataTables-example" >
                              <thead>
                                 <tr>
                                    <th>Id</th>
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
                                    <th>Edit</th>
                                    <th>Delete</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                    include('conn.php');
                                    $fetch_salat_times="select * from salat_times order by id asc";	
                                    
                                    $salat_times_rs= mysqli_query($con,$fetch_salat_times);
                                                                  $i=1;
                                    while($salat_times_row = mysqli_fetch_array($salat_times_rs)) 
                                    	{
                                    	$id=$salat_times_row[0];
                                      	echo "<tr>";
                                        echo "<td><input type='hidden' name='id' value='$id'>$i</td>";
                                    	echo "<td>".$salat_times_row[1]."</td>";
                                    	echo "<td>".$salat_times_row[2]."</td>";
                                    	echo "<td>".$salat_times_row[3]."</td>";
                                    	echo "<td>".$salat_times_row[4]."</td>";
                                    	echo "<td>".$salat_times_row[5]."</td>";
                                    	echo "<td>".$salat_times_row[6]."</td>";
                                    	echo "<td>".$salat_times_row[7]."</td>";
                                    	echo "<td>".$salat_times_row[8]."</td>";
                                    	echo "<td>".$salat_times_row[9]."</td>";
                                    	echo "<td>".$salat_times_row[10]."</td>";
                                    	echo "<td>".$salat_times_row[11]."</td>";
                                    	echo "<td>".$salat_times_row[12]."</td>";
                                    	echo "<td>".$salat_times_row[13]."</td>";
                                    	echo "<td>".$salat_times_row[14]."</td>";
                                    	echo "<td>".$salat_times_row[15]."</td>";
                                    	echo "<td>".$salat_times_row[16]."</td>";
                                    	echo "<td>".$salat_times_row[17]."</td>";
                                    	echo "<td><a href='salattimes.php?id=$id&msg=edit'><img src='images/edit.png'></a></td>";
                                    	echo "<td><a href='salattimeactions.php?id=$id&msg=delete'><img src='images/cross.png'></a></td>";
                                    	echo "</tr>";
                                    	++$i;	
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="fajr_beginning">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="fajr_athan">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="fajr_athan" value="" name="fajr_athan"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Fajr Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="fajr_iqama">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="thuhr_beginning">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="thuhr_beginning" value="" name="thuhr_beginning"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Thuhr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="thuhr_athan">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="thuhr_iqama">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="thuhr_iqama" value="" name="thuhr_iqama"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Beginning Shafi:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_beginning_shafi">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_beginning_hanafi">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="asr_beginning_hanafi" value="" name="asr_beginning_hanafi"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Asr Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_athan">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="asr_iqama">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="asr_iqama" value="" name="asr_iqama"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Maghrib Athan:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="maghrib_athan">
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
                              <input  class="form-control" size="16" type="text" style="width:250px" id="maghrib_iqama" value="" name="maghrib_iqama"//>
                            </td>
                           <td height="32" width="169" align="center"><b>*Isha Beginning:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="isha_beginning">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="isha_athan">
                                 <input  class="form-control" size="16" type="text" value="" style="width:166px"/>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                 <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                              <input type="hidden" id="isha_athan" value="" name="isha_athan"/><br>
                           </td>
                           <td height="32" width="169" align="center"><b>*Isha Iqama:</b></td>
                           <td height="32" width="285" align="left">
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="isha_iqama">
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
                              <div class="input-group date form_datetime col-md-5" data-date="" data-date-format="yyyy-mm-dd HH:ii:ss" data-link-field="shurooq">
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
         $('#dataTables-example').dataTable({
         "order": [[ 0, "desc" ]],
          "scrollX": true
         });
         });
      </script>
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
      </script>
   </body>
</html>