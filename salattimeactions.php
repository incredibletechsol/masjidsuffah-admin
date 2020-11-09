<script src="assets/js/jquery-1.10.2.js"></script>
<?php
include("conn.php");
?>
<style>
	
	.img-500
		{
		height : 100px;
		width  : 100px;
		}
		
		#mask {
		  position:absolute;
		  left:0;
		  top:0;
		  z-index:99998;
		  background-color: #4D4D4D;
		  display:none;
		}  
		
		#boxes .window
		{
		  position:absolute;
		  left:0;
		  top:0;
		  width:350px;
		  height:150px;
		  display:none;
		  z-index:99999;
		  padding:10px;
		  -moz-border-radius: 10px;
		  -webkit-border-radius: 10px;
		  border-radius: 10px;
		  border: 4px solid #333333;
		  
		  -moz-box-shadow:4px 4px 30px #130507;
			-webkit-box-shadow:4px 4px 30px #130507;
		  box-shadow:4px 4px 30px #130507;
			-moz-transition:top 800ms;
			-o-transition:top 800ms;
			-webkit-transition:top 800ms;
		  transition:top 800ms;
		  margin-left : 0px;
		}
		
		#boxes #dialog
		{
		  width:350px; 
		  height:150px;
		  padding:0px;
		  background-color: #FFFFFF;
		}	
		
	</style>
<!-- Insert Code -->	
<?php
	if(isset($_GET['msg']))
		{
			$param=$_GET['msg'];
			if($param == "save")
				{
				if(!$_POST['prayerDate']=='')
					$prayerDate = $_POST['prayerDate'];
				else
					$prayerDate =  '0000-00-00';
				
				if(!$_POST['fajr_beginning'] =='')
					$fajr_beginning = $_POST['fajr_beginning'];
				else
					$fajr_beginning =  '00:00';
				
				if(!$_POST['fajr_athan'] == '')
					$fajr_athan = $_POST['fajr_athan'];
				else
					$fajr_athan = '00:00';
				
				if(!$_POST['fajr_iqama']== '')
					$fajr_iqama = $_POST['fajr_iqama'];
				else
					$fajr_iqama = '00:00';
			
				if(!$_POST['thuhr_beginning']== '')
					$thuhr_beginning = $_POST['thuhr_beginning'];
				else
					$thuhr_beginning = '00:00';
				
				if(!$_POST['thuhr_athan']== '')
					$thuhr_athan = $_POST['thuhr_athan'];
				else
					$thuhr_athan = '00:00';
				
				if(!$_POST['thuhr_iqama']== '')
					$thuhr_iqama = $_POST['thuhr_iqama'];
				else
					$thuhr_iqama = '00:00';
				
				if(!$_POST['asr_beginning_shafi']== '')
					$asr_beginning_shafi = $_POST['asr_beginning_shafi'];
				else
					$asr_beginning_shafi = '00:00';
				
				if(!$_POST['asr_beginning_hanafi']== '')
					$asr_beginning_hanafi = $_POST['asr_beginning_hanafi'];
				else
					$asr_beginning_hanafi = '00:00';
				
				if(!$_POST['asr_athan']== '')
					$asr_athan = $_POST['asr_athan'];
				else
					$asr_athan = '00:00';
				
				if(!$_POST['asr_iqama']== '')
					$asr_iqama = $_POST['asr_iqama'];
				else
					$asr_iqama = '00:00';
				
				if(!$_POST['maghrib_athan']== '')
					$maghrib_athan = $_POST['maghrib_athan'];
				else
					$maghrib_athan = '00:00';
	
				if(!$_POST['maghrib_iqama']== '')
					$maghrib_iqama = $_POST['maghrib_iqama'];
				else
					$maghrib_iqama = '';
				
				
				if(!$_POST['isha_beginning']== '')
					$isha_beginning = $_POST['isha_beginning'];
				else
					$isha_beginning = '00:00';
				
				
				if(!$_POST['isha_athan']== '')
					$isha_athan = $_POST['isha_athan'];
				else
					$isha_athan = '00:00';
								
				if(!$_POST['isha_iqama']== '')
					$isha_iqama = $_POST['isha_iqama'];
				else
					$isha_iqama = '00:00';

				if(!$_POST['shurooq']== '')
					$shurooq = $_POST['shurooq'];
				else
					$shurooq = '00:00';
					
				$faculty_insert = "INSERT INTO salat_times(
						fajr_beginning,
						fajr_athan ,
						fajr_iqama ,
						thuhr_beginning,
						thuhr_athan ,
						prayer_date ,
						thuhr_iqama ,
						asr_beginning_shafi,
						asr_beginning_hanafi,
						asr_athan ,
						asr_iqama, 
						maghrib_athan, 
						maghrib_iqama ,
						isha_beginning, 
						isha_athan ,
						isha_iqama ,
						shurooq ) 
						values(
						'$fajr_beginning',
						'$fajr_athan',
						'$fajr_iqama',
						'$thuhr_beginning',
						'$thuhr_athan',
						'$prayerDate',
						'$thuhr_iqama',
						'$asr_beginning_shafi',
						'$asr_beginning_hanafi',
						'$asr_athan',
						'$asr_iqama',
						'$maghrib_athan', 
						'$maghrib_iqama',
						'$isha_beginning',
						'$isha_athan',
						'$isha_iqama',
						'$shurooq')";
			
				mysqli_query($con,$faculty_insert) or die(mysqli_error($con));
						
				?>
				
				<script type="text/javascript">
				$(document).ready(function() {	
			
					var id = '#dialog';
				
					//Get the screen height and width
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
				
					//Set heigth and width to mask to fill up the whole screen
					$('#mask').css({'width':maskWidth,'height':maskHeight});
					
					//transition effect		
					$('#mask').fadeIn(800);	
					$('#mask').fadeTo("slow",0.8);	
				
					//Get the window height and width
					var winH = $(window).height();
					var winW = $(window).width();
						  
					//Set the popup window to center
					$(id).css('top',  winH/2-$(id).height()/2 -50);
					$(id).css('left', winW/2-$(id).width()/2);
				
					//transition effect
					$(id).fadeIn(500); 	
				
				//if close button is clicked
				$('.window .close').click(function (e) {
					//Cancel the link behavior
					e.preventDefault();
					
					$('#mask').hide();
					$('.window').hide();
				});		
				
				//if mask is clicked
				$('#mask').click(function () {
					$(this).preventDefault();
					$(this).hide();
					$('.window').hide();
				});		
				
			});
	
			</script>
		<div id="boxes">
				<div style="top:150px; left: 551.5px; display: none;" id="dialog" class="window">
					<div align="right" style="font-weight:bold; margin:5px 3px 0 0;">
					<?php
					echo "<a href='salattimes.php'><img src='images/cross.png' width='16' style='border:none; cursor:pointer;' /></a>";
					?>
					</div>
					
					<div align="center" style="margin:5px 0 5px 0;">
					
						<?php 
						echo "<p align='center'><h4><img src='images/Correct.png'>&nbsp;&nbsp;Salat Time Saved Successfully.</h4></p>"; 
						?>
					
					</div>
					
				</div>
			
				<!-- Mask to cover the whole screen -->
				<div style="width: 2000px; height: 2000px; display: none; opacity: 0.7;" id="mask"></div>
				</div>
				
				<?php
				}
		}
