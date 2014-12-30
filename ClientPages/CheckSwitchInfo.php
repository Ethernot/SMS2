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

echo"
<div class="mainContainer">
    <?php
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $name = $_POST['name'];
    require_once("../Server/Database.php");
    $db = new Database();
    $actualInfo = $db->getSwitchInfoByInt($brand, $model, $name);
    //    echo "..."+$name;
    $actualInfoArray = explode(",", $actualInfo);
    ?>
    <?php
    echo "<h1> Switch Details: </h1>";
    echo "<label> Brand: " . $actualInfoArray[1] . " </label><br>";
    echo "<label> Model: " . $actualInfoArray[2] . " </label><br>";
    echo "<label> Name: " . $actualInfoArray[0] . " </label><br>";
    echo "<label> IP: " . $actualInfoArray[3] . " </label><br>";
    echo "<label> Access by: " . $actualInfoArray[6] . " </label><br>";
    echo "<label> user: " . $actualInfoArray[4] . " </label><br>";

    echo "<form action='ModifySwitch.php' method='post'>";
    echo "<input type='hidden' value='" . $actualInfo . "'>";
    echo "<input type='submit' value='Modify'>";
    echo "</form>";

//historico de configurações

    ?>
    <a href="SwitchManagement.php">
        <button>Get back</button>
    </a>
</div>


<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>