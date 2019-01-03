<?php
ini_set('display_errors', 1);
include ("dbaccess.php"); 
require 'vendor/autoload.php';


$loader = new Twig_Loader_Filesystem('views');
$twig = new Twig_Environment($loader);
$template = $twig->load('count.html.twig');


if (isset($_GET['publicationType'])) {
    $request = $fm->newFindCommand('web');
    $request->addFindCriterion('publicationType', $_GET['publicationType']);
    $request->addFindCriterion('webHide', '='); 
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
                'id' => $record->getField('id'),
                'publicationCode' => $record->getField('publicationCode'),
                'publicationTitle' => $record->getField('publicationTitle'),
                'onHand' => $record->getField('Inventory::OnHandEnd'),
                'inventoryNote' => $record->getField('inventoryNote'),

            );
        }
    }
} 

$layout =& $fm->getLayout('web');
$publicationTypes = $layout->getValueListTwoFields('publicationType', 2);

echo $template->render(array(
        'msg' => $msg,
        'publications' => $publications,
        'publicationType' => $_GET['publicationType'],
        'publicationTypes' => $publicationTypes
        )
    );

?>