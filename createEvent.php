<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateEvents.php';

$formdata = array();
$errors = array();

validateEvents(INPUT_POST, $formdata, $errors);

if (isset($_POST['submit'])) {
    if (empty($errors)) {
        $title = $formdata['Title'];
        $description = $formdata['Description'];
        $eType = !empty($formdata['eType']) ? $formdata['eType'] : null;
        $sDate = $formdata['StartDate'];
        $eDate = $formdata['EndDate'];
        $cost = $formdata['Cost'];
        $locID = $formdata['LocID'];

        // Where the file is going to be stored
        $target_dir = "uploads/";
        $file = $_FILES['image']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['image']['tmp_name'];
        $path_filename_ext = $target_dir . $filename . "." . $ext;

        // Check if file already exists
        if (file_exists($path_filename_ext)) {
            echo "Sorry, file already exists.";
        } else {
            move_uploaded_file($temp_name, $path_filename_ext);
            echo "Congratulations! File Uploaded Successfully.";
        }

        $event = new Event(-1, $title, $description, $eType, $sDate, $eDate, $cost, $locID, $file);

        $connection = Connection::getInstance();

        $gateway = new EventTableGateway($connection);

        $id = $gateway->insert($event);

        header('Location: viewEvents.php');
    } else {
        require 'createEventForm.php';
    }
}
