<?php

/************************************************ Import Csv Files 1 ********************************************/

require('database.php');

$csv = array_map("str_getcsv", file("test.csv",FILE_SKIP_EMPTY_LINES));

$keys = array_shift($csv);


$test = "weather2";
$col = null;

foreach($keys as $key => $value)
{
    $col .= "$value VARCHAR(10) NOT NULL, ";
}

$col = rtrim($col, ", ");

$sql = "CREATE TABLE $test (
                                     $col
                                )";

$query = mysqli_query($con, $sql);







/*---------------------- Part Two insert the value -----------------------------*/

$file = "test.csv";
$fp = fopen($file, "r");
$header = fgetcsv($fp);


while ($line = fgetcsv($fp)) {
    global $con;
    $record = array_combine($header, $line);

    // now record contains an array of fields keyed by the associated key in the header record


    $col = null;
    $val = null;

    foreach ($record as $k => $v) {
        $col .= "$k ,";
        $val .= "'$v' ,";
    }

    $col = rtrim($col, ", ");
    $val = rtrim($val, ", ");


    $sqlInsert = "INSERT INTO $test ($col)
                                  VALUES ($val)";


    $query2 = mysqli_query($con, $sqlInsert);


//
//            echo "<pre>";
//            print_r($record);
//            echo "</pre>";

}








?>