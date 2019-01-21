<?php
include ("dbaccess.php"); 
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('receive.html.twig');

	$request = $fm->newFindCommand('web');
    $request->addFindCriterion('Inventory::requested', '*'); 
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
                'requested' => $record->getField('Inventory::requested'),
                'shipped' => $record->getField('Inventory::received'),
                'note' => $record->getField('note'),
                'symbol' => $record->getField('publicationCode'),
            );
        }
    }
 

echo $template->render(array(
        'publications' => $publications,
        'msg' => $msg,
        )
    );
?>
