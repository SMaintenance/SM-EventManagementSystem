<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';

if (isset($_POST['submit'])) {
    $id = $_POST['deleteId'];

    $connection = Connection::getInstance();

    $gateway = new EventTableGateway($connection);

    $gateway->delete($id);

    header('Location: viewEvents.php');
}
