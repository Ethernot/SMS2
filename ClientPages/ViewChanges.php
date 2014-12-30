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
        <div class="logs">

            <?php
            require_once("../Server/Database.php");
            $db = new Database();
            $logs = explode("\n", $db->getLogs());
            foreach ($logs as $log) {
                echo '<p>' . $log . '</p>';
            }
            ?>
        </div>
        <footer class="mainFooter">
            <p> Copyright & copy; <span> Ethernot Team </span></p>
        </footer>
    </body>
</html>