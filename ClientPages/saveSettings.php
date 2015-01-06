<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
    <head lang="en">
        <meta charset="UTF-8">
        <title>Switch Management Software</title>
        <link rel="stylesheet" type="text/css" href="Css/stylesheet.css"/>
    </head>

    <div class="mainContainer">

        <?php
        require_once("../Server/Database.php");
        echo "<h1>Settings Saves with sucess</h1>";
        $nextUpdate = $_POST['nextUpdate'];
        $interval = $_POST['interval'];
        $maxLife = $_POST['maxLife'];
        $db = new Database();
        $db->setConfigsInterval($interval);
        $db->setLastUpdate(date("Y-m-d H:i"));
        $db->setMaxLife($maxLife);
        $db->setNextUpdate(str_replace("T"," ",$nextUpdate));
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