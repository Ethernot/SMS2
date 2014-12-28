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
            $brandModel = explode("-", $s);
            error_reporting(0);
            $this->availableModels[$brandModel[0]] .= $brandModel[1];
            error_reporting(1);
        }

    }

    public function getModelByBrands($brand)
    {
        foreach ($this->availableModels as $k => $v) {
            if(strcmp($brand,$k)==0){
                return $v;
            }
        }
    }

    public function getBrands(){
        $brandList = "";
        foreach ($this->availableModels as $k => $v) {
            $brandList .= $k . "\n";
        }
        return $brandList;
    }


}