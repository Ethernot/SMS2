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
        <div class='mainContainer'>
            <?php
            error_reporting(0);
            $name = $_POST['name'];
            $conf1 = $_POST['conf1'];
            $conf2 = $_POST['conf2'];
            error_reporting(1);
            require_once("../Server/Database.php");
            $db = new Database();
            echo "<h1>Switch " . $name . ":</h1>";
            if ($conf1 != "" && $conf2 == "") {
                echo "<div>";
                echo "<h1>Configuration " . $conf1 . ":</h1>";
                $a = $db->getConfigInfo($name, $conf1);
                echo $a;
                echo "<br><a href='../Configs/" . $name . "/" . $conf1 . ".txt' download><button>Download configuration</button></a>";
                echo "</div>";
            } else if ($conf1 != "" && $conf2 != "") {
                $config1 = $db->getConfigInfo($name, $conf1);
                $config2 = $db->getConfigInfo($name, $conf2);
                echo "<div>";
                echo "<h2>Configuration " . $conf1 . ":</h2>";

                for ($i = 0; $i < strlen($config1); $i++) {
                    if ($i >= strlen($config2)) {
                        echo '<font color=#ff0000 size="4">' . $config1[$i] . '</font>';
                    } elseif ($config1[$i] != $config2[$i]) {
                        echo '<font color=#ff000 size="4">' . $config1[$i] . '</font>';
                    } else {
                        echo '<font size="4">' . $config1[$i] . '</font>';
                    }
                }
                echo "<br><a href='../Configs/" . $name . "/" . $conf1 . ".txt' download><button>Download configuration</button></a>";
                echo "</div>";

                echo "<div>";
                echo "<h2>Configuration " . $conf2 . ":</h2>";
//        echo $config2;
                for ($i = 0; $i < strlen($config2); $i++) {
                    if ($i >= strlen($config1)) {
                        echo '<font color=#ff0000 size="4">' . $config2[$i] . '</font>';
                    } elseif ($config1[$i] != $config2[$i]) {
                        echo '<font color=#ff000 size="4">' . $config2[$i] . '</font>';
                    } else {
                        echo '<font size="4">' . $config2[$i] . '</font>';
                    }
                }
                echo "<br><a href='../Configs/" . $name . "/" . $conf2 . ".txt' download><button>Download configuration</button></a>";
                echo "</div>";
            }
            ?>
        </div>
        <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
            <button class="home"><img src="Css/home.png" width="75" height="75"></button>
        </a>
        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>