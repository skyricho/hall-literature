
<?php 
include ("dbaccess.php"); 
?>
         
<?php 
# Check the POST recID and update the shipped field.
if (isset($_POST['id'])) {
    $edit = $fm->newEditCommand('web', $_POST['id']);
    $edit->setField('Inventory::proposed', $_POST['proposed']);
    $edit->execute();
} else {
    echo 'Houston we have a problem'; 
}

echo 'Request added';
# Render shipped value
//$record = $fm->getRecordByID('web', $_POST['id']);
//$proposed = $record->getField('Inventory::proposed');
//echo $proposed;
?>

<!-- from with no submit button
<form ic-post-to="update-proposed.php" ic-target="#proposed-<?php echo $_POST['recID']; ?>">
  <input type="hidden" name="recID" value="<?php echo $_POST['recID']; ?>">
  <input type="text" class="form-control" name="proposed" value="<?php echo $proposed; ?>" style="width: 4rem; text-align: right;">
</form>
-->