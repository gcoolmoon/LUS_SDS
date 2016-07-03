<?php
session_start();

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

if (isset($_POST ['enter'])) {
    if ($_POST ['name'] != "") {
        $_SESSION ['name'] = stripslashes(htmlspecialchars($_POST ['name']));
        $fp = fopen("log.html", 'a');
        fwrite($fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has joined the chat session.</i><br></div>");
        fclose($fp);
    } else {
        echo '<span class="error">Please type in a name</span>';
    }
}

if (isset($_GET ['logout'])) {

    // Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User " . $_SESSION ['name'] . " has left the chat session.</i><br></div>");
    fclose($fp);

    session_destroy();
    header("Location: main.php"); // Redirect the user
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
                padding: 35px;
            }

            form,p,span {
                margin: 0;
                padding: 0;
            }
            ul#proList{list-style-position: inside}
            li.listitem{list-style:none; padding:5px;}
            li:hover {
             background-color:#2EA620;
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
                border: 1px solid #ACD8F0;
            }

            #loginform {
                padding-top: 18px;
            }

            #loginform p {
                margin: 5px;
            }

            #chatbox {
                text-align: left;
                margin: 0 auto;
                margin-bottom: 25px;
                padding: 10px;
                background: #fff;
                height: 550px;
                width: 930px;
                border: 1px solid #ACD8F0;
                overflow: auto;
            }

            #usermsg {
                width: 395px;
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

            .welcome {
                float: left;
            }

            .logout {
                float: right;
            }
            .msglnl{
                margin: 0 0 2px 0;
                float: right;
                font-size: 18px;
                text-align: right;
                width: 100%;
            }
            .msgln {
                margin: 0 0 2px 0;
                font-size: 18px;
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
        <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"></link>
        <script type = "text/javascript" 
         src = "http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script type="text/javascript"
        src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
        <script type="text/javascript">
        </script>
    </head>
    <body>
        <?php
        if (!isset($_SESSION ['name'])) {
            loginForm();
        } else {

            //if(!isset ( $_POST['submitmsg'] ))
            //{
            ?>        
            <script type = "text/javascript" >
                loadLog();
                //loadLog();
            </script>
            <div id="wrapper">
                <div id="menu">
                    <p class="welcome">
                        Welcome, <b><?php echo $_SESSION['name']; ?></b>
                    </p>
                    <p class="logout">
                        <a id="exit" href="#">Exit Chat</a>
                    </p>
                    <div style="clear: both"></div>
                </div>
                <div id="chatbox"><?php
//                    if (file_exists("log.html") && filesize("log.html") > 0) {
//                        $handle = fopen("log.html", "r");
//                        $contents = fread($handle, filesize("log.html"));
//                        fclose($handle);
//
//                        echo $contents;
//                    }
                    ?></div>
                <!--here we will define the modal which will display a confirmation page.
                *********************************************************************** --> 
                <div id="modalopt" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <!--<ul id="proList"></ul>-->
                             <span onclick="document.getElementById('modalopt').style.display = 'none'" class="w3-closebtn">&times;</span>
                            <p id="confirmMsgopt"></p>
                            <button id="yes" onclick="showUser()"> Yes </button>
                            <button id="No" onclick="document.getElementById('modalopt').style.display = 'none'"> No </button>
                        </div>
                    </div>
                </div>
                <div id="modal" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('modal').style.display = 'none'" class="w3-closebtn">&times;</span>
                            <p id="confirmMsg"></p>
                            <button id="yes" onclick="showUser()"> Yes </button>
                            <button id="No" onclick="document.getElementById('modal').style.display = 'none'"> No </button>
                        </div>
                    </div>
                </div>
                <div id="modalsec" class="w3-modal">
                    <div class="w3-modal-content">
                        <div class="w3-container">
                            <span onclick="document.getElementById('modalsec').style.display = 'none'" class="w3-closebtn">&times;</span>
                            <p id="confirmMsgsec"></p>
                            <button id="yessec" onclick="updateChatbox()"> Yes </button>
                            <button id="Nosec" onclick="document.getElementById('modalsec').style.display = 'none'"> No </button>
                        </div>
                    </div>
                </div>
                <!--*************end of definition*************************************--> 
                <form name="message" action="">
                    <input name="usermsg" type="text" id="usermsg" size="63" /> 
        <!--            <input
                        name="submitmsg" type="submit" id="submitmsg" onclick="showUser()" value="Send" />-->
                    <input  name="confirm" type="button" id="submitmsg" onclick="onStartASR(event)" value="Ask"/>
                    <!--<button id="ASR_BUTTON" onclick="onStartASR(event)">START ASR</button>-->
                </form>

            </div>


            <div id="light" class="white_content">This is the lightbox content. <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display = 'none';
                                document.getElementById('fade').style.display = 'none'">Close</a></div>
            <div id="fade" class="black_overlay"></div>
<!--            <script type="text/javascript"
            src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>-->
 
	
            <script type = "text/javascript" >
                var recognizing = false;
                var ASR = new webkitSpeechRecognition();
                var TTS = new SpeechSynthesisUtterance();
                var voices = window.speechSynthesis.getVoices();
                var response = "nothing";
                ASR.interimResults = false;
                ASR.lang = 'en-US';
                ASR.maxAlternatives = 10;
                ASR.continuous = false;
                var y = $("#usermsg").val();
                var clientmsg;
                resMsg = "something";
                localStorage.setItem('clientmesg', y);

                ASR.onstart = function () {
                    recognizing = true;
                    console.log('started recognition');
                    $("#submitmsg").val('STOP ASR');
                };


                ASR.onend = function () {
                    recognizing = false;
                    console.log('stopped recognition');
                    $("#submitmsg").val('START ASR');
                };

                ASR.onresult = function (event) {
                    console.log(event);
                    var options = [];
                    for (var i = 0; i < event.results.length; ++i) {
                        if (event.results[i].isFinal) {
                            for (var j = 0; j < event.results[i].length; ++j) {
                                transcript = event.results[i][j].transcript;
                                confidence = event.results[i][j].confidence;
                                console.log('result:' + transcript + ' conf:' + confidence);
                                //if (event.results[i][j] > 0)
                                options.push(event.results[0][j].transcript);
                            }
                            if (event.results[0][0].confidence > 0){
                                best_transcript = event.results[0][0].transcript;
                                document.getElementById("confirmMsgopt").innerHTML = "Do you mean : "+ best_transcript+"?";
                                document.getElementById('modalopt').style.display = 'block';
                                startTTS("Do you mean : "+best_transcript+"?");
                                $("#usermsg").val(best_transcript);
                            }
                            else
                            {
                                best_transcript = "Please say again i did not understand.";
                                startTTS(best_transcript);
                            }
                            
                            //fillOptions(options);
                            // $("#usermsg").val(best_transcript);
                        }
                    }
                    //showUser();
                };

                function onStartASR(event) {
                    ASR.start();
                    console.log('onStartASR Pressed to start recognition');
                }

                ASR.onerror = function (event) {
                    console.log(event);
                };
                function fillOptions(options)
                {
                    //var myDiv = document.getElementById("modalopt");
//                    var div1 = document.createElement('div');
//                    div1.setAttribute('class','w3-modal-content');
//                    var div2 = document.createElement('div');
//                    div2.setAttribute('class','w3-container');
//                    var ull = document.createElement('ul');
//                    ull.setAttribute('id', 'proList');
                    

                    var t, tt;
                    //productList = ['Electronics Watch', 'House wear Items', 'Kids wear', 'Women Fashion'];

                    var ull = document.getElementById('proList');
//                    div1.appendChild(div2);
//                    div2.appendChild(ull);
                    //options.forEach(renderProductList());
                    for (var i = 0; i < 5; i++)
                    {
                        var lii = document.createElement('li');
                        lii.setAttribute('class', 'listitem');
                        
                        ull.appendChild(lii);
                        //lii.
                        
//                        var div3 = document.createElement('div');
//                        div3.setAttribute('class','valList');
//                        li.appendChild(div3)
                        //t = document.createTextNode(element);
                        console.log(options[i]);
                        li.innerHTML = options[i]+"<a href='#'>"+options[i]+"</a>";
                    }

                    document.getElementById('modalopt').style.display = 'block';

                }

                function getOption()
                {
                    $(".listing").click(function () {
                        var list_id = $(this).find(".id_align").val(); // to fetch current current id_align
                        var location = "/create_review/" + list_id;
                        window.location.href = location;
                    });
                }
                function updateOption(message){
                    if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                        } else {
                            // code for IE6, IE5
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                document.getElementById("confirmMsgsec").innerHTML = message;
                                document.getElementById('modalopt').style.display = 'block';
                            }
                        };
                        xmlhttp.open("GET", "manager.php?fname=chkIOB&q=" + clientmsg + "&p=" + state + "&usrmsg=" + clientmsg, true);
                        xmlhttp.send();
                }
                function checkIOB() {

                    clientmsg = $("#usermsg").val();
                    document.getElementById('modal').style.display = 'none';
                    str = "input";
                    
                    if (str == "") {
                        document.getElementById("txthint").innerHTML = "";
                        return;
                    } else {
                        if (window.XMLHttpRequest) {
                            // code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp = new XMLHttpRequest();
                        } else {
                            // code for IE6, IE5
                            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                texttospeak = xmlhttp.responseText;
                                document.getElementById("confirmMsgsec").innerHTML = texttospeak;
                                document.getElementById('modalsec').style.display = 'block';                                
                                 startTTS(texttospeak);
                               
                            }
                        };
                        xmlhttp.open("GET", "manager.php?fname=chkIOB&q=" + clientmsg + "&p=" + state + "&usrmsg=" + clientmsg, true);
                        xmlhttp.send();
                    }
                }
                function showUser() {

                    document.getElementById('modalopt').style.display = 'none';
                    str = "me";
                    state = "0";
                    clientmsg = $("#usermsg").val();

                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            document.getElementById("confirmMsg").innerHTML = xmlhttp.responseText.replace("_"," ");
                            document.getElementById('modal').style.display = 'block';
                            startTTS(xmlhttp.responseText.replace("_"," "));

                        }
                    };
                    xmlhttp.open("GET", "manager.php?fname=chkUtt&q=" + clientmsg + "&p=" + state, true);
                    xmlhttp.send();


                }
                $(document).ready(function () {});
                
                $(document).ready(function () {
                    //$("li.item").click()
//                    $("#proList").on("mousedown","li.listitem", function(event){ 
//                        console.log("my name");
//                    var list_val = $(this).html();
//                    
//                    document.getElementById('modalopt').style.display = 'none';
//                    $("#usermsg").val(list_val);
//                    showUser();
//                    //alert(list_id);
//                    //alert('' + location);
//                    //window.location.href = location;
//                });
                    //If user wants to end session
                    $("#exit").click(function () {
                        var exit = confirm("Are you sure you want to end the session?");
                        if (exit == true) {
                            window.location = 'main.php?logout=true';
                        }
                    });
                });

                //If user submits the form
                //$("#submitmsg").click(function(){
                //    updateChatbox();
                //    
                //});
                function displayDiv()
                {
                    document.getElementById('light').style.display = 'block';
                    document.getElementById('fade').style.display = 'block';
    <?php
    $_SESSION ['confirm'] = true;
    ?>
                }
                function displayModal()
                {
                    //   ****************************************************************
                    //   * only display the Modal ************




                }
                function updateChatbox()
                {
                    
                    //document.getElementById('modal').style.display = 'none';
                    //var clientmsg = $("#usermsg").val();
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            clientmsg = xmlhttp.responseText;
                            //document.getElementById('modalsec').style.display = 'block';
                        }
                    };
                    xmlhttp.open("GET", "manager.php?fname=getInput&q1=" + clientmsg + "&p=" + state + "&usrmsg=" + clientmsg, true);
                    xmlhttp.send();
                    //var clientmsg = '<%=Session["clientmsg"]%>'; 
                    //get the response
                    resp = getResponse();
                   if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //clientmsg = xmlhttp.responseText;
                            document.getElementById('modalsec').style.display = 'none';

                        }
                    };
                    xmlhttp.open("GET", "post.php?text=" + clientmsg + "&res=" + respo, true);
                    xmlhttp.send();


                    //var clientmsg = $("#usermsg").val();
                    //document.getElementById('modalsec').style.display = 'none';
                    // var clientmsg = document.getElementById('usermsg').innerHTML;
                    //var clientmsg = $("#usermsg").val();
                    //$.post("post.php", {text: clientmsg});             
                    $("#usermsg").attr("value", "");
                    $("#modalsec").hide();
                    loadLog();
                    startTTS(respo);
                   // onStartTTS();
                    return false;
                    //return false;
                }
                function getResponse()
                {
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp = new XMLHttpRequest();
                    } else {
                        // code for IE6, IE5
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            response = xmlhttp.responseText;
                            return response;
                            //document.getElementById('modalsec').style.display = 'block';
                        }
                    };
                    xmlhttp.open("GET", "manager.php?fname=getResponse&q1=" + clientmsg, true);
                    xmlhttp.send();

                }
                function loadLog() {
                    var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
                    $.ajax({
                        url: "log.html",
                        cache: false,
                        success: function (html) {
                            $("#chatbox").html(html); //Insert chat log into the #chatbox div  

                            //Auto-scroll          
                            var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
                            if (newscrollHeight > oldscrollHeight) {
                                $("#chatbox").animate({scrollTop: newscrollHeight}, 'normal'); //Autoscroll to bottom of div
                            }
                        },
                    });
                }
                function startTTS(texttos){
                    voices = window.speechSynthesis.getVoices();
                    //for(var i = 0; i < voices.length; i++ ) {
                    //    console.log(voices);
                    //}
                    TTS.lang = 'en-US';
                    TTS.pitch = 1; //0 to 2
                    TTS.voice = voices[33]; //Not all supported
                    TTS.voiceURI = 'native';
                    TTS.volume = 1; // 0 to 1
                    TTS.rate = 1; // 0.1 to 10
                    TTS.text = texttos;
                    TTS.onend = function (e) {
                        console.log('message over');
                        return false;
                        //startRecognition();
                    };
                    return window.speechSynthesis.speak(TTS);
                }
                function onStartTTS() {
                    voices = window.speechSynthesis.getVoices();
                    //for(var i = 0; i < voices.length; i++ ) {
                    //    console.log(voices);
                    //}
                    TTS.lang = 'en-US';
                    TTS.pitch = 1; //0 to 2
                    TTS.voice = voices[33]; //Not all supported
                    TTS.voiceURI = 'native';
                    TTS.volume = 1; // 0 to 1
                    TTS.rate = 1; // 0.1 to 10
                    TTS.text = getResponse();
                    TTS.onend = function (e) {
                        console.log('message over');
                        return false;
                        //startRecognition();
                    };
                    return window.speechSynthesis.speak(TTS);
                }
                setInterval(loadLog(), 2500);
            </script>

            <?php
        }
        //}
        ?>
        
    </body>
</html>