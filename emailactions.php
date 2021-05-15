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
			if($param == "sendNewsLetter")
				{
				include('phpmailer/class.phpmailer.php');    
			    $body = $_POST['hideit'];
			    $listid=$_POST['listid'];
				
				include("conn.php");
				
			//	$gallery_insert = "INSERT INTO store_data(text) values('$body')";
			$gallery_insert = "update store_data set text='$body' where id=4";
				mysqli_query($con,$gallery_insert) or die(mysqli_error($con));
		
			    $email = new PHPMailer();
    	        $email->From      = 'info@masjidsuffah.com';
    	        $email->FromName  = 'Masjid Suffah';
    	        $email->Subject   ="News Letter";
    	        $email->IsHTML(true);
    	    
    	        $email->Body      = $body;
    	        
    	        foreach ($_FILES["attachment"]["name"] as $k => $v) {
                     $email->addAttachment( $_FILES["attachment"]["tmp_name"][$k], $_FILES["attachment"]["name"][$k] );
                    }
    	  
    	        $emails = getMailingList($listid);
    	        
    	        foreach ($emails as $key => $val) {
                  $email->addBCC($val);
                }
      
    	       // $b=$email->Send();
    	       
      	        if($b)
    	          echo "Mail Sent";
    	        else
    	          echo  "Mail not sent";
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
					echo "<a href='email.php'><img src='images/cross.png' width='16' style='border:none; cursor:pointer;' /></a>";
					?>
					</div>
					
					<div align="center" style="margin:5px 0 5px 0;">
					
						<?php 
						echo "<p align='center'><h4><img src='images/Correct.png'>&nbsp;&nbsp;News Letter Sent Successfully.</h4></p>"; 
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
				   $list_id  = $_GET['listid'];
			       $email  = $_GET['email'];
			
                  $api_key = 'cc1a11e92cfb2ca47047006d3693f187-us11';
 
                    $data_center = substr($api_key,strpos($api_key,'-')+1);
                     
                    $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id .'/members/'. md5(strtolower($email));
                     
                    try {
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        $result = curl_exec($ch);
                        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        curl_close($ch);
                         if (200 == $status_code) {
                            echo "The user deleted successfully from the MailChimp.";
                         }
                    } catch(Exception $e) {
                        echo $e->getMessage();
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
					echo "<a href='email.php'><img src='images/cross.png' width='16' style='border:none; cursor:pointer;' /></a>";
					?>
					</div>
					
					<div align="center" style="margin:5px 0 5px 0;">
					
						<?php 
						echo "<p align='center'><h4><img src='images/Correct.png'>&nbsp;&nbsp;Subscriber Deleted Successfully.</h4></p>"; 
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

<!-- Add Code -->
<?php
	if(isset($_GET['msg']))
		{
			$param=$_GET['msg'];
			if($param == "saveSubscriber")
				{
				   $list_id1  = $_POST['listid1'];
			       $email  = $_POST['newemail'];
		           $api_key = 'cc1a11e92cfb2ca47047006d3693f187-us11';
		           
                    $data_center = substr($api_key,strpos($api_key,'-')+1);
                     
                    $url = 'https://'. $data_center .'.api.mailchimp.com/3.0/lists/'. $list_id1 .'/members';
                     
                    $json = json_encode([
                        'email_address' => $email,
                        'status'        => 'subscribed', //pass 'subscribed' or 'pending'
                    ]);
                     
                    try {
                        $ch = curl_init($url);
                        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $api_key);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
                        $result = curl_exec($ch);
                        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        curl_close($ch);
                     
                        if (200 == $status_code) {
                            echo "The user added successfully to the MailChimp.";
                        }
                    } catch(Exception $e) {
                        echo $e->getMessage();
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
					echo "<a href='email.php'><img src='images/cross.png' width='16' style='border:none; cursor:pointer;' /></a>";
					?>
					</div>
					
					<div align="center" style="margin:5px 0 5px 0;">
					
						<?php 
						echo "<p align='center'><h4><img src='images/Correct.png'>&nbsp;&nbsp;Subscriber Added Successfully.</h4></p>"; 
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

<?php
	function getMailingList($list_id) {
       	
           	$api_key = 'cc1a11e92cfb2ca47047006d3693f187-us11';

            $dc = substr($api_key,strpos($api_key,'-')+1); // us5, us8 etc
             
            // URL to connect
            $url = 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id;
             
            // connect and get results
            $body = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key ) );
             
            // number of members in this list
            $member_count = $body->stats->member_count;
            $emails = array();
             
            for( $offset = 0; $offset < $member_count; $offset += 50 ) :
             
            	$data = array(
            		'offset' => $offset,
            		'count'  => 50
            	);
             
            	// URL to connect
            	$url = 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'.$list_id.'/members';
             
            	// connect and get results
            	$body = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key, $data ) );
             
             	foreach ( $body->members as $member ) {
            		$emails[] = $member->email_address;
            	}
             
            endfor;
            return  $emails;
       	}


    function rudr_mailchimp_curl_connect( $url, $request_type, $api_key, $data = array() ) {
    	if( $request_type == 'GET' )
    		$url .= '?' . http_build_query($data);
     
    	$mch = curl_init();
    	$headers = array(
    		'Content-Type: application/json',
    		'Authorization: Basic '.base64_encode( 'user:'. $api_key )
    	);
    	curl_setopt($mch, CURLOPT_URL, $url );
    	curl_setopt($mch, CURLOPT_HTTPHEADER, $headers);
    	//curl_setopt($mch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    	curl_setopt($mch, CURLOPT_RETURNTRANSFER, true); // do not echo the result, write it into variable
    	curl_setopt($mch, CURLOPT_CUSTOMREQUEST, $request_type); // according to MailChimp API: POST/GET/PATCH/PUT/DELETE
    	curl_setopt($mch, CURLOPT_TIMEOUT, 10);
    	curl_setopt($mch, CURLOPT_SSL_VERIFYPEER, false); // certificate verification for TLS/SSL connection
     
    	if( $request_type != 'GET' ) {
    		curl_setopt($mch, CURLOPT_POST, true);
    		curl_setopt($mch, CURLOPT_POSTFIELDS, json_encode($data) ); // send data in json
    	}
     
    	return curl_exec($mch);
    }
?>
	