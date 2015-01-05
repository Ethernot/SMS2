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
            $name = $_POST['name'];
            require_once("../Server/Database.php");
            $db = new Database();
            echo "<h1>Switch " . $name . "History: </h1>";
            $infoArray = $db->getSwitchHistory($name);
            if (count($infoArray) > 1) {
                foreach ($infoArray as $a) {
                    $infoAux = explode(",", $a);
                    if (count($infoAux) > 1) {
                        echo "<h2> Old details: </h2>";
                        echo "<label> Name: " . $infoAux[0] . "</label><br>";
                        echo "<label> Brand: " . $infoAux[1] . "</label><br>";
                        echo "<label> Model: " . $infoAux[2] . "</label><br>";
                        echo "<label> IP: " . $infoAux[3] . "</label><br>";
                        echo "<label> User: " . $infoAux[4] . "</label><br>";
                        echo "<label> Password: " . str_repeat("*", strlen($infoAux[5])) . " </label><br>";
                        echo "<label> Access: " . $infoAux[6] . "</label><br>";
                        echo "------------------------<br>";
                    }
                }
            } else {
                echo "<h2> No history: </h2>";
            }
            ?>
        </div>
        <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
            <button class="home"><img src="Css/home.png" width="75" height="75"></button>
        </a>

        <footer class="mainFooter">
            <p> Copyright & copy; <span> Ethernot Team </span></p>
        </footer>
    </body>
</html>