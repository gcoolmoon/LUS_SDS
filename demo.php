<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
body {
    font: 12px arial;
    color: #222;
    text-align: center;
    padding: 35px;
}
 
form,p,span {
    margin: 0;
    padding: 0;
}
 
input {
    font: 12px arial;
}
 
a {
    color: #0000FF;
    text-decoration: none;
}
 
a:hover {
    text-decoration: underline;
}
 
#wrapper,#loginform {
    margin: 0 auto;
    padding-bottom: 25px;
    background: #EBF4FB;
    width: 504px;
    border: 1px solid #ACD8F0;
}
 
#loginform {
    padding-top: 18px;
}
 
#loginform p {
    margin: 5px;
}
#pic {
    margin: 10px;
    height:270px;
    width: 100%;    
    border: 1px solid #ACD8F0;
    
}
#chatbox {
    margin: 10 auto;
    margin-bottom: 25px;
    background: #fff;
    height: 70px;
    width: 100%;
    border: 1px solid #ACD8F0;
    overflow: auto;
}
#msgbox{
    margin: 10px;
    height:40px;
    width: 800px;    
    border: 1px solid #ACD8F0;
}
#usermsg {
    padding-top: 5px;
    width: 295px;
}
 
#submit {
    
    width: 60px;
}
 
.error {
    color: #ff0000;
}
 
#menu {
    padding: 12.5px 25px 12.5px 25px;
}
 
.welcome {
    float: left;
}
 
.logout {
    float: right;
}
 
.msgln {
    margin: 0 0 2px 0;
}
.black_overlay{
	display: none;
	position: absolute;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: black;
	z-index:1001;
	-moz-opacity: 0.8;
	opacity:.80;
	filter: alpha(opacity=80);
}

.white_content {
	display: none;
	position: absolute;
	top: 25%;
	left: 25%;
	width: 50%;
	height: 50%;
	padding: 16px;
	border: 16px solid orange;
	background-color: white;
	z-index:1002;
	overflow: auto;
}
</style>
    </head>
    <body>
        
        <?php
        // put your code here
        ?>
        <div id="pic">
        </div>
        <div id="chatbox">
        </div>
        <div id="msgbox"
        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" />
            
            <input
                name="submitmsg" type="submit" id="submitmsg" value="Send" />
           
        </form>
        </div>
        <script type="text/javascript">
            $("#submitmsg").click(function(){
                
            updateChatbox();
            function updateChatbox()
{
    
        var clientmsg = $("#usermsg").val();
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "hi");
        loadLog;
    return false;
}
function loadLog(){    
    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
    $.ajax({
        url: "log.html",
        cache: false,
        success: function(html){       
            $("#chatbox").html(html); //Insert chat log into the #chatbox div  
           
            //Auto-scroll          
            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
            if(newscrollHeight > oldscrollHeight){
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }              
        },
    });
}
    
});
        </script>
    </body>
</html>