?>	
<!-- Delete Code -->
<?php
	if(isset($_GET['msg']))
		{
			$param=$_GET['msg'];
			if($param == "delete")
				{
				$id = $_GET['id'];
				$salat_delete = "delete from salat_times where id='$id'";
				mysqli_query($con,$salat_delete) or die(mysqli_error($con));
				?>
				
				<script type="text/javascript">
				$(document).ready(function() {	
			
					var id = '#dialog';
				
					//Get the screen height and width
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
				
					//Set heigth and width to mask to fill up the whole screen
					$('#mask').css({'width':maskWidth,'height':maskHeight});
					
					//transition effect		
					$('#mask').fadeIn(800);	
					$('#mask').fadeTo("slow",0.8);	
				
					//Get the window height and width
					var winH = $(window).height();
					var winW = $(window).width();
						  
					//Set the popup window to center
					$(id).css('top',  winH/2-$(id).height()/2 -50);
					$(id).css('left', winW/2-$(id).width()/2);
				
					//transition effect
					$(id).fadeIn(500); 	
				
				//if close button is clicked
				$('.window .close').click(function (e) {
					//Cancel the link behavior
					e.preventDefault();
					
					$('#mask').hide();
					$('.window').hide();
				});		
				
				//if mask is clicked
				$('#mask').click(function () {
					$(this).preventDefault();
					$(this).hide();
					$('.window').hide();
				});		
				
			});
	
			</script>
		<div id="boxes">
				<div style="top:150px; left: 551.5px; display: none;" id="dialog" class="window">
					<div align="right" style="font-weight:bold; margin:5px 3px 0 0;">
					<?php
					echo "<a href='salattimes.php'><img src='images/cross.png' width='16' style='border:none; cursor:pointer;' /></a>";
					?>
					</div>
					
					<div align="center" style="margin:5px 0 5px 0;">
					
						<?php 
						echo "<p align='center'><h4><img src='images/Correct.png'>&nbsp;&nbsp;Salat Time Deleted Successfully.</h4></p>"; 
						?>
					
					</div>
					
				</div>
			
				<!-- Mask to cover the whole screen -->
				<div style="width: 2000px; height: 2000px; display: none; opacity: 0.7;" id="mask"></div>
				</div>
				
				<?php
				}
		}
