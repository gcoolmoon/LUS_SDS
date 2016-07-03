<?php

include_once('./DialogManager.class.php');
require './Tagging/PosTagger.php';

$functionName = $_REQUEST["fname"];
$q;
if ($functionName == 'chkUtt') {
    $_SESSION['value'] = $_REQUEST["q"];
    $input = $_REQUEST["q"];
    if (strpos($input, 'trailer') !== false) {
        $object = 'trailer';
    } else if (strpos($input, 'rating') !== false) {
        $object = 'rating';
    } else if (strpos($input, 'review') !== false) {
        $object = 'review';
    } else if (strpos($input, 'awards') !== false) {
        $object = 'award';
    } else {
        $cmd = "python Data/UtteranceClass.py '" . $input . "' 2>&1";
        $pid = popen($cmd, 'r');
        $object = array();
        while (!feof($pid)) {

            $object = fread($pid, 600);
            flush();
            ob_flush();
            usleep(100000);
            break;
        }
        pclose($pid);
        $handle = fopen("Data/NLSPARQL.tester.results.txt", "r");
    $filter = array();
//$filter[] = $object; 
//$handle = @fopen("/tmp/inputfile.txt", "r");
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
            $filter[] = $buffer;
        }
        if (!feof($handle)) {
            echo "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
    }


    fclose($file);
    // get the first element 
    $str = $filter[0];
    $firstUttArr = preg_split('/\s+/', $str);
    $object = $firstUttArr[0];
    }
    
    //getUttConfidence($firstUtt);
    $hint = "Do you want:" . $object . " ?";
} else if ($functionName == 'getInput') {
    $hint = $_REQUEST["q1"];
} else if ($functionName == 'getResponse') {
    $hint = $_REQUEST["q1"];
     $concept= $_REQUEST["concepts"];
     $object = $_REQUEST["object"];
    $input = array("EAT" => "list", "object" => $object, "language" => "English",  "concepts" => $concept, "items" => array(array('name' => 'pluto'),
            array('name' => 'topolino')));
// get previous state of the DialogManager
    $has_state = DialogManager::restoreState('mystate');

// get the instance of the DialogManager
    $dm = DialogManager::getInstance();

// if the previous state cannot be loaded, I set the concepts from SLU
//    if (!$has_state) {
//        $dm->setInput($input);
//    } else if ($has_state) {
//        echo "state in use";
//    }
    $myresult = $dm->run();

   $hint = $myresult;
    $arr = $dm->getResults();
    if ($input['object'] == "imdb.rating" || $input['object'] == "awards") {
       $hint=  $arr;
    } else {
        $var = $arr['head']['vars'][0]; // if 1
        
        foreach ($arr['results']['bindings'] as $e) {
            echo "<p>" . $e[$var]['value'] . "\n</p>";
        }
//echo $arr;    
    }
} else {
    //getting teh r obablitiero

    $input = $_GET["q"];
    $tagger = new PosTagger("Tagging/lexicon.txt");
    $tags = $tagger->tag($input);
    $tagger->printTag($tags);
    $cmd = "crf_test -m Tagging/model Tagging/NLSPARQL.test.crf.txt > Tagging/noutput 2>&1";
    $pid = popen($cmd, 'r');

    pclose($pid);

    $handle = fopen("Tagging/noutput", "r");
    $word = null;
    $tag = null;
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            //split the line based on tab
            $parts = preg_split('/\t+/', $line);
            if (substr($parts[2], 0, 1) === 'B') {
                $word = $parts[0];
                $tag = substr($parts[2], 2);
            }
            if (substr($parts[2], 0, 1) === 'I') {
                $word = $word . " " . $parts[0];
            }
            //get the thrid column 
            //if the word starts with a B add it to the word  
            //then write the following which starts with I 
            //extract the word after the B
            // process the line read.
        }
        //echo $word;

        fclose($handle);
    } else {
        // error opening the file.
    }



    $hint = "Are you refering :" . $word . " ?";
}

echo $hint;
?>
