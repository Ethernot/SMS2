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
        $nextUpdate = $db->getNextUpdate();
        $year = explode("-",explode(" ", $nextUpdate)[0])[0];
        $month = explode("-",explode(" ", $nextUpdate)[0])[1];
        $day = explode("-",explode(" ", $nextUpdate)[0])[2];
        $hour = explode(":",explode(" ", $nextUpdate)[1])[0];
        $minute = explode(":",explode(" ", $nextUpdate)[1])[1];

        $currentInterval = $db->getConfigsInterval();
        $currentMaxLife = $db->getMaxLife();
        ?>

        <div class="mainContainer">

            <?php
            ?>
            <h1>Settings:</h1>
            <form action="saveSettings.php" method="post">
                <label>Date Of next update: </label>
                <input type="datetime-local" name = "nextUpdate" value=<?php echo $year."-".$month."-".$day."T".$hour.":".$minute?>>
                <br>
                <label>Interval of the backups(days): </label>
                <select name="interval">
                    <?php
                    for ($i = 1; $i < 91; $i++) {
                        if ($i == $currentInterval) {
                            echo '<option selected="selected" value=' . $i . '>' . $i . '</option>';
                        } else {
                            echo '<option value=' . $i . '>' . $i . '</option>';
                        }
                    }
                    ?>
                </select>
                <br>
                <label>Max life of Configurations(days): </label>
                <select name="maxLife">
                    <?php
                    for ($i = 1; $i < 91; $i++) {
                        if ($i == $currentMaxLife) {
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