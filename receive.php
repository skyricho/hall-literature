<?php
include ("dbaccess.php"); 
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('receive.html.twig');

if (isset($_GET['cupboard'])) {
	$request = $fm->newFindCommand('web');
    $request->addFindCriterion('INVENTORY::requested', '*'; 
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
                'requested' => $record->getField('INVENTORY::requested'),
                'shipped' => $record->getField('INVENTORY::shipped'),
                //'note' => $record->getField('note'),
                'symbol' => $record->getField('_symbol'),
            );
        }
    }
} 

echo $template->render(array(
        'publications' => $publications,
        //'cupboard' => $_GET['cupboard'],
        'msg' => $msg,
        )
    );
?>
