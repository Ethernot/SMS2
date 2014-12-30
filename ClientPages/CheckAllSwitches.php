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
    $db = new Database();
//    $info = $db->getAllSwitchesName();
    $info = "11,222,333,4,555,6666";
    $switchesNameList = explode(",",$info);
    error_reporting(0);

    error_reporting(1);
    echo "<h1>Control Panel: all switches: </h1>";
    foreach($switchesNameList as $a){
        echo "<form action='CheckAllSwitches.php' method='post'>";
        echo "<label>Switch name: ".$a."</label>";
        if($db->isSwichtEn)
        echo "<input type='radio' name='alter' value='Enable'>";
        echo "<input type='radio' name='alter' value='Disable'>";
        echo "</form>";
    }
    ?>


<br>
<a href="../index.php"><button>Go Home</button></a>
</div>

<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>