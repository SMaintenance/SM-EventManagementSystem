<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateEditLocation.php';

$formdata = array();
$errors = array();

validateLocation(INPUT_POST, $_POST, $errors);

if (isset($_POST['submit'])) {
    if (empty($errors)){
        $id = $_POST['id'];
        $locationName = $_POST['Name'];
        $locationAddress = $_POST['Address'];
        $managerFName = $_POST['ManagerFName'];
        $managerLName = $_POST['ManagerLName'];
        $managerEmail = $_POST['ManagerEmail'];
        $managerNumber = $_POST['ManagerNumber'];
        $locationMaxCap = $_POST['MaxCapacity'];
        $locationType = $_POST['lType'];
        $seat = $_POST['seat'];
        $facilities = $_POST['facilities'];
        $url = $_POST['link'];
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
        
        $location = new Location($id, $locationName, $locationAddress, $managerFName, $managerLName, $managerEmail, $managerNumber, $locationMaxCap, $locationType, $seat, $facilities, $url, $file);
        
        $connection = Connection::getInstance();
        
        $gateway = new LocationTableGateway($connection);
        
        $id = $gateway->update($location);
        
        header('Location: viewLocations.php');
    } else {
        validateLocation(INPUT_POST, $formdata, $errors);
        $_GET['id'] = $_POST['id'];
        require 'editLocationForm.php'; 
    }
    
    
}
