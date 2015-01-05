<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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

        <?php
        require_once("../Server/Database.php");
        $db = new Database();
        $currentHour = explode(":", $db->getConfigsTime())[0];
        $currentMinutes = explode(":", $db->getConfigsTime())[1];
        $currentInterval = $db->getConfigsInterval();
        ?>

        <div class="mainContainer">
            <h1>Settings:</h1>
            <form action="saveSettings.php" method="post">
                <label>Time of the backup: </label>
                <input type="time" name="time" value=<?php echo $currentHour . ':' . $currentMinutes ?>>
                <br>
                <label>Interval of the backup(Hours): </label>
                <select name="interval">
                    <?php
                    for ($i = 1; $i < 97; $i++) {
                        if ($i == $currentInterval) {
                            echo '<option selected="selected" value=' . $i . '>' . $i . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                    }
                    ?>
                </select>
                <br>
                <input class="submit" type="submit" value="Save">
            </form>
        </div>
        <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
            <button class="home"><img src="Css/home.png" width="75" height="75"></button>
        </a>

        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>