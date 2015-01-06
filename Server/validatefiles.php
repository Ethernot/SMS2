<?php

	require_once "ssh.php";
	require_once "telnet.php";	
 	require_once "date.php";
	#returns the array of files on the given directory
	function listDirectory($dir){
		$l=scandir($dir);
		return $l;
	}

	#checks if given log already exists on directory
	function logExists($logname,$dir)
	{
		$i = 0;
		$l = listDirectory($dir);
		while ($i < count($l)) {
		if($l[$i]===$logname)
			return True;
			$i = $i + 1;
		}
		return False;
	}
	
	
	#check if logs for a certain switch are updated and updates if they are not
	function updateLogs($switchname,$ip,$username,$password,$type)
	{
		#obtains name that log is meant to have
		$logname=getLogFileName($switchname);
		//verifies if log has already been created.if it hasn't,it obtains the switche's configuration
		//and then creates this day's log.
		if(!logExists($switchname,$logname)){
			
			if($type[0]==='t')
			{					
				telnetswitch($ip,$username,$password,$switchname, 0);
			}
			if($type[0]==='s')
			{
				sshswitch($ip,$username,$password,$switchname, 0);
			}
		}
	}
?>
