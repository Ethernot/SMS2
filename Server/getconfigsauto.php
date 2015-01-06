<?php
require_once "validatefiles.php";

/*reads a file to obtain the configurations of each switch.
  after this,updates the configurations for each one,if needed.
*/
function updateswitches()
{

    $switches = array();
    $file = fopen("../Data/enabledSwitchList.txt", "r") or die("Unable to open file!");

    while (($line = fgets($file)) !== false) {
        $aux = explode(",", $line);
        array_push($switches, $aux);
    }
    fclose($file);

    for ($i = 0; $i < count($switches); $i++) {
        $aux = $switches[$i];
        $name = $aux[0];
        $ip = $aux[3];
        $user = $aux[4];
        $pass = $aux[5];
        $type = $aux[6];
        updateLogs($name, $ip, $user, $pass, $type);
    }
}
?>
