<?php
    function sendaMail($MESSAGE)
    {
	    //YOU SHOULD EDIT THIS PART
	    $USER="fpenas@student.dei.uc.pt";
	    $PASS="oivalf92";
	    $SERVER="smtp.dei.uc.pt";
	    $RECIPIENT="fpenas@student.dei.uc.pt";
	    $SUBJECT="Switch_Error";
    	    $PORT="25";
	    $args=" ".$USER." ".$PASS." ".$SERVER." ".$RECIPIENT." ".$SUBJECT." ".$MESSAGE." ".$PORT;
	    #calls a python script to try and send the desired email message
	    $sendingSuccess=system("python mail.py".$args);
    }
    
?>
