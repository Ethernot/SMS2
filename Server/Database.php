<?php
date_default_timezone_set('Europe/London');

/**
 * Created by IntelliJ IDEA.
 * User: Diogo
 * Date: 28-Dec-14
 * Time: 19:13
 */
class Database
{
    public $availableModels;
    public $enabledSwitchs;
    public $disabledSwitchs;
    public $configsInterval;
    public $nextUpdate;
    public $lastUpdate;
    public $maxLife;


    function __construct()
    {
        $this->availableModels = array();
        $this->enabledSwitchs = array();
        $this->disabledSwitchs = array();
        $this->loadInfo();
    }

    function loadInfo()
    {
        $file = fopen("../Data/switchList.txt", "r") or die("Unable to open file!");
        $info = "";
        while (!feof($file)) {
            $info .= fgets($file);
        }
        fclose($file);
        foreach (explode("\n", $info) as $s) {
            $switch = explode("-", $s);
            error_reporting(0);
            $this->availableModels[$switch[0]] .= $switch[1];
            error_reporting(1);
        }

        if (file_exists('../Data/enabledSwitchList.txt')) {
            $file = fopen("../Data/enabledSwitchList.txt", "r") or die("Unable to open file!");
            $info = "";
            while (!feof($file)) {
                $info .= fgets($file);
            }
            fclose($file);
            foreach (explode("\n", $info) as $s) {
                if (strlen($s) > 1) {
                    array_push($this->enabledSwitchs, $s);
                }
            }
        }

        if (file_exists('../Data/disabledSwitchList.txt')) {
            $file = fopen("../Data/disabledSwitchList.txt", "r") or die("Unable to open file!");
            $info = "";
            while (!feof($file)) {
                $info .= fgets($file);
            }
            fclose($file);
            foreach (explode("\n", $info) as $s) {
                if (strlen($s) > 1) {
                    array_push($this->disabledSwitchs, $s);
                }
            }
        }

        if (file_exists('../Server/configs.txt')) {
            $file = fopen("../Server/configs.txt", "r") or die("Unable to open file!");
            $info = "";
            while (!feof($file)) {
                $info .= fgets($file);
            }
            fclose($file);
            $this->lastUpdate = explode("\n", $info)[0];
            $this->nextUpdate = explode("\n", $info)[1];
            $this->configsInterval = explode("\n", $info)[2];
            $this->maxLife = explode("\n", $info)[3];

        }


    }

    function saveInfo()
    {
        if (!file_exists('../Data/enabledSwitchList.txt'))
            mkdir('../Data', 0777, true);

        $file = fopen("../Data/enabledSwitchList.txt", "w") or die("Unable to open file!");
        foreach ($this->enabledSwitchs as $s) {
            if (strlen($s) > 1) {
                fwrite($file, $this->getSwitchInfo(explode(",", $s)[0]) . "\n");
            }
        }
        fclose($file);

        $file = fopen("../Data/disabledSwitchList.txt", "w") or die("Unable to open file!");
        foreach ($this->disabledSwitchs as $s) {
            if (strlen($s) > 1) {
                fwrite($file, $this->getSwitchInfo(explode(",", $s)[0]) . "\n");
            }
        }
        fclose($file);

        $file = fopen("../Server/configs.txt", "w") or die("Unable to open file!");
        fwrite($file, $this->lastUpdate . "\n");
        fwrite($file, $this->nextUpdate . "\n");
        fwrite($file, $this->configsInterval . "\n");
        fwrite($file, $this->maxLife . "\n");
        fclose($file);
    }

    public function getModelByBrands($brand)
    {
        foreach ($this->availableModels as $k => $v) {
            if (strcmp($brand, $k) == 0) {
                return $v;
            }
        }
    }

    public function getBrands()
    {
        $brandList = "";
        foreach ($this->availableModels as $k => $v) {
            $brandList .= $k . "\n";
        }
        return $brandList;
    }

    public function addNewSwitch($brand, $model, $name, $ip, $access, $username, $password)
    {
        $brandString = array_keys($this->availableModels)[$brand - 1];
        $modelString = str_replace(array("\n", "\r"), '', explode(",", $this->getModelByBrands($brandString))[$model - 1]);
        $newSwitch = $name . ',' . $brandString . ',' . $modelString . ',' . $ip . ',' . $username . ',' . $password . ',' . $access;
        array_push($this->enabledSwitchs, $newSwitch);
        $this->saveInfo();
        $date = date("Y-m-d") . '*' . date("H:i:sa");
        $date = str_replace("pm", "", $date);
	$date = str_replace("am", "", $date);
        $this->saveToLogs($date . "*Added a new Switch with the name " . $name);
    }

