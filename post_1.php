<?php
session_start();
//if(isset($_SESSION['name'])){
    $text = $_POST['text'];
    $text1= "Are you saying that I am not able to handle it, alone?";
    $text2= "I dont think this was his point!";
     
    $fp = fopen("log.html", 'w');
    fwrite($fp, "<div class='msgln'><img src = 'manager.jpg' style='height: 80px; width: 80px; border-radius:50%'> </img> <b>Marco</b> : ".stripslashes(htmlspecialchars($text))." <br></div>"
            . "<div class='msglnl'>  ".stripslashes(htmlspecialchars($text1))." :<b>Nick</b><img src = 'hesad.jpg' style='height: 80px; width: 80px;border-radius:50%'> </img> <br>  </div>"
            . "<div id='inner'><img src = 'hesad.jpg' style='height: 120px; width: 120px; border-radius:50%'></div>"
            . "<div class='msglnl'>  ".stripslashes(htmlspecialchars($text2))." :<b>Lisa</b><img src = 'shenormal.jpg' style='height: 80px; width: 80px;border-radius:50%'> </img> <br>  </div>"
            . "<div id='innerright'><img src = 'shenormal.jpg' style='height: 120px; width: 120px; border-radius:50%'></div>");
    fclose($fp);
//}
?>
