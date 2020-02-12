<?php
ini_set('display_errors', 1);
include ("dbaccess.php"); 

if ($_POST['submitInventoryReport'] == 'Submit Monthly Inventory') { 
    //echo 'foo';

    //CREATE PERFORM SCRIPT COMMAND
    $command = $fm->newPerformScriptCommand('web', 'Archive Monthly Inventory');
     
    //EXECUTE THE COMMAND
    $result = $command->execute();

    //TRAP FOR ERRORS
    if (FileMaker::isError($result)) {
        if (!isset($result->code) || strlen(trim($result->code)) < 1) {
            echo 'A System Error Occured';
        } else {
            // I don't know why this script triggers error 101.
            echo 'Monthly inventory has been submitted (Error Code: '. $result->code. ')';
        }
    } else {
        echo'Monthly inventory has been submitted.';
    }

}
?>