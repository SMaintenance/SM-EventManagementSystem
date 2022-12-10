<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';

$id = $_POST['id'];
$title = $_POST['Title'];
$description = $_POST['Description'];
$startDate = $_POST['StartDate'];
$endDate = $_POST['EndDate'];
$cost = $_POST['Cost'];
$locationID = $_POST['LocID'];

$event = new Event($id, $title, $description, $startDate, $endDate, $cost, $locationID);

$connection = Connection::getInstance();

$gateway = new EventTableGateway($connection);

$id = $gateway->update($event);

header('Location: viewEvents.php');