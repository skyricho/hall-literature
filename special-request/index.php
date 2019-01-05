<?php
//ini_set('display_errors', 1); // To debug errors
include ("../dbaccess.php"); 
require '../vendor/autoload.php';

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);
$template = $twig->load('special-request/index.html.twig');


if (isset($_GET['filter'])) {
    if ($_GET['filter'] == 'all') {
        $request = $fm->newFindAllCommand('webSpecialRequest');
        $result = $request->execute();

        if (FileMaker::isError($result)) {
		    $msg = 'Error: ' . $result->getMessage();
		}

    } elseif ($_GET['filter'] == 'handed-out') {
		$request = $fm->newFindCommand('webSpecialRequest');
		$request->addFindCriterion('status', 'handed out'); 
		$result = $request->execute();

		if (FileMaker::isError($result)) {
	    $msg = 'Error: ' . $result->getMessage();
	    }

	} else {
		$request = $fm->newFindCommand('webSpecialRequest');
		$request->addFindCriterion('status', $_GET['filter']); 
		$result = $request->execute();

		if (FileMaker::isError($result)) {
	    $msg = 'Error: ' . $result->getMessage();
	    }

	}

} else {
    $request = $fm->newFindCommand('webSpecialRequest');
    $request->addFindCriterion('status', 'submitted'); 
	$result = $request->execute();

	if (FileMaker::isError($result)) {
	    $msg = 'Error: ' . $result->getMessage();
	}

}

if (empty($msg)) {
	$records = $result->getRecords();
	if (FileMaker::isError($records)) {
	    $msg = 'Error: ' . $records->getMessage();
	}
	$var = array();
	foreach($records as $record) {
	    $related_records = $record->getRelatedSet('SpecialRequestStatus');
	    $var1 = array();
	    // Absence of related record triggers an error: Call to undefined method FileMaker_Implementation::getField()
	    if ($record->getField('cRelatedRecords') > 0) {
	    	foreach($related_records as $related_record) {
		        $var1[] = array(
		        'id' => $related_record->getField('SpecialRequestStatus::recID'),
		        'status' => $related_record->getField('SpecialRequestStatus::status'),
		        'date' => $related_record->getField('SpecialRequestStatus::date')
		        );
		    }
	    }

		$var[] = array(
	        'id' => $record->getField('recID'),
	        'item' => $record->getField('item'),
	        'itemCode' => $record->getField('itemCode'),
	        'language' => $record->getField('language'),
	        'quantity' => $record->getField('quantity'),
	        'note' => $record->getField('note'),
	        'name' => $record->getField('name'),
	        'status' => $record->getField('status'),
	        'statusHistory' => $var1
	    );
	}
}


if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];
}

echo $template->render(array(
        'statusFilter' => $_GET['filter'],
        'msg' => $msg,
        'specialRequests' => $var,
        'itemCodes' => $itemCodes,
        'languageCodes' => $languageCodes
        )
    );
?>
