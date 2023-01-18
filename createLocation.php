<?php
ob_start();
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateLocation.php';

$formdata = array();
$errors = array();

validateLocation(INPUT_POST, $formdata, $errors);

if (isset($_POST['submit'])) {
    if (empty($errors)) {
        $locationName = $formdata['Name'];
        $locationAddress = $formdata['Address'];
        $managerFName = $formdata['managerFName'];
        $managerLName = $formdata['managerLName'];
        $managerEmail = $formdata['managerEmail'];
        $managerNumber = $formdata['managerNumber'];
        $maxCap = $formdata['maxCap'];
        $locationType = !empty($formdata['lType']) ? $formdata['lType'] : null;
        $seat = !empty($_POST['seating']) ? $_POST['seating'] : null;
        $facilities = $formdata['facilities'];
        $url = !empty($formdata['link']) ? $formdata['link'] : null;

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

        $location = new Location(
            -1,
            $locationName,
            $locationAddress,
            $managerFName,
            $managerLName,
            $managerEmail,
            $managerNumber,
            $maxCap,
            $locationType,
            $seat,
            $facilities,
            $url,
            $file
        );

        $connection = Connection::getInstance();

        $gateway = new LocationTableGateway($connection);

        $id = $gateway->insert($location);

        header('Location: viewLocations.php');
    } else {
        require_once 'createLocationForm.php';
    }
}
ob_end_flush();
