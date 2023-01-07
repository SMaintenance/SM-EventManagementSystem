<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['deleteId'];

    $connection = Connection::getInstance();

    $gateway = new LocationTableGateway($connection);

    $gateway->delete($id);

    header('Location: viewLocations.php');
}
