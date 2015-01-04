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
            if (count($logs) < 1) {
                echo 'Nao ha nada ainda pah';
            } else {
                echo '<table>';
                echo '<thead>';
                echo '<th>Date</th>';
                echo '<th>Time</th>';
                echo '<th>Change</th>';
                echo ' </thead>';
                echo '<tbody>';
                foreach ($logs as $log) {
                    if (strlen($log) > 1) {
                        echo '<tr>';
                        echo '<td>' . explode("*", $log)[0] . '</td>';
                        echo '<td>' . explode("*", $log)[1] . '</td>';
                        echo '<td>' . explode("*", $log)[2] . '</td>';
                        echo ' </tr>';
                    }
                }
                echo ' </tbody>';
                echo '</table>';
            }
            ?>
            <br>
            <a href="../index.php">
                <button><img src="Css/home-button.jpg" width = "75" height="75"></button>
            </a>
        </div>
        <footer class="mainFooter">
            <p> Copyright & copy; <span> Ethernot Team </span></p>
        </footer>
    </body>
</html>
