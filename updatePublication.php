
<?php 
include ("dbaccess.php"); 
?>
         
<?php 
# Check the POST name to see if the user clicked the Not Home button.
if (isset($_POST['recID'])) {
    $edit = $fm->newEditCommand('web', $_POST['recID']);
    $edit->setField('INVENTORY::on hand end', $_POST['onHand']);
    $edit->setField('INVENTORY::proposed', $_POST['orderMore']);
    $edit->execute();
    
    $url = 'location:index.php?cupboard=' . $_POST['cupboard'];
    header($url);
//   header('location:index.php?cupboard=' . $_POST['cupboard');
//.   echo 'Hello World! ' . $_POST['recID'] . ' ' . $_POST['onHand'] . ' ' . $_POST['orderMore'] . ' ' . $_POST['cupboard'];
} else {
    echo 'Houston we have a problem'; 
}
?>