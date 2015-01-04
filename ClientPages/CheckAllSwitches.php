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
    require_once("../Server/Database.php");
    $db = new Database();
    error_reporting(0);
    $postedName = $_POST['name'];
    $postedOption = $_POST['option'];
    error_reporting(1);
    if ($postedName != "" && $postedOption != "") {
        if (strcmp($postedOption, "enable")==0) {
            $db->enableSwitch($postedName);
        } else if (strcmp($postedOption, "disable")==0) {
            $db->disableSwitch($postedName);
        }
    }
    $info = $db->getAllSwitchsNames();
    $switchesNameList = explode(",", $info);
    echo "<h1>Control Panel: all switches: </h1>";
    $i = 0;
    foreach ($switchesNameList as $a) {
        if (strlen($a > 1)) {
            echo "<form action='CheckAllSwitches.php' method='post' id='" . $i . "' >";
            echo "<label >Switch name: " . $a . "</label><br>";
            if ($db->isSwitchEnabled($a)) {
                echo "<input type='hidden' name='name' value=" . $a . ">";
                echo 'Enable <input type="radio" id="r1" name="option" checked="true" value="enable" onchange="activeForm(' . $i . ')">';
                echo 'Disabled <input type="radio" id="r2" name="option" value="disable" onchange="activeForm(' . $i . ')">';
            } else {
                echo "<input type='hidden' name='name' value=" . $a . ">";
                echo 'Enable <input type="radio" id="r1" name="option" value="enable" onchange="activeForm(' . $i . ')">';
                echo 'Disabled <input type="radio" id="r2" name="option" checked="true" value="disable" onchange="activeForm(' . $i . ')">';
            }
            $i++;
        }
        echo "</form>";
    }
    ?>
    <br>
    <a href="../index.php">
        <button>Go Home</button>
    </a>
</div>

<script>
    function activeForm(form) {
        alert("Update sucessfully!");
        document.getElementById(form).submit();
    }
</script>

        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>