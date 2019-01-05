<?php 
include ("../dbaccess.php");

if (isset($_POST['handedOut'])) {
    // Insert record to SpecialRequestStatus
    $request = $fm->createRecord('webSpecialRequestStatus');
    $request->setField('id_SpecialRequest', $_POST['id']);
    $request->setField('status', 'handed out');
    $request->setField('date', date("m/d/Y"));
    $result=$request->commit();

    if (FileMaker::isError($result)) {
      echo "<p>Error: " . $result->getMessage() . "</p>"; exit;
    }

    // Update status in SpecialRequest
    $request = $fm->newEditCommand('webSpecialRequest', $_POST['id']);
    $request->setField('status', 'handed out');
    $request->execute();

    if (FileMaker::isError($result)) {
      echo "<p>Error: " . $result->getMessage() . "</p>"; exit;
    } 

	  echo 'handed out';

} elseif (isset($_POST['addRequest'])) {
  // Insert record to SpecialRequest
    $request = $fm->createRecord('webSpecialRequest');
    $request->setField('item', $_POST['item']);
    $request->setField('itemCode', $_POST['itemCode']);
    $request->setField('quantity', $_POST['quantity')];
    $request->setField('language', $_POST['language')];
    $request->setField('note', $_POST['note']);
    $request->setField('name', $_POST['name']);
    $request->setField('status', 'requested';
    $request->setField('SpecialRequestStatus::status', 'requested');
    $request->setField('SpecialRequestStatus::date', date("m/d/Y"));
    $result=$request->commit();

    if (FileMaker::isError($result)) {
      echo "<p>Error: " . $result->getMessage() . "</p>"; exit;
    }

    echo 'Request for ' . $_POST['name'] . ' added';

}

?>

