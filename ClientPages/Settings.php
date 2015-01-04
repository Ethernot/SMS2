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
<h1>Settings:</h1>
    <?php
    require_once("../Server/Database.php");
    $db = new Database();
//    echo "<label>Server get Configurations interval: ".db->getKKKKK." days </label>";
    echo "<form id='f' action='Settings.php' method='post'>";
    echo "<label> update interval: </label>";
    echo "</form>";

    ?>

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