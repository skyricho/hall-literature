<?php
include ("dbaccess.php"); 
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('s-28-inventory.twig');





$request = $fm->newFindCommand('web');
$request->addFindCriterion('cupboard location', '*');
$request->addSortRule('S_28 position', 1, FILEMAKER_SORT_ASCEND);
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
            'title' => $record->getField('title'),
            'recID' => $record->getField('recID'),
            'onHand' => $record->getField('INVENTORY::on hand start'),
            'onHandEnd' => $record->getField('INVENTORY::on hand end'),
            'proposed' => $record->getField('INVENTORY::proposed'),
            'inventoryNote' => $record->getField('inventoryNote'),
            'requestNote' => $record->getField('requestNote'),
            'symbol' => $record->getField('_symbol'),
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

