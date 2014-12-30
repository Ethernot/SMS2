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
    //    $brand=$_POST['brand'];
    //    $model=$_POST['model'];
    $name = $_POST['name'];
    require_once("../Server/Database.php");
    $db = new Database();
    $actualInfo = $db->getSwitchInfo($name);
    $actualInfoArray = explode(",", $actualInfo);
    ?>
    <?php
    echo "<h1> Switch Details: </h1>";
    echo "<label> Brand: " . $actualInfoArray[1] . " </label>";
    echo "<label> Model: " . $actualInfoArray[2] . " </label>";
    echo "<label> Name: " . $actualInfoArray[0] . " </label>";
    echo "<label> IP: " . $actualInfoArray[3] . " </label>";
    echo "<label> Access by: " . $actualInfoArray[6] . " </label>";
    echo "<label> user: " . $actualInfoArray[4] . " </label>";
    echo "<label> Password: " . $actualInfoArray[5] . " </label>";

    echo "<form action='ModifySwitch.php' method='post'>";
    echo "<input type='hidden' value='".$name."'>";
    echo "<input type='submit' value='Modify'>";
    echo "</form>"

    ?>
    <button onclick="goBack()">Go Back</button>
</div>

<?php
function modifyInfo($i, $newValue)
{
    echo($i);
    echo($newValue);
}

?>
//name,brand,model,ip,user,pass,acess
// 0 1 2 3 4 5 6
<script>
    function goBack() {
        window.history.back()
    }
    function getHistory(index) {
        alert(index);
    }
    function modify(index) {
        alert("modify");
        var newBrand, newModel, newName, newIp, newTypeAccess, newUser, newPassword;
        switch (index) {
            case 0:
                newName = prompt("Insert a new name: ");
            <?php modifyInfo(index,newName) ?>
                break;
            case 1:
                newBrand = prompt("Insert a new brand: ");
            <?php modifyInfo(index,newBrand) ?>
                break;
            case 2:
                newModel = prompt("Insert a new model: ");
            <?php modifyInfo(index,newModel) ?>
                break;
            case 3:
                newIp = prompt("Insert a new IP: ");
            <?php modifyInfo(index,newIp) ?>
                break;
            case 4:
                newUser = prompt("Insert a new user: ");
            <?php modifyInfo(index, newUser) ?>
                break;
            case 5:
                newPassword = prompt("Insert a new password: ");
            <?php modifyInfo(index,newPassword) ?>
                break;
            case 6:
                newTypeAccess = prompt("Insert a new type of access: ");
            <?php modifyInfo(index,newTypeAccess) ?>
                break;
            default:
                break;
        }
    }
    function saveChanges() {
        alert("save");
    }
</script>

<footer class="mainFooter">
    <p>Copyright &copy; <span>Ethernot Team</span></p>
</footer>
</body>
</html>