<?php
require_once "PHPTelnet.php";
require_once "date.php";
require_once "mail.php";
function telnetswitch($ip, $username, $password, $switchname, $flag)
{
    $host = $ip; 
    $port = 23; 
    $waitTimeoutInSeconds = 1; 
    if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
	    $telnet = new PHPTelnet();
	    $result = $telnet->Connect($ip, $username, $password);
	    
	    mkdir("configs/" . $switchname, 0777, true);
	    if ($result == 0) {
		$telnet->DoCommand('pro', $result);
		$telnet->DoCommand('ip', $result);
		$telnet->DoCommand('interface', $result);
		$telnet->DoCommand('summary', $result);
		$telnet->DoCommand('all', $result);
		$telnet->Disconnect();
		if ($flag == 0)
		    $file = getLogFileName($switchname);
		else
		    $file = getLogFileNow($switchname);

		$myfile = fopen("configs/" . $file, "w") or die("Unable to open file!");
		fwrite($myfile, $result);
		fclose($myfile);
		$date = date("Y-m-d") . '*' . date("h:i:sa");
        	$db->saveToLogs($date."*Backup of switch " . $switchname . "by telnet with sucess");
		return 1;
	    } else {
		        $date = date("Y-m-d") . '*' . date("h:i:sa");
        		$db->saveToLogs($date."*ERROR:Backup of switch " . $switchname . " by telnet without sucess");
			sendaMail("ERROR:Backup of switch " . $switchname . "by telnet without sucess");
			return 0;
	    } 
    } else {
        $date = date("Y-m-d") . '*' . date("h:i:sa");
        $db->saveToLogs($date."*ERROR:Backup of switch " . $switchname . " by telnet without sucess");
	sendaMail("ERROR:Backup of switch " . $switchname . "by telnet without sucess");
	return 0;
    } 
    fclose($fp);
}

?> ﻿
