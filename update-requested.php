
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
  
  <div class="row">
    <div class="col9">
  
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Qty" name="requested" value="<?php echo $requested; ?>">
        <div class="input-group-append"> 
          <button class="btn btn-outline-secondary" type="submit" name="update-request" value="update-requested">Save</button>
        </div>
      </div>
      
    </div>
    <div class="col">
      <div ic-remove-after="3s">Saved</div>
    </div>
  </div>
</form>

<!-- older version
<form ic-post-to="update-requested.php" ic-target="#requested-<?php echo $_POST['recID']; ?>">
  <input type="hidden" name="recID" value="<?php echo $_POST['recID']; ?>">
  <input type="text" class="form-control" name="requested" value="<?php echo $requested; ?>" style="width: 4rem; text-align: right;">
</form>
-->