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
            require_once("../Server/Database.php");

            $newName = $_POST['name'];
            $newBrand = $_POST['brand'];
            $newModel = $_POST['model'];
            $newIp = $_POST['ip'];
            $newAccess = $_POST['access'];
            $newUser = $_POST['username'];
            $newPassword = $_POST['password'];
            $db = new Database();

            $encryptPw = sha1($newPassword);
            $db->savePassword($newPassword, $encryptPw);
            $db->addNewSwitch($newBrand, $newModel, $newName, $newIp, $newAccess, $newUser, $encryptPw);
            echo "<h1>New Switch added with success!</h1>";

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