
<?php 
include ("dbaccess.php"); 
?>
         
<?php 
# Check the POST recID and update the shipped field.
if (isset($_POST['recID'])) {
    $edit = $fm->newEditCommand('web', $_POST['recID']);
    $edit->setField('Inventory::requested', $_POST['requested']);
    $edit->execute();
} else {
    echo 'Houston we have a problem'; 
}

# Render shipped value
$record = $fm->getRecordByID('web', $_POST['recID']);
$requested = $record->getField('Inventory::requested');
//echo $shipped;
?>

<form ic-post-to="update-requested.php" ic-target="#requested-<?php echo $_POST['recID']; ?>">
  <input type="hidden" name="recID" value="<?php echo $_POST['recID']; ?>">
  <input type="text" class="form-control" name="requested" value="<?php echo $requested; ?>" style="width: 4rem; text-align: right;">
</form>