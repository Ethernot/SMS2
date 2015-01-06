<?php
require_once("SSH2.php");
require_once("date.php");
require_once("Database.php");

function sshswitch($ip, $username, $password, $switchname, $flag)
{
    $db = new Database();
    echo $password."<br>";
    $password = $db->getPwSha1($password);
    echo $password."<br>";
    $ssh = new SSH2($ip);
    $ssh->auth($username, $password);
    $ssh->exec("display current");
    $result = $ssh->output();
    if ($result != "") {
        mkdir("../Configs/" . $switchname, 0777, true);
        if ($flag == 0)
            $file = getLogFileName($switchname);
        else
            $file = getLogFileNow($switchname);
        $myfile = fopen("../Configs/" . $file, "w") or die("Unable to open file!");
	
        fwrite($myfile, $result);
        fclose($myfile);
        $date = date("Y-m-d") . '*' . date("h:i:sa");
        $db->saveToLogs($date."*Backup of switch " . $switchname . "by ssh with sucess");
	return 1;
    } else {
        $date = date("Y-m-d") . '*' . date("h:i:sa");
        $db->saveToLogs($date."*ERROR:Backup of switch " . $switchname . "by ssh without sucess");
	sendaMail("ERROR:Backup_of_switch_" . $switchname . "_by_ssh_without_sucess");
	return 0;
    }
}

?>
