<?php //This is the real text editor, under development. For now, use the Ace Editor. ?>
<html>
<head>
    <?php 
        include_once($_SERVER["DOCUMENT_ROOT"] . "/php/header.php");
    ?>
</head>
<body>
    <div id="text-page-wrapper">
        <div id="menu-bar">&nbsp;
        </div>
        <div id="text-container">
            <div id="line-number">1</div>
            <div id="line-border">&nbsp;</div>
            <textarea id="text-field" autofocus wrap="soft">TtRrfF
            gGhHiIljJk
            KwWqQp
            PoOzZ</textarea>
        </div>
    </div>
</body>
<script>

//The page starts out with 1 line:
var lineNum = 1;

var textField = document.getElementById("text-field");
textField.addEventListener("keydown", function(e){
    if (e.key === "Enter") {
        lineNum += 1;
        document.getElementById("line-number").innerHTML += "<br/>" + lineNum;
    }
});

document.addEventListener("DOMContentLoaded", function(event){
    
});
</script>
</html>