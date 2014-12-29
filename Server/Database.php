<?php

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


    function __construct()
    {
        $this->availableModels = array();
        $this->enabledSwitchs = array();
        $this->disabledSwitchs = array();
        $this->loadInfo();
    }

    function loadInfo()
    {
        $file = fopen("Data/switchList.txt", "r") or die("Unable to open file!");
        $switchList = "";
        while (!feof($file)) {
            $switchList .= fgets($file);
        }
        fclose($file);
        foreach (explode("\n", $switchList) as $s) {
            $switch = explode("-", $s);
            error_reporting(0);
            $this->availableModels[$switch[0]] .= $switch[1];
            error_reporting(1);
        }

        $file = fopen("Data/enabledSwitchList.txt", "r") or die("Unable to open file!");
        $switchList = "";
        while (!feof($file)) {
            $switchList .= fgets($file);
        }
        fclose($file);
        foreach (explode("/", $switchList) as $s) {
            array_push($this->enabledSwitchs, $s);
        }

        $file = fopen("Data/disabledSwitchList.txt", "r") or die("Unable to open file!");
        $switchList = "";
        while (!feof($file)) {
            $switchList .= fgets($file);
        }
        fclose($file);
        foreach (explode("/", $switchList) as $s) {
            array_push($this->disabledSwitchs, $s);
        }

    }

    function saveInfo()
    {
        if (!file_exists('Data/enabledSwitchList.txt'))
            mkdir('Data', 0777, true);

        $file = fopen("Data/enabledSwitchList.txt", "a") or die("Unable to open file!");
        foreach ($this->enabledSwitchs as $s) {
            fwrite($file, $s . '/');
        }
        fclose($file);

        $file = fopen("Data/disabledSwitchList.txt", "a") or die("Unable to open file!");
        foreach ($this->disabledSwitchs as $s) {
            fwrite($file, $s . '/');
        }
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
        $newSwitch = $name . ',' . $brand . ',' . $model . ',' . $ip . ',' . $username . ',' . $password . ',' . $access . "/";
        array_push($this->enabledSwitchs, $newSwitch);
        $this->saveInfo();
        $date = date("Y-m-d") . ' ' . date("h:i:sa");
        $this->saveToLogs("->> " . $date . " Added a new Switch with the name " . $name);
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
        $date = date("Y-m-d") . ' ' . date("h:i:sa");
        $this->saveToLogs("->> " . $date . " disabled Switch " . $name);
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

        $date = date("Y-m-d") . ' ' . date("h:i:sa");
        $this->saveToLogs("->> " . $date . " enabled Switch " . $name);
    }


    public function getSwitchInfo($name)
    {
        foreach ($this->enabledSwitchs as $s) {
            if (explode(",", $s)[0] == $name) {
                return $s;
            }
        }
    }

    public function getSwitchHistory($name, $i)
    {
        $file = fopen("Logs/" . $name . "/history.txt", "r") or die("Unable to open file!");
        $switchList = "";
        while (!feof($file)) {
            $switchList .= fgets($file);
        }
        fclose($file);
        $historyList = array();
        $detailHistory = array();
        foreach (explode("/", $switchList) as $s) {
            array_push($historyList, $s);
        }
        foreach ($historyList as $s) {
            array_push($detailHistory, explode(",", $s)[$i]);
        }
        return array_unique($detailHistory);
    }

    public function modifySwitchInfo($oldName, $brand, $model, $name, $ip, $access, $username, $password)
    {
        $newInfo = $name . ',' . $brand . ',' . $model . ',' . $ip . ',' . $username . ',' . $password . ',' . $access . "/";
        $oldInfo = $this->getSwitchInfo($oldName);
        unset($this->enabledSwitchs[array_search($oldInfo, $this->enabledSwitchs)]);
        $this->enabledSwitchs = array_values($this->enabledSwitchs);
        array_push($this->enabledSwitchs, $newInfo);

        $this->saveToHistory($oldName,$oldInfo);

        if($oldName != $name){
            $this->renameFolders($oldName,$name);
        }

        $date = date("Y-m-d") . ' ' . date("h:i:sa");
        $this->saveToLogs("->> " . $date . " Changed detail from switch" . $oldName);

        $this->saveInfo();
    }


    public function renameFolders($oldName, $newName)
    {
        rename("Logs/" . $oldName, "Logs/" . $newName);
        rename("Configs/" . $oldName, "Configs/" . $newName);
    }

    public function saveToHistory($name, $oldInfo)
    {
        if (!file_exists('Logs/' . $name . '/history.txt'))
            mkdir('Logs/' . $name, 0777, true);

        $file = fopen("Logs/" . $name . "/history.txt", "a") or die("Unable to open file!");
        fwrite($file, $oldInfo . '/');
        fclose($file);
    }

    public function saveToLogs($info)
    {
        if (!file_exists('Logs/changeHistory.txt'))
            mkdir('Logs', 0777, true);

        $file = fopen("Logs/changeHistory.txt", "a") or die("Unable to open file!");
        fwrite($file, $info . "\n");
        fclose($file);

    }


}