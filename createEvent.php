<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'validateEvents.php';

$formdata = array();
$errors = array();

validateEvents(INPUT_POST, $formdata, $errors);

if (empty($errors)) {
    $title = $formdata['Title'];
    $description = $formdata['Description'];
    $eType = !empty($formdata['eType']) ? $formdata['eType'] : NULL;
    $sDate = $formdata['StartDate'];
    $eDate = $formdata['EndDate'];
    $cost = $formdata['Cost'];
    $locID = $formdata['LocID'];
    $image = !empty($_POST['image']) ? $_POST['image'] : NULL;

    $event = new Event(-1, $title, $description, $eType, $sDate, $eDate, $cost, $locID, $image);

    $connection = Connection::getInstance();

    $gateway = new EventTableGateway($connection);

    $id = $gateway->insert($event);

    header('Location: viewEvents.php');
} else {
    require 'createEventForm.php';
}