?>	
<!-- Update Code -->
<?php
	if(isset($_GET['msg']))
		{
			$param=$_GET['msg'];
			if($param == "update")
				{	
				$id = $_POST['id'];
				
				if(!$_POST['prayerDate']  == '')
					$prayerDate = $_POST['prayerDate'];
				else
					$prayerDate =  '00:00';
				
				if(!$_POST['fajr_beginning'] =='')
					$fajr_beginning = $_POST['fajr_beginning'];
				else
					$fajr_beginning =  '00:00';
				
				if(!$_POST['fajr_athan'] == '')
					$fajr_athan = $_POST['fajr_athan'];
				else
					$fajr_athan = '00:00';
				
				if(!$_POST['fajr_iqama']== '')
					$fajr_iqama = $_POST['fajr_iqama'];
				else
					$fajr_iqama = '00:00';
			
				if(!$_POST['thuhr_beginning']== '')
					$thuhr_beginning = $_POST['thuhr_beginning'];
				else
					$thuhr_beginning = '00:00';
				
				if(!$_POST['thuhr_athan']== '')
					$thuhr_athan = $_POST['thuhr_athan'];
				else
					$thuhr_athan = '00:00';
				
				if(!$_POST['thuhr_iqama']== '')
					$thuhr_iqama = $_POST['thuhr_iqama'];
				else
					$thuhr_iqama = '00:00';
				
				if(!$_POST['asr_beginning_shafi']== '')
					$asr_beginning_shafi = $_POST['asr_beginning_shafi'];
				else
					$asr_beginning_shafi = '00:00';
				
				if(!$_POST['asr_beginning_hanafi']== '')
					$asr_beginning_hanafi = $_POST['asr_beginning_hanafi'];
				else
					$asr_beginning_hanafi = '00:00';
				
				if(!$_POST['asr_athan']== '')
					$asr_athan = $_POST['asr_athan'];
				else
					$asr_athan = '00:00';
				
				if(!$_POST['asr_iqama']== '')
					$asr_iqama = $_POST['asr_iqama'];
				else
					$asr_iqama = '00:00';
				
				if(!$_POST['maghrib_athan']== '')
					$maghrib_athan = $_POST['maghrib_athan'];
				else
					$maghrib_athan = '00:00';
	
				if(!$_POST['maghrib_iqama']== '')
					$maghrib_iqama = $_POST['maghrib_iqama'];
				else
					$maghrib_iqama = '';
								
				if(!$_POST['isha_beginning']== '')
					$isha_beginning = $_POST['isha_beginning'];
				else
					$isha_beginning = '00:00';
								
				if(!$_POST['isha_athan']== '')
					$isha_athan = $_POST['isha_athan'];
				else
					$isha_athan = '00:00';
								
				if(!$_POST['isha_iqama']== '')
					$isha_iqama = $_POST['isha_iqama'];
				else
					$isha_iqama = '00:00';

				if(!$_POST['shurooq']== '')
					$shurooq = $_POST['shurooq'];
				else
					$shurooq = '00:00';
				
				$salat_update = "UPDATE salat_times 
								SET 
								prayer_date  = '$prayerDate',
								fajr_beginning = '$fajr_beginning', 
								fajr_athan  = '$fajr_athan',  
								fajr_iqama  = '$fajr_iqama',  
								thuhr_beginning  = '$thuhr_beginning',  
								thuhr_athan  = '$thuhr_athan',  
								thuhr_iqama  = '$thuhr_iqama',  
								asr_beginning_shafi  = '$asr_beginning_shafi',  
								asr_beginning_hanafi  = '$asr_beginning_hanafi',  
								asr_athan  = '$asr_athan',  
								asr_iqama  = '$asr_iqama',  
								maghrib_athan  = '$maghrib_athan',   
								maghrib_iqama  = '$maghrib_iqama',  
								isha_beginning  = '$isha_beginning',  
								isha_athan  = '$isha_athan',  
								isha_iqama  = '$isha_iqama',  
								shurooq = '$shurooq'
								where id='$id'
								";
				
				mysqli_query($con,$salat_update) or die(mysqli_error($con)); 
				
				?>
				
				<script type="text/javascript">
				$(document).ready(function() {	
			
					var id = '#dialog';
				
					//Get the screen height and width
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
				
					//Set heigth and width to mask to fill up the whole screen
					$('#mask').css({'width':maskWidth,'height':maskHeight});
					
					//transition effect		
					$('#mask').fadeIn(800);	
					$('#mask').fadeTo("slow",0.8);	
				
					//Get the window height and width
					var winH = $(window).height();
					var winW = $(window).width();
						  
					//Set the popup window to center
					$(id).css('top',  winH/2-$(id).height()/2 -50);
					$(id).css('left', winW/2-$(id).width()/2);
				
					//transition effect
					$(id).fadeIn(500); 	
				
				//if close button is clicked
				$('.window .close').click(function (e) {
					//Cancel the link behavior
					e.preventDefault();
					
					$('#mask').hide();
					$('.window').hide();
				});		
				
				//if mask is clicked
				$('#mask').click(function () {
					$(this).preventDefault();
					$(this).hide();
					$('.window').hide();
				});		
				
			});
	
			</script>
		<div id="boxes">
				<div style="top:150px; left: 551.5px; display: none;" id="dialog" class="window">
					<div align="right" style="font-weight:bold; margin:5px 3px 0 0;">
					<?php
					echo "<a href='salattimes.php'><img src='images/cross.png' width='16' style='border:none; cursor:pointer;' /></a>";
					?>
					</div>
					
					<div align="center" style="margin:5px 0 5px 0;">
					
						<?php 
						echo "<p align='center'><h4><img src='images/Correct.png'>&nbsp;&nbsp;Salat Time Updated Successfully.</h4></p>"; 
						?>
					
					</div>
					
				</div>
			
				<!-- Mask to cover the whole screen -->
				<div style="width: 2000px; height: 2000px; display: none; opacity: 0.7;" id="mask"></div>
				</div>
				
				<?php
				}
		}
