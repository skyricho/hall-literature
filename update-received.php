
<?php 
include ("dbaccess.php"); 
?>
         
<?php 
# Check the POST recID and update the shipped field.
if (isset($_POST['recID'])) {
    $edit = $fm->newEditCommand('web', $_POST['recID']);
    $edit->setField('Inventory::received', $_POST['shipped']);
    $edit->execute();
} else {
    echo 'Houston we have a problem'; 
}

# Render shipped value
$record = $fm->getRecordByID('web', $_POST['recID']);
$shipped = $record->getField('Inventory::received');
echo $shipped;
?>

<!-- v1 form with no submit button
<form ic-post-to="update-received.php" ic-target="#shipped-<?php echo $_POST['recID']; ?>">
  <input type="hidden" name="recID" value="<?php echo $_POST['recID']; ?>">
  <input type="text" class="form-control" name="shipped" value="<?php echo $shipped; ?>" style="width: 4rem; text-align: right;">
</form>
-->