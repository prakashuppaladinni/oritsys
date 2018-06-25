<?php

require_once("Assignment.php");

/*echo "Please enter assignment number : ";
$handle = fopen ("php://stdin","r");
$task = fgets($handle);*/

$myfile = fopen($argv[1], "r") or die("Unable to open file!");
$string = fread($myfile,filesize($argv[1]));

$data = array_unique(str_word_count($string, 1));

$assignment1 = new Assignment();

$task = 1;

echo "-----------------------------------------------------------------------------\n";
echo "ASSIGNMENT 1\n";
echo "-----------------------------------------------------------------------------\n";

if(trim($task) == '1'){

    $flag = $assignment1->insertIntoUniqueWords($data);

    if($flag){
        echo "Unique words are recorded in uniqueWords table\n\n\n";
    }else{
        echo "Not recorded\n\n\n";
    }
}

$task = 2;

echo "-----------------------------------------------------------------------------\n";
echo "ASSIGNMENT 2\n";
echo "-----------------------------------------------------------------------------\n";

if(trim($task) == '2'){
    $assignment1->countUniqueWords($task);
}

$task = 3;

echo "-----------------------------------------------------------------------------\n";
echo "ASSIGNMENT 3\n";
echo "-----------------------------------------------------------------------------\n";

if(trim($task) == '3'){
    $assignment1->countUniqueWords($task);
    $assignment1->runQuery("SELECT DISTINCT word FROM `uniqueWords`");
}

fclose($myfile);

?>