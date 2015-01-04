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
            //    addNewSwitch($brand, $model, $name, $ip, $access, $username, $password)
            $db->addNewSwitch($newBrand, $newModel, $newName, $newIp, $newAccess, $newUser, $newPassword);
            echo "<h1>New Switch added with success!</h1>";
            ?>


        </div>
        <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
            <button><img src="Css/home-button.jpg" width="75" height="75"></button>
        </a>
        <footer class="mainFooter">
            <p>Copyright &copy; <span>Ethernot Team</span></p>
        </footer>
    </body>
</html>