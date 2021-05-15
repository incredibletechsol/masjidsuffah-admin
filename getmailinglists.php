
<?php

$api_key = 'cc1a11e92cfb2ca47047006d3693f187-us11';
$list_id = $_GET['listid'];

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

 
		<?php
	
        foreach ($emails as $key => $val) {
           	echo "<tr>";
           	echo "<td><a href='emailactions.php?listid=$list_id&email=$val&msg=delete'><img src='images/cross.png'></a></td>";
    		echo "<td>".$val."</td>";
			echo "</tr>";
        }

		?>



