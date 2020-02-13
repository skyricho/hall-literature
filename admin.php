<?php
ini_set('display_errors', 1);
include ("dbaccess.php"); 

$saved = '<div class=\"alert alert-info alert-dismissible fade show\" role=\"alert\">
      Saved.
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
        <span aria-hidden=\"true\">&times;</span>
      </button></div>';

// Update onHandEnd
if ($_POST['submit'] == 'onHandEnd') {
    $edit = $fm->newEditCommand('web', $_POST['id']);
    $edit->setField('Inventory::onHandEnd', $_POST['onHandEnd']);
    $edit->execute();
    echo stripslashes($saved);
}

// Update proposed
if ($_POST['submit'] == 'proposed') {
    $edit = $fm->newEditCommand('web', $_POST['id']);
    $edit->setField('Inventory::proposed', $_POST['proposed']);
    $edit->execute();
    echo stripslashes($saved);
}

// Update requested
if ($_POST['submit'] == 'requested') {
    $edit = $fm->newEditCommand('web', $_POST['id']);
    $edit->setField('Inventory::requested', $_POST['requested']);
    $edit->execute();
    echo stripslashes($saved);
}

// Update received
if ($_POST['submit'] == 'received') {
    $edit = $fm->newEditCommand('web', $_POST['id']);
    $edit->setField('Inventory::received', $_POST['received']);
    $edit->execute();
    echo stripslashes($saved);
}

// Update location
if ($_POST['submit'] == 'location') {
    $edit = $fm->newEditCommand('web', $_POST['id']);
    $edit->setField('cupboardLocation', $_POST['cupboard']);
    $edit->execute();
    echo stripslashes($saved);
}

?>

