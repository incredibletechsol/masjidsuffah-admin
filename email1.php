<?php include('logincommon.php'); 
   ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta charset="utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> <?php include('title.php'); ?></title>
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
      <script src="assets/js/bootstrap.min.js"></script>
      <style>
          .demoInputBox {
        	padding: 10px;
        	border: #F0F0F0 1px solid;
        	border-radius: 4px;
        	background-color: #FFF;
        	width: 100%;
        }
        
        .demoInputBox:focus {
            outline:none;
        }
  
       .btn-primary, .btn-primary:hover, .btn-primary:active, .btn-primary:visited {
        background-color: #e67e22 !important;
        }
        .btn {
          outline-color: #e67e22 !important;
        }
    </style>
      <script>
      
         function getSubscribersList(str) {
           if (str == "") {
             document.getElementById("txtHint").innerHTML = "";
             document.getElementById("editorHint").style.display = "none";
             return;
           } else {
             var xmlhttp = new XMLHttpRequest();
             xmlhttp.onreadystatechange = function() {
               if (this.readyState == 4 && this.status == 200) {
                 document.getElementById("txtHint").innerHTML = this.responseText;
                 document.getElementById("editorHint").style.display = "block";
               }
             };
             xmlhttp.open("GET","getmailinglists.php?listid="+str,true);
             document.getElementById("listid").value=str;
              document.getElementById("listid1").value=str;
             xmlhttp.send();
           }
         }
      </script>
      <script src="js/editor.js"></script>
      <script>
      
         $(document).ready(function() {
         	$("#txtEditor").Editor();
         });
         
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
			 if (form.newemail.value == "") {
				error_email.innerHTML ="<img src='images/delete.gif' border='0'>&nbsp;&nbsp;Please enter Subscriber Email Id";
				setTimeout(function () {error_email.innerHTML =""}, 10000);
				valid = false;
			  } else {
				error_email.innerHTML ="";
				setColor(form.newemail, bgGood);
			  }
			
			return valid;
		}	
	
         
         function sendMail(){
             
                      document.editorform.hideit.value  = $("#txtEditor").Editor("getText");
                      document.editorform.action="emailactions.php?msg=sendNewsLetter";
             	      document.editorform.submit();	
          		   
                  }
                  
        function saveSubscriber()
          		{
          		var b=new Boolean();	
          		b=checkInput(document.addsubsciber);
          		if (!b) 
          			{
          			ERROR.innerHTML ="<h4><img src='images/cross.png' border='0'>&nbsp;&nbsp;Error : Please correct the fields and try submitting again</h4>";
          			setTimeout(function () {ERROR.innerHTML =""}, 12000);
          			}
          		else
          			{
          			document.addsubsciber.action="emailactions.php?msg=saveSubscriber";
          			document.addsubsciber.submit();			
          			}
          			
          		}
         
      </script>
      <link href="css/editor.css" type="text/css" rel="stylesheet"/>
   </head>
   <body>
      <div id="wrapper">
         <?php include('nav.php'); ?>
         <!-- /. NAV SIDE  -->
         <div id="page-wrapper" >
            <div id="page-inner">
               <div class="col-md-12">
                  <!-- Advanced Tables -->
                
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <form name="lstAudFrm" method="post" action="email.php">
                           <?php
                              $api_key = 'cc1a11e92cfb2ca47047006d3693f187-us11';
                         
                              $data = array('fields' => 'lists');
                               
                              $url = 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/';
                              $result = json_decode( rudr_mailchimp_curl_connect( $url, 'GET', $api_key, $data) );
                              
                              if( !empty($result->lists) ) {
                              	echo '<select name="listid"  class="form-control" style="width: 250px;">';
                              	echo '<option value="">Select Mailing List</option>';
                              	foreach( $result->lists as $list ){
                              		echo '<option value="' . $list->id . '">' . $list->name . ' (' . $list->stats->member_count . ')</option>';
                               	}
                              	echo '</select>';
                              } elseif ( is_int( $result->status ) ) { 
                              	echo '<strong>' . $result->title . ':</strong> ' . $result->detail;
                              }
                              
                          ?>  
                        <input type="submit" name="getsubscribers" class="btn btn-primary btn-lg" value="Get All Subscribers" />    
                        </form>
                        <div align='right'>
                           <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                           Add Subscriber
                           </button>		
                        </div>
                     </div>
                     <div class="panel-body">
                        <div class="table-responsive">
                           <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                              <thead>
                                 <tr>
                                    <th>Delete</th>
                                    <th>Email Id</th>
                                 </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  if (isset($_POST['getsubscribers'])) 
                                        {
                                            $api_key = 'cc1a11e92cfb2ca47047006d3693f187-us11';
                                            $list_id = $_POST['listid'];
                                    
                                            
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
                                             
                                            
                                          
                                         foreach ($emails as $key => $val) {
                                               	echo "<tr>";
                                               	echo "<td><a href='emailactions.php?listid=$list_id&email=$val&msg=delete'><img src='images/cross.png'></a></td>";
                                        		echo "<td>".$val."</td>";
                                    			echo "</tr>";
                                            }    
                                        ?>
                                        <script> document.getElementById("editorHint").style.display = "block";</script>
                                        <?php
                                        }
                                  ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="row" id="editorHint">
                     <form name="editorform" method="post" enctype='multipart/form-data'>
                        <div class="col-lg-12 nopadding">
                               <label>Attachment</label><br /> <input type="file"
                            name="attachment[]" class="demoInputBox" multiple="multiple">
							<?php
							include('conn.php');
							$fetch_basic_profile="select * from store_data where id=4";	

							$basic_profile_rs= mysqli_query($con,$fetch_basic_profile);

							while($basic_profile_row = mysqli_fetch_array($basic_profile_rs)) 
								{
								$id=$basic_profile_row[0];
								$text = $basic_profile_row[1];
								} 
							?>
                           <textarea id="txtEditor" name="txtEditor">
							

                           </textarea> 
                             <DIV id="error_txtEditor" style="color:red;"></DIV>
                           <input type="hidden" id="listid" name="listid" value="<? echo $list_id ?>">
                           <input type="hidden" name="hideit">
                        </div>
                        <div align="right"><input type="submit" name="submit" value="Send" onClick="sendMail()" class="btn btn-primary btn-lg"/></div>
                     </form>
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
                  <h4 class="modal-title" id="myModalLabel">Add Subscriber</h4>
               </div>
               <div class="modal-body">
                  <DIV id="ERROR" style="color:red;font-weight:bold;"></DIV>
                  <form name="addsubsciber" method="post">
                     <table border="0" width="447" height="40">
                        <tr>
                           <td height="34" width="180" valign="top"><b>*Mailing List</b></td>
                           <td height="34" width="7" valign="top"><b>:</b></td>
                           <td height="34" width="238">
                              <?php
                                 if( !empty($result->lists) ) {
                                   	echo '<select name="listid1" class="form-control" style="width: 250px;">';
                                   	foreach( $result->lists as $list ){
                                   		echo '<option value="' . $list->id . '">' . $list->name . ' (' . $list->stats->member_count . ')</option>';
                                   	}
                                   	echo '</select>';
                                   } elseif ( is_int( $result->status ) ) { 
                                   	echo '<strong>' . $result->title . ':</strong> ' . $result->detail;
                                   }
                                 ?>
                           </td>
                        </tr>
                        <tr>
                           <td height="34" width="180" valign="top"><b>*Subscriber Email</b></td>
                           <td height="34" width="7" valign="top"><b>:</b></td>
                           <td height="34" width="238">
                              <input name="newemail" type="text" class="form-control" id="newemail" />
                              <br>
                              <DIV id="error_email" style="color:red;"></DIV>
                           </td>
                        </tr>
                     </table>

                  </form>
               </div>
               <div class="modal-footer">
                  <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                  <a href="#" class="btn btn-primary"  onClick="saveSubscriber();">Save</a>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/dataTables/jquery.dataTables.js"></script>
      <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <script>
         $(document).ready(function () {
             $('#dataTables-example').dataTable();
             $('#txtEditor').Editor("setText", "<?php echo addslashes($text);?>");
         });

      </script>
   </body>
</html>


<?php
  
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