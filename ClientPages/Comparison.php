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
            <h1>Compare switches: </h1>
            <?php
            error_reporting(0);
            $brand = $_POST['brand'];
            $model = $_POST['model'];
            $name = $_POST['name'];
            $conf = $_POST['conf'];
            $aux = $_POST['aux'];
            error_reporting(1);

            //<!--todo:  carregar dados dos ficheiros-->
            $switchesBrandList = array("aaaaaaaa", "bbbbbbbbbb", "cccccccccccc");
            $switchesModelList = array("ddddddd", "eeeeeeeee", "ffffffffffff");
            $switchesNameList = array("gggggggg", "hhhhhhhhh", "iiiiiiiii");
            $switchesConfsList = array("jjjjjjjjj", "kkkkkkkk", "llllllll");

            if (count($switchesBrandList) > 0) {
                echo '<form name="compare" action="Comparison.php" method="post">';
                echo "<label> Brand: </label>";
                if (count($brand) == 0) {
                    echo '<select name="brand" id="sel1" oninput="activeModelSelect()" required="true">';
                    //<!--todo:  alterar o tipo de letra dos selects-->
                    echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
                    foreach ($switchesBrandList as $a) {
                        if (strlen($a) > 0) {
                            echo '<option value=' . $a . '>' . $a . '</option>';
                        }
                    }
                    echo '</select>';
                } else {
                    echo "<input type='hidden' name='brand' value=" . $brand . ">";
                    echo "<label>" . $brand . "</label>";
                }
                echo "<br>";

                echo "<label> Model: </label>";
                if (count($model) == 0) {
                    echo '<select name="model" required="true" id="sel2" disabled="true" oninput="activeNameSelect()">';
                    echo '<option disabled="disabled" selected="selected">Please select a model</option>';
                    foreach ($switchesModelList as $a) {
                        if (strlen($a) > 0) {
                            echo '<option value=' . $a . '>' . $a . '</option>';
                        }
                    }
                    echo '</select>';
                } else {
                    echo "<input type='hidden' name='model' value=" . $model . ">";
                    echo "<label>" . $model . "</label>";
                }
                echo "<br>";


                echo "<label> Name: </label>";
                if (count($name) == 0) {
                    echo '<select name="name" required="required" id="sel3" disabled="true" oninput="activeConfSelect()">';
                    echo '<option disabled="disabled" selected="selected">Please select a name</option>';
                    foreach ($switchesNameList as $a) {
                        if (strlen($a) > 0) {
                            echo '<option value=' . $a . '>' . $a . '</option>';
                        }
                    }
                    echo '</select>';
                } else {
                    echo "<input type='hidden' name='name' value=" . $name . ">";
                    echo "<label>" . $name . "</label>";
                }
                echo "<br>";

                if ($conf == "") {
                    echo "<label> Configuration: </label>";
                    echo '<select name="conf" required="true" id="sel4" disabled="true" oninput="activeButtons()">';
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
                    echo '</form>';
                    echo "<label> Configuration 1: </label>";
                    echo $conf;
                    echo "<br>";
                    echo "<form action='ShowCompare.php' method='post' name='goToCompare'>";
                    echo '<input type="hidden" name="conf" value=' . $conf . '>';
                    echo "<input type='hidden' name='name' value=" . $name . ">";
                    echo "<label> Other Configuration: </label>";
                    echo '<select name="conf2">';
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
                    echo '<input type="submit" value="Compare">';
                    echo "</form>";
                }
            } else {
                echo "No switches inserted <br><br>";
            }

            ?>
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
        </div>
        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>

