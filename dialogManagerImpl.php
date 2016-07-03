<?php
header(dialogManagerImpl.php);
if( $_POST["uttrance"]!= "")
$utterance = $_POST["uttrance"];
if( $_POST["actorname"]!= "")
$actorname = $_POST["actorname"];
if( $_POST["charactername"]!= "")
$charactername = $_POST["charactername"];
if( $_POST["moviename"]!= "")
$moviename = $_POST["moviename"];
if( $_POST["directorname"]!= "")
$directorname = $_POST["directorname"];
if( $_POST["producername"]!= "")
$producername = $_POST["producername"];
if( $_POST["asrconf"]!= "")
$asrconfig = $_POST["asrconf"];
if( $_POST["uttconf"]!= "")
$uttconfig = $_POST["uttconf"];
if( $_POST["conceptconf"]!= "")
$conceptconf = $_POST["conceptconf"];
// SLU output example
// to find a movie by an actor
//now lets see confidence 

//$concepts = array("actor.name"=> $actorname, "movie.name" => $moviename, "director.name"=>
     //   $directorname, "producer.name"=>$producername,"charactername"=>$charactername);

//$input = array("EAT" => "list", "object" => (string)$utterance,  "language" => "English","asrconf" => $asrconfig ,
  //  "uttconf"=>$uttconfig, "conconf"=>$conceptconf,"concepts"=> $concepts, "items" => array(array('name' => 'pluto'),
   //     array('name' => 'topolino')));
//$input = array("EAT" => "list", "object" => "actor",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Thor'), "items" => array(array('name' => 'pluto'),
//       array('name' => 'topolino')));
/*
to find movies by director name */ 
//$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('director.name'=>'James Cameron'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//to find movies by producer name 
/*$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('producer.name'=>'jon landau'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// the class is actor now and searchin it by movie name
/*$input = array("EAT" => "list", "object" => "actor",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Harry Potter'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// to get an actor by movie name and character name
//$input = array("EAT" => "list", "object" => "actor",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Harry Potter'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
/*$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// to get movie trailer by the name of the movie
/*$input = array("EAT" => "list", "object" => "trailer",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
//$input = array("EAT" => "list", "object" => "review",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//*****************
//this one is to find awards for a movie based on title this also uses imdb data source
//$input = array("EAT" => "list", "object" => "awards",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'avatar'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//this is to find imdb rating for amovie based on the title of the movie 
//this is from the imdb data source
//$input = array("EAT" => "list", "object" => "imdb.rating",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'avatar'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//        /*
//$input = array("EAT" => "list", "object" => "movie",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('actor.name'=>'Emma Stone'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
//$input = array("EAT" => "list", "object" => "character",  "language" => "English","asrconf" => "90.9" ,
//    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
//        array('name' => 'topolino')));
/*
$input = array("EAT" => "list", "object" => "character",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Thor','actor.name'=>'Thor'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));
$input = array("EAT" => "list", "object" => "director",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Titanic'), "items" => array(array('name' => 'pluto'),
        array('name' => 'topolino')));*/
// concepts for a character
//$class     = 'character';
// = array('actor.name'=>'Thor','movie.name'=>'Thor');

//$inputt = $_POST["input"];
//$inputt = trim($inputt,'"');
//eval("\$input= \"$inputt\";");
//echo "$input";
// include main functions and objects
include_once('./functions.php');
include_once('./DialogManager.class.php');
getresults($input);
getUttConfidence($Utt);
function getUttConfidence($Utt)
{
    // get previous state of the DialogManager
$has_state = DialogManager::restoreState('mystate');

// get the instance of the DialogManager
$dm = DialogManager::getInstance();

// if the previous state cannot be loaded, I set the concepts from SLU
if (!$has_state) {
	$dm->setInput($input);
}
else if($has_state)
{
    echo "state in use";
}
// set the filename of the conditions to verify
$dm->setConditionsFilename('conditions/conditions.xml');

//run confidence checker
//$isConfident = $dm->checkConfidence();
$isUttConfident = $dm->checkUtterance($Utt);
// run the DialogManager and get the result
echo $isUttConfident;
    
}
function getresults($input){
  $input = array("EAT" => "list", "object" => "actor",  "language" => "English","asrconf" => "90.9" ,
    "uttconf"=>"90.1", "conconf"=>"92.0", "concepts"=> array('movie.name'=>'Thor'), "items" => array(array('name' => 'pluto'),
       array('name' => 'topolino')));
// get previous state of the DialogManager
$has_state = DialogManager::restoreState('mystate');

// get the instance of the DialogManager
$dm = DialogManager::getInstance();

// if the previous state cannot be loaded, I set the concepts from SLU
if (!$has_state) {
	$dm->setInput($input);
}
else if($has_state)
{
    echo "state in use";
}
// set the filename of the conditions to verify
$dm->setConditionsFilename('conditions/conditions.xml');

//run confidence checker
$isConfident = $dm->checkConfidence();
$isUttConfident = $dm->checkUtterance();
// run the DialogManager and get the result
if($isConfident === true)
{
$myresult = $dm->run();

echo 'PROMPT: '.$myresult;
$arr = $dm->getResults();
if($input['object'] == "imdb.rating" || $input['object'] == "awards" )
{
 echo $arr;
}
else{
 $var = $arr['head']['vars'][0]; // if 1
 
foreach ($arr['results']['bindings'] as $e) {
echo "<p>".$e[$var]['value'] . "\n</p>";
}
//echo $arr;    
}
}
else
    echo $isConfident;
}