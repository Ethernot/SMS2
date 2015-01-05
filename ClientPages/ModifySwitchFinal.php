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
            $oldName = $_POST['oldName'];
            $newBrand = $_POST['newBrand'];
            $newModel = $_POST['newModel'];
            $newModel = str_replace("*", " ", $newModel);
            $newName = $_POST['newName'];
            $newIp = $_POST['newIp'];
            $newAccess = $_POST['newAccess'];
            $newUser = $_POST['newUser'];
            $newPassWord = $_POST['newPassWord'];
            require_once("../Server/Database.php");
            $db = new Database();
            $db->modifySwitchInfo($oldName, $newBrand, $newModel, $newName, $newIp, $newAccess, $newUser, $newPassWord);
            ?>

            <h1>Switch modified successfully!</h1>

        </div>
        <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
            <button class="home"><img src="Css/home.png" width="75" height="75"></button>
        </a>
        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>