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

            <form action="#" method="post">
                <label>Time of the backup</label>
                <input type="time" name="time" >
                <br>
                <label>Interval of the backup</label>
                <select>

                </select>
                <br>
                <input type="SUBMIT" value="Save">
            </form>
        </div>
        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>