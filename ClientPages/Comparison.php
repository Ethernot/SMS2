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
            $conf1Selected = $_POST['conf1'];
            $conf2Selected = $_POST['conf2'];
            error_reporting(1);

            require_once("../Server/Database.php");
            $db = new Database();
            $switchesBrandList = explode("\n", $db->getEnabledBrands());
            if (count($switchesBrandList) > 1) {
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

                echo '<form id="f3" action="Comparison.php" method="post">';
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
                        if ($nameSelected == $i) {
                            echo '<option selected="selected" value=' . $i . '>' . $a . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $a . '</option>';
                        }
                        $i++;
                    }
                }
                echo '</select>';
                echo "</form>";

                echo "<form id='f4' method='post' action='Comparison.php'>";
                echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
                echo '<input type="hidden" name="model" value="' . $modelSelected . '">';
                echo '<input type="hidden" name="name" value="' . $nameSelected . '">';
                echo "<label> Configuration 1: </label>";
                $switchesConfsList = array();
                if ($nameSelected > 0) {
                    $switchesConfsList = explode(",", $db->getConfs($switchesNameList[$nameSelected - 1]));
                    echo '<select name="conf1" id="sel4" oninput="activeCheckConf()">';
                } else {
                    echo '<select name="conf1" id="sel4" disabled="true" oninput="activeCheckConf()">';
                }
                echo '<option disabled="disabled" selected="selected">Please select configuration</option>';
                $i = 1;
                foreach ($switchesConfsList as $a) {
                    if (strlen($a) > 1) {
                        if ($conf1Selected == $i) {
                            echo '<option selected="selected" value=' . $i . '>' . $a . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $a . '</option>';
                        }
                        $i++;
                    }
                }
                echo '</select>';
                echo "<br>";
                echo '</form>';

                if ($conf1Selected > 0) {
                    echo "<form id='f5' method='post' action='Comparison.php'>";
                    echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
                    echo '<input type="hidden" name="model" value="' . $modelSelected . '">';
                    echo '<input type="hidden" name="name" value="' . $nameSelected . '">';
                    echo '<input type="hidden" name="conf1" value="' . $conf1Selected . '">';
                    echo "<label> Configuration 2: </label>";
                    $switchesConfsList2 = array();
                    $switchesConfsList2 = explode(",", $db->getConfs($switchesNameList[$nameSelected - 1]));
                    unset($switchesConfsList2[$conf1Selected - 1]);
                    $switchesConfsList2 = array_values($switchesConfsList2);
                    if ($conf2Selected > 0) {
                        echo '<select name="conf2" id="sel5" oninput="activeCheckConf2()">';
                    } else {
                        echo '<select name="conf2" id="sel5" disabled="true" oninput="activeCheckConf2()">';
                    }
                    echo '<option disabled="disabled" selected="selected">Please select configuration</option>';
                    $i = 1;
                    foreach ($switchesConfsList2 as $a) {
                        if (strlen($a) > 1) {
                            if ($conf2Selected == $i) {
                                echo '<option selected="selected" value=' . $i . '>' . $a . '</option>';
                            } else {
                                echo '<option value=' . $i . '>' . $a . '</option>';
                            }
                            $i++;
                        }
                    }
                    echo '</select>';
                    echo "<br>";
                    echo '</form>';

                }
                echo '<button onclick="activef5()"> Add other configuration </button>';
                echo "<form id='f6' action='ShowCompare.php' method='post'>";
                echo '<input type="hidden" name="brand" value="' . $brandSelected . '">';
                echo '<input type="hidden" name="model" value="' . $modelSelected . '">';
                echo '<input type="hidden" name="name" value="' . $switchesNameList[$nameSelected - 1] . '">';
                echo '<input type="hidden" name="conf1" value="' . $switchesConfsList[$conf1Selected - 1] . '">';
                echo '<input type="hidden" name="conf2" value="' . $switchesConfsList2[$conf2Selected - 1] . '">';
                if ($conf1Selected > 0 && $conf2Selected < 1) {
                    echo "<input type='submit' value='Check configuration'> ";
                } else {
                    if ($conf2Selected > 0 && $conf1Selected > 0) {
                        echo "<input type='submit' value='Compare configurations'> ";
                    } else {
                        if ($conf1Selected > 0) {
                            echo "<input type='submit' value='Check configuration'> ";
                        } else {
                            echo "<input type='submit' disabled='true' value='Check configuration'> ";

                        }
                    }
                }
                echo "</form>";
            } else {
                echo "No switches available<br>";
            }

            ?>
            <br>
        </div>


        <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
            <button><img src="Css/home-button.jpg" width="75" height="75"></button>
        </a>

        <script>
            function goBack() {
                window.history.back()
            }
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
            function activeCheckConf() {
                document.getElementById("f4").submit();
            }
            function activeCheckConf2() {
                document.getElementById("f5").submit();
            }
            function activeButtons() {
                document.getElementById("atc").disabled = false;
            }
            function activef5() {
                document.getElementById("sel5").disabled = false;
            }
        </script>
        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>


