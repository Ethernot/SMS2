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
            $brandSelected = $_POST['brand'];
            $modelSelected = $_POST['model'];
            $actualInfo = $_POST['info'];
            error_reporting(1);
            $actualInfoArray = explode(",", $actualInfo);

            //--------------
            require_once("../Server/Database.php");
            $db = new Database();
            $switchesBrandList = explode("\n", $db->getBrands());
            echo '<form id="f1" action="ModifySwitch.php" method="post">';
            echo "<input type='hidden' name='info' value=" . $actualInfo . ">";
            echo "<label> Brand: </label>";
            echo '<select name="brand" id="sel1" oninput="activeModelSelect()">';
            echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
            $i = 1;
            foreach ($switchesBrandList as $a) {
                if (strlen($a) > 0) {
                    if ($brandSelected == $i) {
                        echo '<option selected="selected" disabled="disabled" value=' . $i++ . '>' . $a . '</option>';
                    } else {
                        echo '<option value=' . $i++ . '>' . $a . '</option>';
                    }
                }
            }
            echo '</select>';
            echo "<br>";
            echo "</form>";

            if ($brandSelected > 0) {
                $infoModels = $db->getModelByBrands($switchesBrandList[$brandSelected - 1]);
                $switchesModelList = explode(",", $infoModels);
            }
            echo '<form id="f2" action="ModifySwitch.php" method="post" >';
            echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
            echo "<input type='hidden' name='info' value=" . $actualInfo . ">";
            echo "<label> Model: </label>";
            if ($brandSelected == 0) {
                echo '<select name="model" id="sel2" disabled="true" required="required" oninput="activeButtons()">';
            } else {
                echo '<select name="model" id="sel2" required="required" oninput="activeButtons()">';
            }
            echo '<option disabled="disabled" selected="selected" >Please select a model</option>';
            $i = 1;
            foreach ($switchesModelList as $a) {
                if (strlen($a) > 1) {
                    if ($modelSelected == $i) {
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
            echo "<input type='hidden' name='newBrand' value=" . $auxNewBrand . ">";
            $auxNewModel = str_replace(" ", "*", $switchesModelList[$modelSelected - 1]);
            echo "<input type='hidden' name='newModel' value=" . $auxNewModel . ">";
            echo "<label>Name: </label> <input type='text' name='newName' value=" . $actualInfoArray[0] . "> <br>";
            echo "<label>IP: </label> <input type='text' name='newIp' value=" . $actualInfoArray[3] . "> <br>";
            echo "<label>Access by:</label>";
            if (strcmp($actualInfoArray[6], "ssh") == 0) {
                echo '<br> <input type="radio" name="newAccess" value="ssh" checked="true"> SSH ';
                echo '<br> <input type="radio" name="newAccess" value="telnet" > Telnet <br>';
            } else {
                echo '<br> <input type="radio" name="newAccess" value="ssh"> SSH ';
                echo '<br> <input type="radio" name="newAccess" value="telnet" checked="true"> Telnet <br>';
            }
            echo "<label>user: </label> <input type='text' name='newUser' value=" . $actualInfoArray[4] . "> <br>";
            echo "<label>Password: </label> <input type='password' name='newPassWord' value=" . $actualInfoArray[5] . "> <br>";
            echo "<input type='submit' value='Save Changes'>";
            echo "</form>"
            ?>

            <!--    //---------------->
            <script language="javascript">
                function activeModelSelect() {
                    document.getElementById("sel2").disabled = false;
                    document.getElementById("f1").submit();
                }
                function activeButtons() {
                    document.getElementById("f2").submit();
                }
                function goBack() {
                    window.history.back()
                }
            </script>
            <!--    //---------------->

        </div>

        <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
            <button><img src="Css/home-button.jpg" width="75" height="75"></button>
        </a>
        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>