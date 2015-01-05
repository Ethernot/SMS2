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
    $ip = $_POST['ip'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $access = $_POST['access'];
    require_once("../Server/Database.php");
    $db=new Database();
    if(strcmp($access[0],'s')==0){
        require_once("../Server/ssh.php");
        $ok=sshswitch($ip,$username,$db->getPwSha1($password),$name,1);
        if($ok){
            echo "<h1>Backup sucessfully!</h1>";
        }else{
            echo "<h1>Backup error, an email was sent</h1>";
        }
    }else{
        require_once("../Server/telnet.php");
        $ok=telnetswitch($ip,$username,$db->getPwSha1($password),$name,1);
        if($ok){
            echo "<h1>Backup sucessfully!</h1>";
        }else{
            echo "<h1>Backup error, an email was sent</h1>";
        }
    }

    echo "<h1>Backup sucessfully!</h1>"
    ?>
</div>

<a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
    <button class="home"><img src="Css/home.png" width="75" height="75"></button>
</a>

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