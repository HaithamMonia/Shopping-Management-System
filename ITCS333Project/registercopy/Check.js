var dubEmail;

function CheckEmail(){
    let check = document.getElementById("email").value;
    const xHttp = new XMLHttpRequest();
    xHttp.onload = function(){
        if(this.responseText == "Valid"){
            document.getElementById("EmailMsg").innerHTML = "";
            dubEmail = false;
        }else{
            document.getElementById("EmailMsg").innerHTML = this.responseText;
            dubEmail = true;
        }
    }
    xHttp.open("GET","AJAXPHP.php?testemail="+check);
    xHttp.send();
}

function readyForSubmit(){
    var ftest = /^[a-z\s\d]{1,}$/i;
    if(!ftest.test(document.getElementById('name').value)){
        ErrorBox("Invalid Username Format");
        return false;
    }

    ftest=/^([a-z.0-9_\-+]{1,})@[a-z]{1,}\.[a-z]{1,}$/i;
    if(!ftest.test(document.getElementById('email').value)){
        ErrorBox("Invalid Email Format");
        return false;
    }

    if(dubEmail){
        ErrorBox("Email is Taken. Please enter a new Email or <a href='login.php' style='color:blue;'>Login</a>");
        return false;
    }

    if(document.getElementById("pass").value != document.getElementById("cpass").value){
        ErrorBox("The values under password and confirm password feild do not match");
        return false;
    }

    ftest = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]{8,}$/;
    if(!ftest.test(document.getElementById('pass').value)){
        ErrorBox("<div style='display:inline-block;'>Invalid Password: <ul text-align='left'><li>At least 8 Characters</li><li>At least 1 Upper & Lower Case</li><li>At least 1 Digit</li></ul></div>");
        return false;
    }

    return true;
}

function readyForLogin(){
    var ftest = /^([a-z.0-9_\-+]{1,})@[a-z]{1,}\.[a-z]{1,}$/i;
    if(!ftest.test(document.getElementById('em').value)){
        ErrorBox("Invalid Email Format");
        return false;
    }

    ftest = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]{8,}$/;
    if(!ftest.test(document.getElementById('pass').value)){
        ErrorBox("Invalid Password Format");
        return false;
    }

    return true;
}

function readyForGeneration(){
    var ftest = /^[^\"'*$]{1,}$/;
    if(!ftest.test(document.getElementById('questionGen').value)){
        ErrorBox("Invalid Question Format. No special symbols allowed");
        return false;
    }
    
    var option;
    var count = 2;
    var optid = "op";

    for(var i=1; i<=count; i++){
        optid += i;
        count = document.getElementsByClassName("options").length;
        option = document.getElementById(optid).value;
        if(!ftest.test(option)){
            ErrorBox("Invalid Format for Option "+ i +". No special symbols allowed");
            return false;
        }
        optid = "op";
    }

    return true;
}

var styl;

function ErrorBox(str){
    styl= document.getElementById("ErrBox").style.cssText;
    document.getElementById("ErrBox").style.cssText += "visibility: hidden;background-color: rgba(220,244,206,0.95);transition-duration: 1s; color:black;min-height:250px;padding:8px 10px;text-decoration: none;border-radius:3px;border: 2px solid grey;text-align:center;";
    document.getElementById("ErrBox").style.visibility = "visible";
    document.getElementById("ErrBox").innerHTML = "<div><br><i class=\"fa-solid fa-circle-xmark\" style='font-size:60px;'></i></div>"+"<br>" + str + "<br><br><br><div style='text-align:center;'><button onClick='CloseIt()' style='background-color: #000;color:#fff;width:100px; padding:8px 0;border-radius: 20px;text-align:center; display: '>Retry</button><br></div>";
}

function CloseIt(){
    document.getElementById("ErrBox").style = styl;
    document.getElementById("ErrBox").style.visibility = "hidden";
}

var phpcheck = document.getElementById("PHP").value;

if(phpcheck == 1){
    ErrorBox("Invalid Username");
}else if(phpcheck == 2){
    ErrorBox("Invalid Email");
}else if(phpcheck == 3){
    ErrorBox("The values under password and confirm password field do not match");
}else if(phpcheck == 4){
    ErrorBox("Please Enter a Valid Password");
}else if(phpcheck == 5){
    ErrorBox("Wrong Email");
}else if(phpcheck == 6){
    ErrorBox("Wrong Password");
}else if(phpcheck == 7){
    ErrorBox("Invalid Email or password Format");
}else if(phpcheck >= 9){
    for(var i=1; i<=(phpcheck-10); i++){
        var currentid = "PHPGen";
        currentid += i;
        var Gencheck = document.getElementById(currentid).value;
        addOption(Gencheck);
    }
}

var phpGenCheck = document.getElementById("PollGenPHP").value;

if(phpGenCheck == 1){
    ErrorBox("Some Inputs are Invalid. No special symbols allowed");
}


function addOption(str){
    var optionsContainer = document.getElementById('optionsContainer');
    var optionCount = optionsContainer.getElementsByClassName('options').length + 1;

    document.getElementById("deleteOption").style.visibility="visible";

    var newOptionDiv = document.createElement('div');
    newOptionDiv.className = 'options'; // Set the class attribute
    if(str == null)
        newOptionDiv.innerHTML = '<input type="text" name="option[]" class="input inputt" placeholder="Option ' + optionCount + '" id="op'+optionCount+'" required>';
    else
        newOptionDiv.innerHTML = '<input type="text" name="option[]" class="input inputt" value="'+ str +'" id="op'+optionCount+'" required>';
    
    optionsContainer.appendChild(newOptionDiv);

    return false;
}

function removeOption() {
    var optionsContainer = document.getElementById('optionsContainer');
    var optionDivs = document.getElementsByClassName('options');
    document.getElementById("deleteOption").style.visibility="visible";
    // Ensure there is at least two option left
    if(optionDivs.length <= 3){
        optionsContainer.removeChild(optionDivs[optionDivs.length - 1]);
        document.getElementById("deleteOption").style.visibility="hidden";
    }
    else{
        optionsContainer.removeChild(optionDivs[optionDivs.length - 1]);
    }
    return false;
}