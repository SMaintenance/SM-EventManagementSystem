<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateLocation.php';

$formdata = array();
$errors = array();

validateLocation(INPUT_POST, $formdata, $errors);

if (empty($errors)) {
    $locationName = $formdata['Name'];
    $locationAddress = $formdata['Address'];    
    $managerFName = $formdata['managerFName'];
    $managerLName = $formdata['managerLName'];
    $managerEmail = $formdata['managerEmail'];
    $managerNumber = $formdata['managerNumber'];
    $maxCap = $formdata['maxCap'];
    $locationType = $formdata['lType'];
    $seat = $_POST['seating'];
    $facilities = $formdata['facilities'];
    $url= $formdata['link'];
    $image = $_POST['image'];

    $location = new Location(-1, $locationName, $locationAddress, $managerFName, $managerLName, $managerEmail, $managerNumber, $maxCap, $locationType, $seat, $facilities, $url, $image);

    $connection = Connection::getInstance();

    $gateway = new LocationTableGateway($connection);

    $id = $gateway->insert($location);

    header('Location: viewLocations.php');
}
else {
    echo implode($errors);
    require 'createLocationForm.php';
}