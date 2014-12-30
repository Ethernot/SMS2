<!DOCTYPE html>
<html>
<head lang="en" >

    <meta charset="UTF-8">
    <title>Switch Management Software</title>
    <link rel="stylesheet" type="text/css" href="Css/stylesheet.css"/>
</head>
<body >
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
    $switchesNameList = explode(",", $info);
    error_reporting(0);
    $postedName=$_POST['name'];
    $postedOption=$_POST['option'];
    error_reporting(1);
    if(strcmp($postedOption,"enabled")){
        $db->enableSwitch($postedName);
    }else if(strcmp($postedOption,"disabled")){
        $db->enableSwitch($postedName);
    }
    echo "<h1>Control Panel: all switches: </h1>";
    $i=0;
    foreach ($switchesNameList as $a) {
        echo "<form action='CheckAllSwitches.php' method='post' id='".$i."' >";
        echo "<label >Switch name: " . $a . "</label><br>";
//        if ($db->isSwichtEnabled($a)) {
        if (ed($a)) {
            echo "<input type='hidden' name='name' value=".$a.">";
            echo 'Enable <input type="radio" name="option" checked="true" value="enable" onchange="activeForm('. $i.')">';
            echo 'Disabled <input type="radio" name="option" value="disable" onchange="activeForm('.$i.')">';
        }else{
            echo 'Enable <input type="radio" name="option" value="enable" onchange="activeForm('.$i.')">';
            echo 'Disabled <input type="radio" name="option" checked="true" value="disable" onchange="activeForm('.$i.')">';
        }
        $i++;
        echo "</form>";
    }
    function ed($name){
        $a=rand(1,100);
        if($a<50)
            return true;
        return false;
    }
    ?>
    <br>
    <a href="../index.php">
        <button>Go Home</button>
    </a>
</div>

<script>
    function activeForm(form){
        alert(form);
        document.getElementById(form).submit();
    }
</script>

<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>