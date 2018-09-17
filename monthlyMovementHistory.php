<?php
include ("dbaccess.php"); 
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('monthlyMovementHistory.html.twig');

if (isset($_GET['recID'])) {
	$record = $fm->getRecordByID('web', $_GET['recID']);
	$related_records = $record->getRelatedSet('INVENTORY ARCHIVE');
    
    $_symbol = $record->getField('_symbol');

    $monthlyMovements = array();
    foreach($related_records as $related_record) {
        $monthlyMovements[] = array(
            'date' => $related_record->getField('INVENTORY ARCHIVE::date'),
            'moved' => $related_record->getField('INVENTORY ARCHIVE::moved'),
        );
    }

}


echo $template->render(array(
        'monthlyMovements' => $monthlyMovements,
        'recID' => $_GET['recID'],
        'symbol' => $_symbol,
        )
    );
?>


