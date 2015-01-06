<?php
require_once "PHPTelnet.php";
require_once "date.php";
require_once "mail.php";
require_once "Database.php";
function telnetswitch($ip, $username, $password, $switchname, $flag)
{
    $host = $ip; 
    $port = 23; 
    $waitTimeoutInSeconds = 1; 
    $db = new Database(); 
    if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){   
	    $telnet = new PHPTelnet();
	    $password = $db->getPwSha1($password);
	    $result = $telnet->Connect($ip, $username, $password);
	    mkdir("../Configs/" . $switchname, 0777, true);
	    if ($result == 0) {
		$telnet->DoCommand('pro', $result);
		$telnet->DoCommand('ip', $result);
		$telnet->DoCommand('interface', $result);
		$telnet->DoCommand('summary', $result);
		$telnet->DoCommand('all', $result);
		if ($flag == 0)
		    $file = getLogFileName($switchname);
		else
		    $file = getLogFileNow($switchname);

		$myfile = fopen("../Configs/". $file, "w") or die("Unable to open file!");
		fwrite($myfile, $result);
		fclose($myfile);
		$date = date("Y-m-d") . '*' . date("H:i:sa");
		$date = str_replace("pm", "", $date);
		$date = str_replace("am", "", $date);
        	$db->saveToLogs($date."*Backup of switch " . $switchname . "by telnet with sucess");
		return 1;
	    } else {
		        $date = date("Y-m-d") . '*' . date("H:i:sa");
			$date = str_replace("pm", "", $date);
			$date = str_replace("am", "", $date);
        		$db->saveToLogs($date."*ERROR:Backup of switch " . $switchname . " by telnet without sucess");
			sendaMail("ERROR:Backup_of_switch_" . $switchname . "_by_telnet_without_sucess");
			return 0;
	    } 
    } else {
        $date = date("Y-m-d") . '*' . date("H:i:sa");
	$date = str_replace("pm", "", $date);
	$date = str_replace("am", "", $date);
        $db->saveToLogs($date."*ERROR:Backup of switch " . $switchname . " by telnet without sucess");
	sendaMail("ERROR:Backup_of_switch_" . $switchname . "_by_telnet_without_sucess");
	return 0;
    } 
    $telnet->Disconnect();
    fclose($fp);
}

?> ﻿
