<!DOCTYPE html>
<html>
    <head lang="en">
        <meta charset="UTF-8">
        <title>Switch Management Software</title>
        <link rel="stylesheet" type="text/css" href="ClientPages/Css/stylesheet.css"/>
    </head>
    <body>
        <header class="mainHeader">
            <span>S M S</span>
            <span>**Switch Management Software**</span>
        </header>

        <div class="mainContainer">
            <ul>
                <li><a href="ClientPages/Comparison.php">Compare configurations</a></li>
                <li><a href="ClientPages/SwitchManagement.php">Manage Switchs</a></li>
                <li><a href="ClientPages/Settings.php">Settings</a></li>
                <li><a href="ClientPages/ViewChanges.php">Show changes</a></li>
                <?php
                require_once("Server/Database.php");
                echo "history:<br>";
                $db = new Database();
                $a = $db->getSwitchHistory("sw-4210g.dei.uc.pt",0);
                foreach($a as $s){
                    echo $s."<br>";
                }
                ?>
            </ul>
        </div>

        </footer>

        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>

    </body>
</html>
