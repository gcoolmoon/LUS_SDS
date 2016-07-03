<?php
session_start();
//if(isset($_SESSION['name'])){
    $text = $_REQUEST['text'];
    $text2= $_REQUEST['res'];
    $text3 = $_REQUEST['url'];
            
    //$text3="https://www.youtube.com/embed/hzixp8s4pyg" <embed width='320' height='180' src=".stripslashes(htmlspecialchars($text3))." ></embed> ;
     
    $fp = fopen("log.html", 'a+');
    if(!$text3)
    fwrite($fp, "<div class='msgln'><img src = 'managerr.jpg' style='height: 80px;"
            . " width: 80px; border-radius:50%'> </img> <b>Cla</b> : ".stripslashes(htmlspecialchars($text))." <br></div>"
            . "<div class='msglnl'>  ".stripslashes(htmlspecialchars($text2)).":<b>Lisa</b><img src = 'shenormal.jpg' "
            . "style='height: 80px; width: 80px;border-radius:50%'> </img> <br>  </div>");
    else
     fwrite($fp, "<div class='msgln'><img src = 'managerr.jpg' style='height: 80px;"
            . " width: 80px; border-radius:50%'> </img> <b>Cla</b> : ".stripslashes(htmlspecialchars($text))." <br></div>"
            . "<div class='msglnl'>  ".stripslashes(htmlspecialchars($text2)).":<embed width='320' height='180' src=".stripslashes(htmlspecialchars($text3))." ></embed><b>Lisa</b><img src = 'shenormal.jpg' "
            . "style='height: 80px; width: 80px;border-radius:50%'> </img> <br>  </div>");
    fclose($fp);
//}
?>
