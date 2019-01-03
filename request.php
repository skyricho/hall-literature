<?php
include ("dbaccess.php"); 
require 'vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('request.html.twig');

	$request = $fm->newFindCommand('web');
    $request->addFindCriterion('Inventory::proposed', '*'); 
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
                'recID' => $record->getField('id'),
                'symbol' => $record->getField('publicationCode'),
                'title' => $record->getField('publicationTitle'),
                'proposed' => $record->getField('Inventory::proposed'),
                'requested' => $record->getField('Inventory::requested'),
                'note' => $record->getField('requestNote')
            );
        }
    }
 

echo $template->render(array(
        'publications' => $publications,
        'msg' => $msg,
        )
    );
?>
