<?php
session_start();
//if(isset($_SESSION['name'])){
    $text = $_POST['text'];
    $text1= "Well, I admit that i have overworked,But still! Can you give me details?";
     
    $fp = fopen("log.html", 'w');
    fwrite($fp, "<div class='msgln'><img src = 'manager.jpg' style='height: 80px; width: 80px; border-radius:50%'> </img> <b>Marco</b> :".stripslashes(htmlspecialchars($text))." <br></div>"
            . "<div class='msglnl'>  ".stripslashes(htmlspecialchars($text1)).":<b>Employee1</b><img src = 'hehappy.jpg' style='height: 80px; width: 80px;border-radius:50%'> </img> <br>  </div>"
            .  "<div id='inner'><img src = 'hehappy.jpg' style='height: 120px; width: 120px; border-radius:50%'></div>"
            . "<div id='innerright'><img src = 'shesmile.jpg' style='height: 120px; width: 120px; border-radius:50%'></div>");
    fclose($fp);
//}
?>
