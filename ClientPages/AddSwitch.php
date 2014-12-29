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

    $switchesBrandList = array("aaaaaaaa", "bbbbbbbbbb", "cccccccccccc");
    $switchesModelList = array("ddddddd", "eeeeeeeee", "ffffffffffff");

    if (count($switchesBrandList) > 0) {
        echo '<form id="add" action="AddSwitchFinal.php" method="post">';
        echo "<label> Brand: </label>";
        echo '<select name="brand" id="sel1" oninput="activeModelSelect()">';
        //<!--todo:  alterar o tipo de letra dos selects-->
        echo '<option disabled="disabled" selected="selected">Please select a brand</option>';
        foreach ($switchesBrandList as $a) {
            if (strlen($a) > 0) {
                echo '<option value=' . $a . '>' . $a . '</option>';
            }
        }
        echo '</select>';
        echo "<br>";
        echo "<label> Model: </label>";
        echo '<select name="model" id="sel2" disabled="true">';
        echo '<option disabled="disabled" selected="selected">Please select a model</option>';
        foreach ($switchesModelList as $a) {
            if (strlen($a) > 0) {
                echo '<option value=' . $a . '>' . $a . '</option>';
            }
        }
        echo '</select>';
        echo '<br><label>Name: </label><input type="text" name="name" required="true">';
        echo '<br><label>IP: </label><input type="text" name="ip" required="true">';
        echo '<br><label>Accessed by: </label> <br>';
        echo '<input type="radio" name="access" value="ssh" checked="true"> SSH <br>';
        echo '<input type="radio" name="access" value="telnet"> Telnet <br>';
        echo '<label>Username: </label><input type="text" name="username" required="true">';
        echo '<br><label>Password: </label><input type="password" name="password" required="true" oninput="activeButtons()">';
        echo "<br>";
        echo "<input type='submit' value='Add switch' id='as' disabled='true'>";
        echo "</form>";
    } else {
        echo "No switches inserted <br><br>";
    }
    ?>
<button onclick="goBack()"> Go Back</button>
</div>

<script language="javascript">
//    function addSwitch(){
//        var brand=document.getElementById("sel1").value;
//        var model=document.getElementById("sel2").value;
//        var name=document.getElementById("name").value;
//        var ip=document.getElementById("ip").value;
//        var access=getRadioVal(document.getElementById("add"),"access");
//        var username=document.getElementById("username").value;
//        var password=document.getElementById("password").value;
////        todo: fazer classe e funcao para inserir novo switch
////        var ok=<?php ////className.addNewSwitch(brand,model,name,ip,access,username,passord); ?>
//        var ok=true;
//        if(true){
//            alert("New switch added with success!");
//            document.getElementById("add").action="../index.php";
//        }else{
//            alert("Error inserting new switch...")
//        }
//    }
//
//    function getRadioVal(form, name) {
//        var val;
//        var radios = form.elements[name];
//        for (var i=0, len=radios.length; i<len; i++) {
//            if ( radios[i].checked ) {
//                val = radios[i].value;
//                break;
//            }
//        }
//        return val;
//    }
    function activeModelSelect() {
        document.getElementById("sel2").disabled = false;
    }
    function activeButtons() {
        document.getElementById("as").disabled = false;
    }
    function goBack() {
        window.history.back()
    }
</script>
<footer class="mainFooter">
    <p> Copyright & copy; <span> Ethernot Team </span></p>
</footer>
</body>
</html>