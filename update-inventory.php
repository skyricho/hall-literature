
<?php
ini_set('display_errors', 1);
include ("dbaccess.php"); 
?>
         
<?php 
if (isset($_POST['id'])) {
$request = $fm->newFindCommand('webCount');
$request->addFindCriterion('id', $_POST['id']); 
$result = $request->execute();


$record = $fm->getRecordByID('web', $request);
echo $request;
}


# Check the POST recID and update the shipped field.
/*if (isset($_POST['recID'])) {
    $request = $fm->newEditCommand('web', $_POST['recID']);
    $request->setField('INVENTORY::on hand end', $_POST['onHandEnd']);
    $request->execute();
} else {
    echo 'Houston we have a problem'; 
}*/

# Return shipped value
//$record = $fm->getRecordByID('webCount', $_POST['id']);
//$onHandEnd = $record->getField('INVENTORY::on hand end');
//$onHandEnd = $record->getField('id');
//echo $onHandEnd;

// Debug
//echo $_POST['recID'];
//echo $record;

?>
<!-- form v1 with no submit button
<form ic-post-to="update-inventory.php" ic-target="#onHAndEnd-<?php echo $_POST['recID']; ?>">
  <input type="hidden" name="recID" value="<?php echo $_POST['recID']; ?>">
  <input type="text" class="form-control" name="onHandEnd" value="<?php echo $onHandEnd; ?>" style="width: 4rem; text-align: right;">
</form>
-->

<!-- test form -->
<form action="update-inventory.php" method="post">
  <input type="number" name="id" value="">
  <input type="number" name="onHandEnd" value="">
  <input type="submit" name="submit" value="Submit">
</form>
