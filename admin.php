<?php
ini_set('display_errors', 1);
include ("dbaccess.php"); 

 
# Check the POST id and update the shipped field.
if ($_POST['submit'] == 'updateOnHand') {
    $edit = $fm->newEditCommand('web', $_POST['id']);
    $edit->setField('Inventory::onHandEnd', $_POST['onHandEnd']);
    $edit->execute();
} else {
    echo 'Houston we have a problem'; 
}

# Render onHandEnd value
$record = $fm->getRecordByID('web', $_POST['id']);
$onHandEnd = $record->getField('Inventory::onHandEnd');
echo '<div class=/"alert alert-info alert-dismissible fade show/" role=/"alert/">
  Saved.
  <button type=/"button/" class=/"close/" data-dismiss=/"alert/" aria-label=/"Close/">
    <span aria-hidden=/"true/">&times;</span>
  </button>';

?>

