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
    <h1>Switches management: </h1>
    <?php
    require_once("../Server/Database.php");
    $db = new Database();
    error_reporting(0);
    $brandSelected = $_POST['brand'];
    $modelSelected = $_POST['model'];
    error_reporting(1);
    $switchesBrandList = explode("\n", $db->getEnabledBrands());
    $switchesBrandList = array_unique($switchesBrandList);
    if (count($switchesBrandList) > 1) {
        echo '<form id="f1" action="SwitchManagement.php" method="post">';
        echo "<label> Brand: </label>";
        echo '<select name="brand" id="sel1" oninput="activeModelSelect()">';
        //<!--todo:  alterar o tipo de letra dos selects-->
        echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
        $i = 1;
        foreach ($switchesBrandList as $a) {
            if (strlen($a) > 0) {
                if ($brandSelected == $i) {
                    echo '<option selected="selected" value=' . $i++ . '>' . $a . '</option>';
                } else {
                    echo '<option value=' . $i++ . '>' . $a . '</option>';
                }
            }
        }
        echo '</select>';
        echo "</form>";

        echo '<form id="f2" action="SwitchManagement.php" method="post">';
        echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
        echo "<label> Model: </label>";
        if ($brandSelected > 0) {
            $switchesModelList = explode(",", $db->getEnabledModelsByBrand($switchesBrandList[$brandSelected - 1]));
            $switchesModelList = array_unique($switchesModelList);
            echo '<select name="model" id="sel2" oninput="activeNameSelect()">';
        } else {
            echo '<select name="model" id="sel2" disabled="true" oninput="activeNameSelect()">';
        }
        echo '<option disabled="disabled" selected="selected">Please select a model</option>';
        $i = 1;
        foreach ($switchesModelList as $a) {
            if (strlen($a) > 1) {
                if ($modelSelected == $i) {
                    echo '<option selected="selected" value=' . $i . '>' . $a . '</option>';
                } else {
                    echo '<option value=' . $i . '>' . $a . '</option>';
                }
                $i++;

            }
        }
        echo '</select>';
        echo "</form>";

        echo '<form name="f3" action="CheckSwitchInfo.php" method="post">';
        echo '<input type="hidden" name="brand" value="' . $switchesBrandList[$brandSelected - 1] . '">';
        echo '<input type="hidden" name="model" value="' . $switchesModelList[$modelSelected - 1] . '">';
        echo "<label> Name: </label>";
        if ($modelSelected > 0) {
            $switchesNameList = explode(",", $db->getEnabledNamesByModelsAndBrand($switchesBrandList[$brandSelected - 1], $switchesModelList[$modelSelected - 1]));
            echo '<select name="name" id="sel3" oninput="activeButtons()">';
        } else {
            echo '<select name="name" id="sel3" disabled="true" oninput="activeButtons()">';
        }
        echo '<option disabled="disabled" selected="selected">Please select a name</option>';
        $i = 1;
        foreach ($switchesNameList as $a) {
            if (strlen($a) > 1) {
                echo '<option value=' . $i++ . '>' . $a . '</option>';
            }
        }
        echo '</select>';
        echo "<br>";
        if ($modelSelected > 0) {
            echo "<input class='submit' type='submit' value='Check Switch' id='cs' >";
        } else {
            echo "<input class='submit' name='cs' type='submit' value='Check Switch' id='cs' disabled='true'>";
        }
        echo "</form>";
    } else {
        echo "<label>No switches available</label><br>";
    }

    ?>

    <a href="AddSwitch.php">
        <button>Add new switch</button>
    </a>
    <a href="CheckAllSwitches.php">
        <button>Check all switches</button>
    </a>

</div>
<a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
    <button class="home"><img src="Css/home.png" width="75" height="75"></button>
</a>
<script>
    function activeModelSelect() {
        document.getElementById("sel2").disabled = false;
        document.getElementById("f1").submit();
    }
    function activeNameSelect() {
        document.getElementById("sel3").disabled = false;
        document.getElementById("f2").submit();
    }
    function activeButtons() {
        document.getElementById("cs").disabled = false;
    }
    function goBack() {
        window.history.back()
    }
</script>
<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>