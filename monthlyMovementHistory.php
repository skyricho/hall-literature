<?php
include ("dbaccess.php"); 
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('monthlyMovementHistory.html.twig');

if (isset($_GET['id'])) {
	$record = $fm->getRecordByID('web', $_GET['id']);
	$related_records = $record->getRelatedSet('InventoryArchive');
    
    $_symbol = $record->getField('publicationCode');

    $monthlyMovements = array();
    foreach($related_records as $related_record) {
        $monthlyMovements[] = array(
            'date' => $related_record->getField('InventoryArchive::date'),
            'moved' => $related_record->getField('InventoryArchive::moved'),
            'received' => $related_record->getField('InventoryArchive::received'),
            'onHandStart' => $related_record->getField('InventoryArchive::onHandStart'),
            'onHandEnd' => $related_record->getField('InventoryArchive::onHandEnd'),
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