    public function disableSwitch($name)
    {
        foreach ($this->enabledSwitchs as $s) {
            if (explode(",", $s)[0] == $name) {
                array_push($this->disabledSwitchs, $s);
                unset($this->enabledSwitchs[array_search($s, $this->enabledSwitchs)]);
                $this->enabledSwitchs = array_values($this->enabledSwitchs);
            }
        }
        $this->saveInfo();
        $date = date("Y-m-d") . '*' . date("H:i:sa");
	$date = str_replace("pm", "", $date);
	$date = str_replace("am", "", $date);
        $this->saveToLogs($date . "*disabled Switch " . $name);
    }

    public function enableSwitch($name)
    {
        foreach ($this->disabledSwitchs as $s) {
            if (explode(",", $s)[0] == $name) {
                array_push($this->enabledSwitchs, $s);
                unset($this->disabledSwitchs[array_search($s, $this->disabledSwitchs)]);
                $this->disabledSwitchs = array_values($this->disabledSwitchs);
            }
        }
        $this->saveInfo();

        $date = date("Y-m-d") . '*' . date("H:i:sa");
        $date = str_replace("pm", "", $date);
	$date = str_replace("am", "", $date);
        $this->saveToLogs($date . "*enabled Switch " . $name);
    }

    public function getSwitchInfo($name)
    {
        foreach ($this->enabledSwitchs as $s) {
            if (explode(",", $s)[0] == $name) {
                return $s;
            }
        }
        foreach ($this->disabledSwitchs as $s) {
            if (explode(",", $s)[0] == $name) {
                return $s;
            }
        }
    }

    public function getSwitchInfoByInt($brand, $model, $name)
    {
        $aux = explode(",", $this->getEnabledNamesByModelsAndBrand($brand, $model))[$name - 1];
        return $this->getSwitchInfo($aux);
    }

    public function getSwitchHistory($name)
    {
        $file = fopen("../Logs/" . $name . "/history.txt", "r") or die("Unable to open file!");
        $switchList = "";
        while (!feof($file)) {
            $switchList .= fgets($file);
        }
        fclose($file);
        $historyList = array();
//        $detailHistory = array();
        foreach (explode("/", $switchList) as $s) {
            array_push($historyList, $s);
        }
//        foreach ($historyList as $s) {
//            array_push($detailHistory, explode(",", $s)[$i]);
//        }
        return array_unique($historyList);
    }

    public function modifySwitchInfo($oldName, $brand, $model, $name, $ip, $access, $username, $password)
    {
        $newInfo = $name . ',' . $brand . ',' . $model . ',' . $ip . ',' . $username . ',' . $password . ',' . $access;
        $oldInfo = $this->getSwitchInfo($oldName);
        unset($this->enabledSwitchs[array_search($oldInfo, $this->enabledSwitchs)]);
        $this->enabledSwitchs = array_values($this->enabledSwitchs);
        array_push($this->enabledSwitchs, $newInfo);

        $this->saveToHistory($oldName, $oldInfo);

        if ($oldName != $name) {
            $this->renameFolders($oldName, $name);
        }

        $date = date("Y-m-d") . '*' . date("H:i:sa");
        $date = str_replace("pm", "", $date);
	$date = str_replace("am", "", $date);
        $this->saveToLogs($date . "*Changed detail from switch" . $oldName);

        $this->saveInfo();
    }

    public function renameFolders($oldName, $newName)
    {
        rename("../Logs/" . $oldName, "../Logs/" . $newName);
        rename("../Configs/" . $oldName, "../Configs/" . $newName);
    }

    public function saveToHistory($name, $oldInfo)
    {
        if (!file_exists('../Logs/' . $name . '/history.txt'))
            mkdir('../Logs/' . $name, 0777, true);

        $file = fopen("../Logs/" . $name . "/history.txt", "a") or die("Unable to open file!");
        fwrite($file, $oldInfo . '/');
        fclose($file);
    }

    public function saveToLogs($info)
    {
        if (!file_exists('../Logs/changeHistory.txt'))
            mkdir('../Logs', 0777, true);

        $file = fopen("../Logs/changeHistory.txt", "a") or die("Unable to open file!");
        fwrite($file, $info . "\n");
        fclose($file);

    }

//    ------------PASSWORDS

    public function savePassword($pwDes, $pwEnc)
    {
        if (!file_exists('../Data/passwords.txt'))
            mkdir('../Data', 0777, true);

        $file = fopen("../Data/passwords.txt", "a") or die("Unable to open file!");
        fwrite($file, $pwDes . "," . $pwEnc . "\n");
        fclose($file);
    }

