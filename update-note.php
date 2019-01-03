
<?php 
include ("dbaccess.php"); 
?>
         
<?php
if (isset($_GET['recID'])) {  
    $record = $fm->getRecordByID('web', $_GET['recID']);
    $note = $record->getField('note');
    
    if ($_GET['action'] == 'cancel') {
        if (empty($note)) {
            $noteButtonLabel = 'Add note';
        } else {
            $noteButtonLabel = 'Edit';
        }
        
        echo '<small class="text-muted">' . $note . '<br>  
              <i class="fa fa-edit"></i>
              <a class="text-secondary" ic-get-from="update-note.php?recID=' . $_GET['recID'] . '"  ic-target="#note-' . $_GET['recID'] . '">' . $noteButtonLabel . '</a>
              </small>';

    } else {    
        echo '<form ic-post-to="update-note.php" ic-target="#note-' . $_GET['recID'] . '">
                <input type="hidden" name="recID" value="' . $_GET['recID'] . '">
                <div class="form-group row">
                  <textarea class="form-control form-control-sm" id="textarea-' . $_GET['recID'] . '" rows="3" name="note">' . $note . '</textarea>
                </div>
                <div class="form-group row">
                  <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                  <a class="ml-2" ic-get-from="update-note.php?recID=' . $_GET['recID'] . '&action=cancel"  ic-target="#note-' . $_GET['recID'] . '">Cancel</a>
                </div>
              </form>';
    }

} else {
    if (isset($_POST['note'])) {
        $edit = $fm->newEditCommand('web', $_POST['recID']);
        $edit->setField('note', $_POST['note']);
        $edit->execute();
    }
    
    $record = $fm->getRecordByID('web', $_POST['recID']);
    $note = $record->getField('note');
    echo '<small class="text-muted">' . $note . '<br>  
              <i class="fa fa-edit"></i>
              <a class="text-secondary" ic-get-from="update-note.php?recID=' . $_POST['recID'] . '"  ic-target="#note-' . $_POST['recID'] . '">
              Edit
              </a>';
}
?>

