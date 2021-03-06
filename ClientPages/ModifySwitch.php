<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Switch Management Software</title>
    <link rel="stylesheet" type="text/css" href="Css/stylesheet.css"/>
</head>
<body>
<header class="mainHeader">
    <span>S M S</span>
    <span>**Switch Management Software**</span>
</header>
<div class="mainContainer">
    <?php
    echo "<h1> Modify Switch Details: </h1>";
    error_reporting(0);
    if (isset($_POST['brand'])) {
        $brandSelected = $_POST['brand'];
    } else {
        $brandSelected = -1;
    }
    if (isset($_POST['model'])) {
        $modelSelected = $_POST['model'];
    } else {
        $modelSelected = -1;
    }
    $actualInfo = $_POST['info'];
    error_reporting(1);
    $oldInfo = $actualInfo;
    $actualInfo = str_replace("*", " ", $actualInfo);
    $actualInfoArray = explode(",", $actualInfo);

    //--------------
    require_once("../Server/Database.php");
    $db = new Database();
    $switchesBrandList = explode("\n", $db->getBrands());
    echo '<form id="f1" action="ModifySwitch.php" method="post">';
    echo '<input type="hidden" name="info" value=' . $oldInfo . '>';
    echo "<label> Brand: </label>";
    echo '<select name="brand" required="true" id="sel1" oninput="activeModelSelect()">';
    $i = 1;
    foreach ($switchesBrandList as $a) {
        if (strlen($a) > 0) {
            if ($brandSelected == $i || ($actualInfoArray[1] == $a && $brandSelected == -1)) {
                echo '<option selected="selected" value=' . $i++ . '>' . $a . '</option>';
            } else {
                echo '<option value=' . $i++ . '>' . $a . '</option>';
            }
        }
    }
    echo '</select>';
    echo "<br>";
    echo "</form>";
    if ($brandSelected == -1) {
        $infoModels = $db->getModelByBrands($actualInfoArray[1]);
    }else{
        $infoModels = $db->getModelByBrands($switchesBrandList[$brandSelected - 1]);
    }
    $switchesModelList = explode(",", $infoModels);
    echo '<form id="f2" action="ModifySwitch.php" method="post" >';
    echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
    echo "<input type='hidden' name='info' value=" . $oldInfo . ">";
    echo "<label> Model: </label>";
    echo '<select name="model" id="sel2" required="true" oninput="activeButtons()">';
    echo '<option disabled="disabled">Please select a model</option>';
    $i = 1;
    foreach ($switchesModelList as $a) {
        if(ord($a[0])==13){
            $a=substr($a,1,strlen($a));
        }
        if (strlen($a) > 1) {
            if ($modelSelected == $i || ($actualInfoArray[2] == $a && $modelSelected == -1)) {
                echo '<option selected="selected" value=' . $i++ . '>' . $a . '</option>';
            } else {
                echo '<option value=' . $i++ . '>' . $a . '</option>';
            }
        }
    }
    echo '</select>';
    echo '</form>';
    //    --------------

    echo "<form action='ModifySwitchFinal.php' method='post' name='ff'>";
    echo "<input type='hidden' name='oldName' value=" . $actualInfoArray[0] . ">";
    $auxNewBrand = str_replace(" ", "*", $switchesBrandList[$brandSelected - 1]);
    if($brandSelected==-1){
        $auxNewBrand = str_replace(" ", "*",$actualInfoArray[1]);
    }

    $auxNewModel = str_replace(" ", "*", $switchesModelList[$modelSelected - 1]);
    if($modelSelected==-1){
        $auxNewModel = str_replace(" ", "*",$actualInfoArray[2]);
    }

    echo "<input type='hidden' name='newBrand' value=" . $auxNewBrand . ">";
    echo "<input type='hidden' name='newModel' value=" . $auxNewModel . ">";

    $switchesNameList = explode(",", $db->getAllSwitchsNames());
    unset($switchesNameList[array_search($actualInfoArray[0], $switchesNameList)]);
    $switchesNameList = array_values($switchesNameList);
    $aux = "";
    foreach ($switchesNameList as $s) {
        if ($s != "") {
            $aux .= $s . ",";
        }
    }
    echo '<br><label>Name: </label><input type="text" name="newName" id="nm" value=' . $actualInfoArray[0] . ' required="true" onchange=checkName("' . $aux . '")><br>';
    echo "<label>IP: </label> <input type='text' name='newIp' required='true' value=" . $actualInfoArray[3] . "> <br>";
    echo "<label>Access by:</label>";
    if (strcmp($actualInfoArray[6], "ssh") == 0) {
        echo '<br> <input type="radio" name="newAccess" value="ssh" checked="true"> SSH ';
        echo '<br> <input type="radio" name="newAccess" value="telnet" > Telnet <br>';
    } else {
        echo '<br> <input type="radio" name="newAccess" value="ssh"> SSH ';
        echo '<br> <input type="radio" name="newAccess" value="telnet" checked="true"> Telnet <br>';
    }
    echo "<label>user: </label> <input type='text' name='newUser' required='true' value=" . $actualInfoArray[4] . "> <br>";
    echo "<label>Password: </label> <input type='password' required='true' name='newPassWord' value=" . $db->getPwSha1($actualInfoArray[5]) . "> <br>";
    echo "<input type='hidden' name='oldPassWord' value=" . $actualInfoArray[5] . ">";
    echo "<input class='submit' type='submit' name='sc' value='Save Changes'>";
    echo "</form>"
    ?>

    <!--    //---------------->
    <script language="javascript">
        function checkName(allNames) {
            var actualName = document.getElementById("nm").value;
            var namesArray = allNames.split(",");
            if (contains(namesArray, actualName)) {
                document.getElementById("nm").style.background = 'red';
                alert("Name already exists, try again!");
                document.getElementById("nm").value = "";
            }
            else {
                document.getElementById("nm").style.background = 'white';
            }


        }
        function contains(a, obj) {
            var i = a.length;
            while (i--) {
                if (a[i] === obj) {
                    return true;
                }
            }
            return false;
        }
        function activeModelSelect() {
            document.getElementById("sel2").disabled = false;
            document.getElementById("f1").submit();
        }
        function activeButtons() {
//            alert("sdfds");
//            document.getElementById("sc").disabled = false;
            document.getElementById("f2").submit();
        }
        function goBack() {
            window.history.back()
        }
    </script>
    <!--    //---------------->

</div>

<a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
    <button class="home"><img src="Css/home.png" width="75" height="75"></button>
</a>
<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>