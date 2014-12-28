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

    $switchesBrandList = array("aaaaaaaa", "bbbbbbbbbb", "cccccccccccc");
    $switchesModelList = array("ddddddd", "eeeeeeeee", "ffffffffffff");
    $switchesNameList = array("gggggggg", "hhhhhhhhh", "iiiiiiiii");

    if (count($switchesBrandList) > 0) {
        echo '<form name="compare" action="CheckSwitchInfo.php" method="post">';
        echo "<label> Brand: </label>";
            echo '<select name="brand" id="sel1" oninput="activeModelSelect()">';
            //<!--todo:  alterar o tipo de letra dos selects-->
            echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
            foreach ($switchesBrandList as $a) {
                if (strlen($a) > 0) {
                    echo '<option value=' . $a . '>' . $a . '</option>';
                }
            }
            echo '</select>';
        echo "<br>";
        echo "<label> Model: </label>";
            echo '<select name="model" id="sel2" disabled="true" oninput="activeNameSelect()">';
            echo '<option disabled="disabled" selected="selected">Please select a model</option>';
            foreach ($switchesModelList as $a) {
                if (strlen($a) > 0) {
                    echo '<option value=' . $a . '>' . $a . '</option>';
                }
            }
            echo '</select>';
        echo "<br>";
        echo "<label> Name: </label>";
            echo '<select name="name" id="sel3" disabled="true" oninput="activeButtons()">';
            echo '<option disabled="disabled" selected="selected">Please select a name</option>';
            foreach ($switchesNameList as $a) {
                if (strlen($a) > 0) {
                    echo '<option value=' . $a . '>' . $a . '</option>';
                }
            }
            echo '</select>';
        echo "<br>";
            echo "<input type='submit' value='Check Switch' id='cs' disabled='true'>";
        echo "</form>";
    } else {
        echo "No switches inserted <br><br>";
    }
    ?>

    <a href="AddSwitch.php"><button>Add new switch</button></a>
    <a href="CheckAllSwitches.php"><button>Check all switches</button></a>

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