    public function getPwSha1($encpw)
    {
        $file = fopen("../Data/passwords.txt", "r") or die("Unable to open file!");
        $info = "";
        while (!feof($file)) {
            $info.= fgets($file);
        }
        fclose($file);
        foreach (explode("\n", $info) as $i) {
            if (explode(",", $i)[1] != "") {
                if (explode(",", $i)[1] == $encpw)
                    return explode(",", $i)[0];
            }
        }
        return "";
    }
    public function deletePassword($pass)
    {
        $file = fopen("../Data/passwords.txt", "r") or die("Unable to open file!");
        $info = "";
        while (!feof($file)) {
            $info.= fgets($file);
        }
        fclose($file);
        $file = fopen("../Data/passwords.txt", "w") or die("Unable to open file!");
        foreach (explode("\n", $info) as $i) {
            if (explode(",", $i)[0] != "") {
                if (explode(",", $i)[1] != $pass)
                    fwrite($file,$i."\n");
            }
        }
        fclose($file);
    }

//    ------------PASSWORDS

    public function getAllDisabledSwitchsNames()
    {
        $switchsList = "";
        foreach ($this->disabledSwitchs as $s) {
            $switchsList .= explode(",", $s)[0] . ",";
        }
        return $switchsList;
    }

    public function getAllEnabledSwitchsNames()
    {
        $switchsList = "";
        foreach ($this->enabledSwitchs as $s) {
            $switchsList .= explode(",", $s)[0] . ",";
        }
        return $switchsList;
    }

    public function getAllSwitchsNames()
    {
        $switchsList = "";
        foreach ($this->enabledSwitchs as $s) {
            $switchsList .= explode(",", $s)[0] . ",";
        }
        foreach ($this->disabledSwitchs as $s) {
            $switchsList .= explode(",", $s)[0] . ",";
        }
        return $switchsList;
    }

    public function isSwitchEnabled($name)
    {
        foreach ($this->enabledSwitchs as $s) {
            if (explode(",", $s)[0] == $name) {
                return true;
            }
        }
        return false;
    }

    public function getEnabledBrands()
    {
        $brandList = "";
        foreach ($this->enabledSwitchs as $s) {
            $brandList .= explode(",", $s)[1] . "\n";
        }
        return $brandList;
    }

    public function getEnabledModelsByBrand($brand)
    {
        $finalList = "";
        $modelList = $this->getModelByBrands($brand);
        $modelList = explode(",", $modelList);
        foreach ($modelList as $model) {
            foreach ($this->enabledSwitchs as $switch) {
                if (explode(",", $switch)[2] == str_replace(array("\n", "\r"), '', $model)) {
                    $finalList .= explode(",", $switch)[2] . ",";
                }
            }
        }
        return $finalList;
    }

    public function getEnabledNamesByModelsAndBrand($brand, $model)
    {
        $finalList = "";
        foreach ($this->enabledSwitchs as $switch) {
            if (explode(",", $switch)[2] == str_replace(array("\n", "\r"), '', $model)) {
                $finalList .= explode(",", $switch)[0] . ",";
            }
        }
        return $finalList;
    }

    public function getLogs()
    {
        $logs = array();
        $final = "";
        if (file_exists("../Logs/changeHistory.txt")) {
            $file = fopen("../Logs/changeHistory.txt", "r") or die("Unable to open file!");
            while (!feof($file)) {
                if ($file != "." && $file != "..") {
                    array_push($logs, fgets($file));
                }
            }
            fclose($file);
        }
        rsort($logs);
        foreach ($logs as $s) {
            $final .= $s . "\n";
        }
        return $final;
    }

    public function getConfs($name)
    {
        $confsList = "";
        $dir = opendir("../Configs/" . $name);
        while (($file = readdir($dir)) != false) {
            if ($file != "." && $file != "..") {
                $confsList .= str_replace(".txt", "", $file) . ",";
            }
        }
        return $confsList;
    }

    public function getConfigInfo($name, $config)
    {
        $confInfo = "";
        if (file_exists("../Configs/" . $name . "/" . $config . ".txt")) {
            $file = fopen("../Configs/" . $name . "/" . $config . ".txt", "r") or die("Unable to open file!");
            while (!feof($file)) {
                $confInfo .= fgets($file);
            }
            fclose($file);
        }
        return $confInfo;
    }

    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function getNextUpdate()
    {
        return $this->nextUpdate;
    }

    public function setNextUpdate($nextUpdate)
    {
        $this->nextUpdate = $nextUpdate;
        $this->saveInfo();
    }

    public function getConfigsInterval()
    {
        return $this->configsInterval;
    }

    public function setConfigsInterval($configsInterval)
    {
        $this->configsInterval = $configsInterval;
    }

    public function getMaxLife()
    {
        return $this->maxLife;
    }

    public function setMaxLife($maxLife)
    {
        $this->maxLife = $maxLife;
    }



}
