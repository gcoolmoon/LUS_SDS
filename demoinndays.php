<?php
session_start ();
function loginForm() {
    echo '
   <div id="loginform">
   <form action="main.php" method="post">
   <h1> Welcome to INFOTONGUE </h1> 
       <p>Please enter your name to continue:</p>
       <label for="name">Name:</label>
       <input type="text" name="name" id="name" />
       <input type="submit" name="enter" id="enter" value="Enter" />
   </form>
   </div>
   ';
}
 
if (isset ( $_POST ['enter'] )) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes ( htmlspecialchars ( $_POST ['name'] ) );
        $fp = fopen ( "log.html", 'a' );
        fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>" );
        fclose ( $fp );
    } else {
        echo '<span class="error">Please type in a name</span>';
    }
}
 
if (isset ( $_GET ['logout'] )) {
   
    // Simple exit message
    $fp = fopen ( "log.html", 'a' );
    fwrite ( $fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>" );
    fclose ( $fp );
   
    session_destroy ();
    header ( "Location: main.php" ); // Redirect the user
}
 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
body {
    font: 12px arial;
    color: #222;
    text-align: center;
    background-color: black;
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
    width: 940px;
    border: 1px solid #ACD8F0;
}
 
#loginform {
    padding-top: 18px;
}
 
#loginform p {
    margin: 5px;
}
#pic {
    alignment-adjust: central;
    margin: 10px;
    height:270px;
    width: 920px; 
    background-image: url(office.jpg) ;
    background-position: bottom;
    border: 1px solid #ACD8F0;
    
}
#textsize
{
    font-size: 20px;
}
#inner{
			width: 120px;
			height: 120px;
			top: 200px;
                        left:750px;
			margin: 0 auto;
			position: absolute;
			background:orange;
                        border-radius:50%;
		}
#innerright{
			width: 120px;
			height: 120px;
			top: 200px;
                        left:400px;
			margin: 0 auto;
			position: absolute;
			background:orange;
                        border-radius:50%;
		}
#pic1
{
    
    
    
}
#pic2
{
    
}
#chatbox {
    text-align: left;
    margin: 0 auto;
    margin-bottom: 25px;
    padding: 10px;
    background: #fff;
    height: 250px;
    width: 900px;
    border: 1px solid #ACD8F0;
    overflow: auto;
}
 
#usermsg {
    width: 800px;
    border: 1px solid #ACD8F0;
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
 
.left {
    float: left;}
.right {
    float: right;}

.welcome {
    float: left;
}
 
.logout {
    float: right;
}
 
.msgln {
    margin: 0 0 2px 0;
    font-size: 18px;
    width: 100%;
}
.msglnl {
    margin: 0 0 2px 0;
    float: right;
    font-size: 18px;
    text-align: right;
    width: 100%;
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
<title>Chat - Customer Module</title>
</head>
    <body style="margin-top: 0px">
    <?php
   
    
        
 
        ?>
<div id="wrapper">
    <div id="pic" style="background-color: yellow">
        <div id="menu">
            <p class="welcome">
                Welcome, <b><?php echo $_SESSION['name']; ?></b>
            </p>
            <p class="logout">
                <a id="exit" href="#">Exit Chat</a>
            </p>
            <div style="clear: both"></div>
        </div>
        
    </div>
        <div id="chatbox"><?php
        if (file_exists ( "log.html" ) && filesize ( "log.html" ) > 0) {
            $handle = fopen ( "log.html", "r" );
            $contents = fread ( $handle, filesize ( "log.html" ) );
            fclose ( $handle );
           
            echo $contents;
        }
        ?>
        
        </div>
 
        <form name="message" action="">
            <input name="usermsg" type="text" id="usermsg" size="63" /> <input
                name="submitmsg" type="submit" id="submitmsg" value="Send" />
           
        </form>
     
    </div>
    <div id="light" class="white_content">This is the lightbox content. <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Close</a></div>
             <div id="fade" class="black_overlay"></div> 
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
// jQuery Document
$(document).ready(function(){
});
 
//jQuery Document
$(document).ready(function(){
    //If user wants to end session
    $("#exit").click(function(){
        var exit = confirm("Are you sure you want to end the session?");
        if(exit==true){window.location = 'main.php?logout=true';}     
    });
});
 
//If user submits the form
$("#submitmsg").click(function(){
     
     var htmll = $("#usermsg").val();
     var str = htmll;
     var n = str.startsWith("Good");   
     var n1 = str.startsWith("can");
     var n2 = str.startsWith("Nick")
     if (n)
         updateChatbox();
    else if (n1)
        updateChatbox1();
    else if (n2)
        updateChatbox2();
        
    
});
function displayDiv()
{
    document.getElementById('light').style.display='block';
    document.getElementById('fade').style.display='block';
    <?php
    $_SESSION ['confirm'] = true;  
    ?>
}function updateChatbox()
{
    
        var clientmsg = $("#usermsg").val();
        //var empmsg = "something i said is mad";
        //put the messages 
        
        $.post("post.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        loadLog();
        //$.delay(2);
          <?php
    $something = true; 
    ?>
        //$.post("delete.php",{text:clientmsg});
    return false;
}
function updateChatbox1()
{
    
        var clientmsg = $("#usermsg").val();
        //var empmsg = "something i said is mad";
        //put the messages 
        
        $.post("delete.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        loadLog();
        //$.delay(2);
          <?php
    $something = true; 
    ?>
        //$.post("delete.php",{text:clientmsg});
    return false;
}
function updateChatbox2()
{
    
        var clientmsg = $("#usermsg").val();
        //var empmsg = "something i said is mad";
        //put the messages 
        
        $.post("post_1.php", {text: clientmsg});             
        $("#usermsg").attr("value", "");
        loadLog();
        //$.delay(2);
          <?php
    $something = true; 
    ?>
        //$.post("delete.php",{text:clientmsg});
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

 
//setInterval (loadLog, 2500);
</script>
<?php
    
    
    ?>
    <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script type="text/javascript">
</script>
</body>
</html>