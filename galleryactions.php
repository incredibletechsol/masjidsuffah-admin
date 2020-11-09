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
						 $filename=$_FILES["filename"]["tmp_name"];    
						 if($_FILES["filename"]["size"] > 0)
						 {
							$file = fopen($filename, "r");
							$i=0;
							  while (($getData = fgetcsv($file, 100000, ",")) !== FALSE)
							   {
							     if($i==0){
							         $i++;
							         continue;
							     }
							     
							     for($j=1;$j<=16;$j++){
							     if(strlen($getData[$j]) == 4){
							         $getData[$j]="0".$getData[$j];
							        }
							     }       
							  
                            	$prayerDate = DateTime::createFromFormat('m/d/Y', $getData[0])->format('Y-m-d');	
                      
                                checkAlreadyExists($prayerDate);
								 $query = "INSERT into salat_times(prayer_date,
									fajr_beginning,
									fajr_athan ,
									fajr_iqama ,
									thuhr_beginning,
									thuhr_athan ,
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
									   values ('".$prayerDate."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$getData[9]."','".$getData[10]."','".$getData[11]."','".$getData[12]."','".$getData[13]."','".$getData[14]."','".$getData[15]."','".$getData[16]."')";
								 $result = mysqli_query($con, $query);
							   }
						  
							   fclose($file);  
							   
							   
						 }
						 
						
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
		 
						 function checkAlreadyExists($prayerDate){
							    include("conn.php");
							       
							    $fetch_existing_details_query="SELECT * FROM salat_times where prayer_date='$prayerDate'";
                     			
                     			$existing_details_rs= mysqli_query($con,$fetch_existing_details_query);
                     			
                     		    $rowcount=mysqli_num_rows($existing_details_rs);
                     		    
                     		    if($rowcount>0){
                     		        mysqli_query($con, "delete from salat_times where prayer_date='$prayerDate'");
                     		        }
							   }
?>	

