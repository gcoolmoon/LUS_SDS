<?php 
require  './Tagging/PosTagger.php';
//include './dialogManagerImpl.php';
//<!--
//To change this license header, choose License Headers in Project Properties.
//To change this template file, choose Tools | Templates
//and open the template in the editor.
//-->
//$input = 'who plays jack on Thor'; //-- actor 
$input = 'how many movies has kristen stewart starred in';// -- movie_count 
//$input = 'what movies has will ferrell appeared in'; // movie
//$input = 'find the director of to kill a mockingbird'; // director
//$input ='can i see previews for upcoming warner brothers movies'; //trailer --- not working
//$input = 'what are the ratings and review on finding nemo'; --- not working movie 
//$input = 'what are the actors names and parts in finding nemo';
//$input = 'what rating did the campaign movie get'; //nope movie
//$input = 'i wonder who produced star wars'; // producer

if (strpos($input, 'trailer') !== false) {
    $object= 'trailer';
}
else if (strpos($input, 'rating') !== false) 
{
    $object = 'rating';
}
else if (strpos($input, 'review') !== false) 
{
    $object = 'review';
}
else if (strpos($input, 'awards') !== false) 
{
    $object = 'award';
}
else
{
$cmd = "python Data/UtteranceClass.py '". $input ."' 2>&1";
$pid = popen($cmd,'r');
$object = array();
while( !feof( $pid ) )
{
     
 $object = fread($pid, 600);
 flush();
 ob_flush();
 usleep(100000);
 break;
}
pclose($pid);
}
//getting teh r obablitiero
$handle = fopen("Data/NLSPARQL.tester.results.txt","r");
$filter = array();
//$filter[] = $object; 
//$handle = @fopen("/tmp/inputfile.txt", "r");
if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        $filter[] =  $buffer;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}


fclose($file);
//$str = $filter[0];
//$firstUttArr = preg_split('/\s+/', $str);
//$firstUtt = $firstUttArr[0];
//Movie Domain Tagging
foreach($filter as $x) {
    $linevalues = split("/t", $x);
}
$tagger = new PosTagger("Tagging/lexicon.txt");
$tags = $tagger->tag($input);
$tagger->printTag($tags);
$cmd = "crf_test -m Tagging/model Tagging/NLSPARQL.test.crf.txt > Tagging/noutput 2>&1";
$pid = popen($cmd,'r');

pclose($pid);

$handle = fopen("Tagging/noutput", "r");
$word = null; 
$tag = null;
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        //split the line based on tab
         $parts = preg_split('/\t+/', $line);
         if(substr( $parts[2], 0, 1 )==='B')
         {
                $word = $parts[0];
                $tag = substr($parts[2], 2);
         }
         if(substr( $parts[2], 0, 1 )==='I')
         {
             $word = $word . " ". $parts[0];
         }
        //get the thrid column 
        //if the word starts with a B add it to the word  
        //then write the following which starts with I 
        //extract the word after the B
        // process the line read.
    }
    

    fclose($handle);
} else {
    // error opening the file.
} 
$concepts = array("$tag"=> $word);
$uttconfig= 100;
$conceptconf = 100;
$asrconfig = 100;
$input = array("EAT" => "list", "object" => (string)$object,  "language" => "English","asrconf" => $asrconfig ,
    "uttconf"=>$uttconfig, "conconf"=>$conceptconf,"concepts"=> $concepts, "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));
getresults($input);
?>
<!--<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Welcome to our SDS </h1>
        
        <form action="dialogManagerImpl.php" method="post">
            Utterance : <input type="text" name="uttrance" 
                               size="200" value=><br>
            
            <h1>Concepts</h1> <br>
            
            <input type="text" name="actorname" size="200" 
                               value=""><br>
            
            Character Name  : <input type="text" name="charactername" size="200"><br>
            
            Movie Name: <input type="text" name="moviename" size="200" ><br>
            
            Director Name: <input type="text" name="directorname" size="200" ><br>
            
            Producer Name: <input type="text" name="producername" size="200" ><br>
            
            
            <h1>Confidence</h1> <br>
            
            ASR confidence: <input type="text" name="asrconf" size="200" ><br>
            
            Utterance Confidence: <input type="text" name="uttconf" size="200" ><br>
            
            Concept Confidence: <input type="text" name="conceptconf" size="200" ><br>
                <input type="submit">
            </form>
              
        
    </body>
</html>-->