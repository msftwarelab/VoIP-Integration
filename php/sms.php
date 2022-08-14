<?php
    // Include the Twilio PHP library
    require 'Services/Twilio.php';
    
    $body = $_REQUEST['Body'];
    $from = $_REQUEST['From'];
     
    // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
    require "keys.php";
     
    // Instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
    
    if (strpos($body, "CALLME_GDGTEST") === 0) {
	    header("content-type: text/xml");
	    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	    echo "<Response><Sms>MP3 " . $mp3url . "</Sms></Response>";
	}
	else if (strpos($body, "CALLME") === 0) {
	    try {
	        // Initiate a new outbound call
    	    $call = $client->account->calls->create(
        	    $twilionumber, 
	            $from, // The number of the phone receiving call
    	        $baseurl . "/playmp3twiml.php?url=" . $mp3url // The URL Twilio will request when the call is answered
        	);
	    } catch (Exception $e) {
    	    echo 'Error: ' . $e->getMessage();
	    }
    }
    else if (strpos($body, "MP3") === 0) {
	    try {
    		$inputs = explode(" ", $body);
    		$mp3url = $inputs[1];
    	
	        // Initiate a new outbound call
    	    $call = $client->account->calls->create(
        	    $twilionumber, 
	            $from, // The number of the phone receiving call
    	        $baseurl . "/playmp3twiml.php?url=" . $mp3url // The URL Twilio will request when the call is answered
        	);
	    } catch (Exception $e) {
    	    echo 'Error: ' . $e->getMessage();
	    }
    }
    else if (strpos($body, "ERR") === 0) {
    	// ignore this so we don't get in an endless conversation with ourselves
    }
    else {
	    header("content-type: text/xml");
	    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	    echo "<Response><Sms>ERR Sorry I didn't understand:" . $body . "</Sms></Response>";
    }
 
?>