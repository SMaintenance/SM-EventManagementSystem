<?php
ob_start();
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateEditEvents.php';

$formdata = array();
$errors = array();

validateEvents(INPUT_POST, $_POST, $errors);

if (isset($_POST['submit'])) {
    if (empty($errors)) {
        $id = $_POST['id'];
        $title = $_POST['Title'];
        $description = $_POST['Description'];
        $eType = $_POST['EventType'];
        $startDate = $_POST['StartDate'];
        $endDate = $_POST['EndDate'];
        $cost = $_POST['Cost'];
        $locationID = $_POST['LocID'];
        $old_image = $_POST['old_image'];
    
        if (isset($_FILES['image']['name']) && ($_FILES['image']['name'] != "")) {
            $target_dir = "uploads/";
            $file = $_FILES['image']['name'];
            $path = pathinfo($file);
            $filename = $path['filename'];
            $ext = $path['extension'];
            $temp_name = $_FILES['image']['tmp_name'];
            $path_filename_ext = $target_dir . $filename . "." . $ext;
    
            unlink("uploads/$old_image");
            move_uploaded_file($temp_name, $path_filename_ext);
        } else {
            $file = $old_image;
        }
    
        $event = new Event($id, $title, $description, $eType, $startDate, $endDate, $cost, $locationID, $file);
    
        $connection = Connection::getInstance();
    
        $gateway = new EventTableGateway($connection);
    
        $id = $gateway->update($event);
    
        header('Location: viewEvents.php');
    }else {
        validateEvents(INPUT_POST, $formdata, $errors);
        $_GET['id'] = $_POST['id'];
        $_GET['locId'] = $_POST['LocID'];
        require_once 'editEventForm.php'; 
    }
}
ob_end_flush();
