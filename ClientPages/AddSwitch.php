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
    <h1>Add new Switch: </h1>

    <?php

    require_once("../Server/Database.php");
    $db = new Database();
    $info = $db->getBrands();
    $switchesBrandList=explode("\n",$info);
    error_reporting (0);
    $brandSelected=$_POST['brand'];
    error_reporting (1);

    if (count($switchesBrandList) > 0) {
        echo '<form id="f1" action="AddSwitch.php" method="post">';
        echo "<label> Brand: </label>";
        echo '<select name="brand" id="sel1" oninput="activeModelSelect()">';
        //<!--todo:  alterar o tipo de letra dos selects-->
        echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
        $i=1;
        foreach ($switchesBrandList as $a) {
            if (strlen($a) > 0) {
                if($brandSelected==$i){
                    echo '<option selected="selected" value=' . $i++ . '>' . $a . '</option>';
                }else{
                    echo '<option value=' . $i++ . '>' . $a . '</option>';
                }
            }
        }
        echo '</select>';
        echo "<br>";
        echo "<span id='teste'> </span>";
        echo "</form>";
        if($brandSelected>0){
            $infoModels=$db->getModelByBrands($switchesBrandList[$brandSelected-1]);
            $switchesModelList=explode(",",$infoModels);
        }
        echo '<form action="AddSwitchFinal.php" method="post">';
        echo '<input type="hidden" name="brand" value="'.$brandSelected.'">';
        echo "<label> Model: </label>";
        if($brandSelected==0) {
            echo '<select name="model" id="sel2" disabled="true" required="required" onclick="activeButtons2()">';
        }else{
            echo '<select name="model" id="sel2" required="required" onclick="activeButtons2()">';
        }
        echo '<option disabled="disabled" selected="selected" >Please select a model</option>';
        $i=1;
        foreach ($switchesModelList as $a) {
            if (strlen($a) > 1) {
                echo '<option value=' . $i++ . '>' . $a . '</option>';
            }
        }
        echo '</select>';
        echo '<br><label>Name: </label><input type="text" name="name" required="true">';
        echo '<br><label>IP: </label><input type="text" name="ip" required="true">';
        echo '<br><label>Accessed by: </label> <br>';
        echo '<input type="radio" name="access" value="ssh" checked="true"> SSH <br>';
        echo '<input type="radio" name="access" value="telnet"> Telnet <br>';
        echo '<label>Username: </label><input type="text" name="username" required="true">';
        echo '<br><label>Password: </label><input type="password" name="password" id="pass" required="true" oninput="activeButtons()">';
        echo "<br>";
        echo "<input type='submit' value='Add switch' id='as' disabled='true'>";
        echo "</form>";
    } else {
        echo "No switches inserted <br><br>";
    }
    ?>
</div>

    <a href="../index.php" style="float: left;margin: 0 48% 1.5% 48%">
        <button><img src="Css/home-button.jpg" width="75" height="75"></button>
    </a>

<script language="javascript">
    function activeModelSelect() {
        document.getElementById("sel2").disabled = false;
        document.getElementById("f1").submit();
    }
    function activeButtons() {
        var a = document.getElementById("sel2").value;
        if(a!="Please select a model")
            document.getElementById("as").disabled = false;
    }
    function activeButtons2() {
        var a = document.getElementById("pass").value;
        if(a!="")
            document.getElementById("as").disabled = false;
    }
</script>
<footer class="mainFooter">
    <p> Copyright & copy; <span> Ethernot Team </span></p>
</footer>
</body>
</html>