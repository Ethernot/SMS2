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
    <h1>Compare Configurations: </h1>
    <?php
    error_reporting(0);
    $brandSelected = $_POST['brand'];
    $modelSelected = $_POST['model'];
    $nameSelected = $_POST['name'];
    error_reporting(1);

    require_once("../Server/Database.php");
    $db = new Database();
    $switchesBrandList = explode("\n", $db->getEnabledBrands());
    if (count($switchesBrandList) > 0) {
        echo '<form id="f1" action="Comparison.php" method="post">';
        echo "<label> Brand: </label>";
        echo '<select name="brand" id="sel1" oninput="activeModelSelect()">';
        echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
        $i = 1;
        foreach ($switchesBrandList as $a) {
            if (strlen($a) > 0) {
                if ($brandSelected == $i) {
                    echo '<option selected="selected" value=' . $i . '>' . $a . '</option>';
                } else {
                    echo '<option value=' . $i . '>' . $a . '</option>';
                }
            }
            $i++;
        }
        echo '</select>';
        echo "</form>";

        echo '<form id="f2" action="Comparison.php" method="post">';
        echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
        echo "<label> Model: </label>";
        if ($brandSelected > 0) {
            $switchesModelList = explode(",", $db->getEnabledModelsByBrand($switchesBrandList[$brandSelected - 1]));
//            print_r($switchesModelList);
//            echo "...: ".$db->getEnabledModelsByBrand($switchesBrandList[$brandSelected-1]);
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

        echo '<form name="f3" action="Comparison.php" method="post">';
        echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
        echo '<input type="hidden" name="model" value="' . $modelSelected . '">';
        echo "<label> Name: </label>";
        if ($modelSelected > 0) {
            $switchesNameList = explode(",", $db->getEnabledNamesByModelsAndBrand($switchesBrandList[$brandSelected - 1], $switchesModelList[$modelSelected - 1]));
            echo '<select name="name" id="sel3" oninput="activeConfSelect()">';
        } else {
            echo '<select name="name" id="sel3" disabled="true" oninput="activeConfSelect()">';
        }
        echo '<option disabled="disabled" selected="selected">Please select a name</option>';
        $i = 1;
        foreach ($switchesNameList as $a) {
            if (strlen($a) > 1) {
                echo '<option value=' . $i++ . '>' . $a . '</option>';
            }
        }
        echo '</select>';
        echo "</form>";

        echo "<form id='f4' method='post' action='ShowCompare.php'>";
        echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
        echo '<input type="hidden" name="model" value="' . $modelSelected . '">';
        echo '<input type="hidden" name="name" value="' . $nameSelected . '">';
        $switchesConfsList = explode(",", "asdsad,asda,das,dsa,sad,asd,sa,das");
        echo "<label> Configuration 1: </label>";
        echo '<select name="conf1" required="true" id="sel4" disabled="true" oninput="">';
        echo '<option disabled="disabled" selected="selected">Please select configuration</option>';
        foreach ($switchesConfsList as $a) {
            if (strlen($a) > 0) {
                echo '<option value=' . $a . '>' . $a . '</option>';
            }
        }
        echo '</select>';
        echo "<br>";
        echo '<input type="submit" value="Add to comparison" disabled="true" id="atc" >';
        echo '</form>';
    } else {
        echo "No switches inserted <br><br>";
    }

    ?>
    <br>
    <button onclick="goBack()">Go Back</button>

    <script>
        function activeModelSelect() {
            document.getElementById("sel2").disabled = false;
            document.getElementById("f1").submit();
        }
        function activeNameSelect() {
            document.getElementById("sel3").disabled = false;
            document.getElementById("f2").submit();
        }
        function activeConfSelect() {
            document.getElementById("sel4").disabled = false;
            document.getElementById("f3").submit();
        }
        function activeButtons() {
            document.getElementById("atc").disabled = false;
        }
        function goBack() {
            window.history.back()
        }
    </script>
</div>
<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>


