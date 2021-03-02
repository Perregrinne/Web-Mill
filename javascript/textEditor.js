//Keep track if changes were made in the text editor:
window.textEdited = false;
function changesMade() {
    window.textEdited = true;
}

//Start the editor:
function start() {
    //Create the editor textbox:
    window.editor = ace.edit("ace-editor");
    window.editor.setTheme("ace/theme/twilight");
    window.editor.session.setMode("ace/mode/javascript");
    document.getElementById('ace-editor').style.fontSize='16px';
}

//On this page, we don't need the admin-right panel getting in the way,
//so hide it:
document.getElementById("admin-r-menu").style.visibility = "hidden";
document.getElementById("admin-r-control").style.visibility = "hidden";

//Ask the user about leaving if changes were made to the text:
var formSubmitting = false; //If form submitted or a button was clicked, ignore calling the function.
var setFormSubmitting = function() { formSubmitting = true; };

window.onload = function() {
    window.addEventListener("beforeunload", function (e) {
        if (formSubmitting || window.textEdited === false) {
            return undefined;
        }
        //Chrome automatically has its own message, but as a fall-back:
        var confirmationMessage = 'If you leave now, your changes will not be saved.';
        (e || window.event).returnValue = confirmationMessage;
        return confirmationMessage;
    });
};

//New File function:
function newFile() {
    if(window.textEdited) {
        //The warning popup:
        var warnMsg = document.createElement("div");
        warnMsg.id = "unsaved-warning";
        warnMsg.style.position = "fixed";
        warnMsg.style.left = "30%";
        warnMsg.style.right = "30%";
        warnMsg.style.top = "30%";
        warnMsg.style.bottom = "30%";
        warnMsg.style.background = "rgba(255, 255, 255, 0.7)";
        warnMsg.style.color = "rgba(0, 0, 0, 0.9)";
        warnMsg.style.borderRadius = "10px";
        warnMsg.style.zIndex = "100";
        warnMsg.style.padding = "25px";
        warnMsg.style.textAlign = "center";
        warnMsg.style.fontSize = "x-large";
        warnMsg.innerText = "Reload Template? Changes You made may not be saved.";

        //The "Yes" button:
        var yesBttn = document.createElement("div");
        yesBttn.id = "unsaved-yes";
        yesBttn.style.position = "fixed";
        yesBttn.style.left = "40%";
        yesBttn.style.top = "55%";
        yesBttn.style.background = "rgba(255, 255, 255, 0.8)";
        yesBttn.style.color = "rgba(0, 0, 0, 0.9)";
        yesBttn.style.borderRadius = "10px";
        yesBttn.style.zIndex = "101";
        yesBttn.style.padding = "15px";
        yesBttn.style.minWidth = "75px";
        yesBttn.style.textAlign = "center";
        yesBttn.style.fontSize = "xx-large";
        yesBttn.innerText = "Yes";
        warnMsg.appendChild(yesBttn);

        //And the "No" button:
        var noBttn = document.createElement("div");
        noBttn.id = "unsaved-no";
        noBttn.style.position = "fixed";
        noBttn.style.right = "40%";
        noBttn.style.top = "55%";
        noBttn.style.background = "rgba(255, 255, 255, 0.7)";
        noBttn.style.color = "rgba(0, 0, 0, 0.8)";
        noBttn.style.borderRadius = "10px";
        noBttn.style.zIndex = "101";
        noBttn.style.padding = "15px";
        noBttn.style.minWidth = "75px";
        noBttn.style.textAlign = "center";
        noBttn.style.fontSize = "xx-large";
        noBttn.innerText = "No";
        warnMsg.appendChild(noBttn);

        document.body.appendChild(warnMsg);

        //Add functionality to those buttons:
        document.getElementById("unsaved-yes").addEventListener("click", function() {
            willSave = false;
            hasDecided = true;
            document.body.removeChild(document.getElementById("unsaved-warning"));

            //First unset that changes have been made:
            window.textEdited = false;

            //TODO: Decide which template to load in!-----------------------------------------------

            //Reset to the default text for Javascript:
            window.editor.setValue('alert("Hello World!");');

            //Reset to the default text for PHP:
            //window.editor.setValue('<?php echo "Hello World!"; ?>');
            //TODO: Make a proper template that includes header.php, etc.

            //Reset to the default text for HTML:
            //TODO: Make a template here...

            //Reset to the default text for CSS:
            //TODO: Make a template here...

            //Reset to the default text for TXT:
            //window.editor.setValue('alert("Hello World!");');
    
        });
        document.getElementById("unsaved-no").addEventListener("click", function() {
            willSave = true;
            hasDecided = true;
            document.body.removeChild(document.getElementById("unsaved-warning"));
        });
    } 
    
}