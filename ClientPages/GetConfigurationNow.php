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
    $name = $_POST['name'];
//    require_once("../Server/Database.php");
//    $db = new Database();
//    todo: funcao para getConfiguration now
//    todo:servidor
    //funcao para get conf now e mensagem de sucesso
    ?>
    <button onclick="goBack()"> Go Back</button>
</div>

<script>
    function goBack() {
        window.history.back()
    }
</script>
<footer class="mainFooter">
    <p> Copyright & copy; <span> Ethernot Team </span></p>
</footer>
</body>
</html>