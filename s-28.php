<?php
include ("dbaccess.php"); 
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('s-28-inventory.twig');


$request = $fm->newFindCommand('web');
$request->addFindCriterion('cupboardLocation', '*');
$request->addSortRule('s28Position', 1, FILEMAKER_SORT_ASCEND);
$result = $request->execute();

if (FileMaker::isError($result)) {
//        $ggg = 'foo';
//        echo  "<p>Error: " . $result->getMessage() . "</p>"; exit;
    $msg = $result->getMessage();
} else {
    $records = $result->getRecords();

    $publications = array();
    foreach($records as $record) {
        $publications[] = array(
            'title' => $record->getField('publicationTitle'),
            'recID' => $record->getField('id'),
            /*'onHand' => $record->getField('INVENTORY::onHandStart'),
            'onHandEnd' => $record->getField('INVENTORY::onHandEnd'),
            'proposed' => $record->getField('INVENTORY::proposed'),
            'inventoryNote' => $record->getField('inventoryNote'),
            'requestNote' => $record->getField('requestNote'),
            'symbol' => $record->getField('publicationCode'),*/
        );
    }
}


echo $template->render(array(
        'publications' => $publications,
        'cupboard' => $_GET['cupboard'],
        'msg' => $msg,
        )
    );

?>

