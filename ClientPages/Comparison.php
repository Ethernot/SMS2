<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Switch Management Software</title>
    <link rel="stylesheet" type="text/css" href="Css/stylesheet.css"/>
</head>
<body>
<header class="mainHeader">
    <h1>S M S</h1>

    <p>Switch Management Software</p>
</header>

<div class="mainContainer">
    <h1>Compare switches: </h1>
    <?php
    error_reporting(0);
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $name = $_POST['name'];
    $conf = $_POST['conf'];
    $conf2 = $_POST['conf2'];
    $aux = $_POST['aux'];
    error_reporting(1);
    echo "|".$conf."|<br>";
    echo "|".$conf2."|";
//    $confsToCompare=array();
//    if (count($conf) > 0) {
//        array_push($confsToCompare, $conf);
//    }

    //<!--todo:  carregar dados dos ficheiros-->
    $switchesBrandList = array("aaaaaaaa", "bbbbbbbbbb", "cccccccccccc");
    $switchesModelList = array("ddddddd", "eeeeeeeee", "ffffffffffff");
    $switchesNameList = array("gggggggg", "hhhhhhhhh", "iiiiiiiii");
    $switchesConfsList = array("jjjjjjjjj", "kkkkkkkk", "llllllll");

    if (count($switchesBrandList) > 0) {
        echo '<form name="compare" action="Comparison.php" method="post">';
        // brand select
        echo "<label> Brand: </label>";
        if (count($brand) == 0) {
            echo '<select name="brand" id="sel1" oninput="activeModelSelect()">';
            //<!--todo:  alterar o tipo de letra dos selects-->
            echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
            foreach ($switchesBrandList as $a) {
                if (strlen($a) > 0) {
                    echo '<option value=' . $a . '>' . $a . '</option>';
                }
            }
            echo '</select>';
        } else {
            echo "<input type='hidden' name='brand' value=".$brand.">";
            echo "<label>" . $brand . "</label>";
        }
        echo "<br>";

        // model select
        echo "<label> Model: </label>";
        if (count($model) == 0) {
            echo '<select name="model" id="sel2" disabled="true" oninput="activeNameSelect()">';
            echo '<option disabled="disabled" selected="selected">Please select a model</option>';
            foreach ($switchesModelList as $a) {
                if (strlen($a) > 0) {
                    echo '<option value=' . $a . '>' . $a . '</option>';
                }
            }
            echo '</select>';
        } else {
            echo "<input type='hidden' name='model' value=".$model.">";
            echo "<label>" . $model . "</label>";
        }
        echo "<br>";


        // name select
        echo "<label> Name: </label>";
        if (count($name) == 0) {
            echo '<select name="name" id="sel3" disabled="true" oninput="activeConfSelect()">';
            echo '<option disabled="disabled" selected="selected">Please select a name</option>';
            foreach ($switchesNameList as $a) {
                if (strlen($a) > 0) {
                    echo '<option value=' . $a . '>' . $a . '</option>';
                }
            }
            echo '</select>';
        } else {
            echo "<input type='hidden' name='name' value=".$name.">";
            echo "<label>" . $name . "</label>";
        }
        echo "<br>";

        if ($conf == "") {
            echo "<label> Configuration: </label>";
            echo '<select name="conf" id="sel4" disabled="true" oninput="activeButtons()">';
            echo '<option disabled="disabled" selected="selected">Please select configuration</option>';
            foreach ($switchesConfsList as $a) {
                if ($a != $conf) {
                    if (strlen($a) > 0) {
                        echo '<option value=' . $a . '>' . $a . '</option>';
                    }
                }
            }
            echo '</select>';
        } else {
            echo "<input type='hidden' name='conf' value=".$conf.">";
//            $i = 1;
//            foreach ($confsToCompare as $a) {
//                echo "<label> Configuration ".$i.": </label>";
//                echo "<label>" . $a . "</label><br>";
//                $i=$i+1;
//            }
            echo "<label> Other Configuration: </label>";
            echo '<select name="conf2" id="sel4" oninput="activeButtons()">';
            echo '<option disabled="disabled" selected="selected">Please select configuration </option>';
            foreach ($switchesConfsList as $a) {
                if ($a != $conf) {
                    if (strlen($a) > 0) {
                        echo '<option value=' . $a . '>' . $a . '</option>';
                    }
                }
            }
            echo '</select>';
            echo "<br>";
//            echo "<input type='hidden' name='aux' value=".$aux." / ".$conf.">";
        }
        echo "<br>";

        echo " <a href='#'> <button id='atc' disabled='true'>Add to comparison</button> </a>";
        echo " <a href='#'> <button id='cc' disabled='true'>compare configuration</button> </a>";
        echo '</form>';
    } else {
        echo "No switches inserted <br><br>";
    }

    ?>
</div>
<br>
<button onclick="goBack()">Go Back</button>

<script>
    function activeModelSelect() {
        document.getElementById("sel2").disabled = false;
    }
    function activeNameSelect() {
        document.getElementById("sel3").disabled = false;
    }
    function activeConfSelect() {
        document.getElementById("sel4").disabled = false;
    }
    function activeButtons() {
        document.getElementById("atc").disabled = false;
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