?>		
<!-- Update Hijri Days -->
<?php
	if(isset($_GET['msg']))
		{
			$param=$_GET['msg'];
			if($param == "updatehijridays")
				{	
			    $days = $_POST['days'];    
				
				$days_update = "UPDATE configuration 
							    	SET 
								config_value  = '$days'
								where config_name='hijri_adjust_days'
								";
				
				mysqli_query($con,$days_update) or die(mysqli_error($con)); 
				
				?>
				
				<script type="text/javascript">
				$(document).ready(function() {	
			
					var id = '#dialog';
				
					//Get the screen height and width
					var maskHeight = $(document).height();
					var maskWidth = $(window).width();
				
					//Set heigth and width to mask to fill up the whole screen
					$('#mask').css({'width':maskWidth,'height':maskHeight});
					
					//transition effect		
					$('#mask').fadeIn(800);	
					$('#mask').fadeTo("slow",0.8);	
				
					//Get the window height and width
					var winH = $(window).height();
					var winW = $(window).width();
						  
					//Set the popup window to center
					$(id).css('top',  winH/2-$(id).height()/2 -50);
					$(id).css('left', winW/2-$(id).width()/2);
				
					//transition effect
					$(id).fadeIn(500); 	
				
				//if close button is clicked
				$('.window .close').click(function (e) {
					//Cancel the link behavior
					e.preventDefault();
					
					$('#mask').hide();
					$('.window').hide();
				});		
				
				//if mask is clicked
				$('#mask').click(function () {
					$(this).preventDefault();
					$(this).hide();
					$('.window').hide();
				});		
				
			});
	
			</script>
		<div id="boxes">
				<div style="top:150px; left: 551.5px; display: none;" id="dialog" class="window">
					<div align="right" style="font-weight:bold; margin:5px 3px 0 0;">
					<?php
					echo "<a href='hijri.php'><img src='images/cross.png' width='16' style='border:none; cursor:pointer;' /></a>";
					?>
					</div>
					
					<div align="center" style="margin:5px 0 5px 0;">
					
						<?php 
						echo "<p align='center'><h4><img src='images/Correct.png'>&nbsp;&nbsp;Hijri Days Updated Successfully.</h4></p>"; 
						?>
					
					</div>
					
				</div>
			
				<!-- Mask to cover the whole screen -->
				<div style="width: 2000px; height: 2000px; display: none; opacity: 0.7;" id="mask"></div>
				</div>
				
				<?php
				}
		}
?>