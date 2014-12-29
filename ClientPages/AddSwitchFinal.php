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
    $newName = $_POST['name'];
    $newBrand = $_POST['brand'];
    $newModel=$_POST['model'];
    $newIp=$_POST['ip'];
    $newAccess=$_POST['access'];
    $newUser=$_POST['user'];
    $newPassword=$_POST['password'];
//    Database db = new dataBase();
//    $ok=db.addNewSwitch(n);
    if(ok){
//        echo
    }
    ?>

    <br>
    <button onclick="goBack()">Go Back</button>
<!--    <button onclick="goBack()">Go Home</button>-->
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