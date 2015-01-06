<?php
	require_once "validatefiles.php";
	require_once "getconfigsauto.php";
	$secondsWait = 30;
	header("Refresh:$secondsWait");

	$db = new Database();
	$actual = date("Y-m-d H:i");
	$actual = str_replace("pm", "", $actual);
	$actual = str_replace("am", "", $actual);
	
	$next = $db->getNextUpdate();
		
	$cmpactual = new DateTime($actual);
	$cmpnext = new DateTime($next);
	if ($cmpactual<=$cmpnext)
	{
		updateswitches();
		/*echo "ola";		
		//$db->setLastUpdate($actual);
		echo "ola";
		$next = date('m-d-Y',strtotime($date1 . "+".$db->getConfigsInterval." days"); 
		echo $next;
		//$db->setNextUpdate($actual);*/
	}
	//date('m-d-Y',strtotime($date1 . "+".$db->getConfigsInterval." days"));
?>
