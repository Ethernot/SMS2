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
    $brand=$_POST['brand'];
    $model=$_POST['model'];
    $name=$_POST['name'];
//    $actualInfo = ClassName.getSwitchInfo(brand,model,name);
    $actualInfo = "aa,bb,cc,dd,ee,ff,gg";
    $actualInfoArray = explode(",",$actualInfo);
    echo "<h1> Switch ".$actualInfoArray[2]." Details: </h1>";
    echo "<label> Brand: ".$actualInfoArray[0]." </label>";
    echo "<a href='#'>Check history</a> <br>";
    echo "<label> Model: ".$actualInfoArray[1]." </label>";
    echo "<a href='#'>Check history</a> <br>";
    echo "<label> Name: ".$actualInfoArray[2]." </label>";
    echo "<a href='#'>Check history</a> <br>";
    echo "<label> IP: ".$actualInfoArray[3]." </label>";
    echo "<a href='#'>Check history</a> <br>";
    echo "<label> Access by: ".$actualInfoArray[4]." </label>";
    echo "<a href='#'>Check history</a> <br>";
    echo "<label> user: ".$actualInfoArray[5]." </label>";
    echo "<a href='#'>Check history</a> <br>";
    ?>
    <a href="ModifySwitch.php"><button>Modify this switch</button></a>
<br>
<button onclick="goBack()">Go Back</button>
</div>



<script>
    function goBack() {
        window.history.back()
    }
</script>
<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>