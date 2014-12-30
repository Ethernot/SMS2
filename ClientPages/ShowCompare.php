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
    error_reporting(0);
    $name = $_POST['name'];
    $conf1 = $_POST['conf1'];
    $conf2 = $_POST['conf2'];
    error_reporting(1);
    echo $name."<br>";
    echo $conf1;
//    $file = file_get_contents('configs/' . $name . '/' . $conf, true);
//    echo $file;
    ?>
</div>

<div class="mainContainer">
    <?php
    $file = file_get_contents('configs/' . $name . '/' . $conf2, true);
    echo $file;
    ?>
</div>

<br>
<button onclick="goBack()">Go Back</button>

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