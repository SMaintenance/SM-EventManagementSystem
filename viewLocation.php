<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'utils/checkLogin.php';

$illegal = "Illegal request";

if (!isset($_GET['id'])) {
    die($illegal);
}
$id = $_GET['id'];

$connection = Connection::getInstance();

$gateway = new LocationTableGateway($connection);
$statement = $gateway->getLocationsById($id);

$location = $statement->fetch(PDO::FETCH_ASSOC);
if (!$location) {
    die($illegal);
}

$eventGateway = new EventTableGateway($connection);
$events = $eventGateway->getEventsByLocationId($id);
if (!$events) {
    die($illegal);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <?php require_once 'utils/styles.php'; ?>
        <?php require_once 'utils/scripts.php'; ?>
    </head>
    <body>
        <?php require_once 'utils/header.php'; ?>
        <div class = "content">
            <div class = "container">
                <?php
                if (isset($message)) {
                    echo '<p>' . $message . '</p>';
                }
                ?>
                <?php
                if ($events->rowCount() > 0) {
                ?>
                <h3>Events at <?php echo $location['Name']?></h3>
                <table class="table table-hover" aria-describedby="event list (location)">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Description</th>                
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Cost</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getRow = $events->fetchAll();
                        $count = 1;
                        foreach ($getRow as $row) {
                            echo '<tr>';
                            echo '<td>' . $count . '</td>';
                            echo '<td>' . $row['Title'] . '</td>';
                            echo '<td>' . $row['Description'] . '</td>';                    
                            echo '<td>' . $row['StartDate'] . '</td>';
                            echo '<td>' . $row['EndDate'] . '</td>';
                            echo '<td>' . $row['Cost'] . '</td>';
                            echo '<td>'
                            . $row['name']
                            . '</td>';
                            echo '</tr>';
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>
                <?php
                } else {
                ?>
                <h3>There are no events at <?php echo $location['Name']; ?> </h3>
                <br>
                <?php
                }
                ?>
                <a class="btn btn-default" href="viewLocations.php">
                    <span class="glyphicon glyphicon-circle-arrow-left"></span>
                     Back
                </a>
            </div>
        </div>
        
        <?php require_once 'utils/footer.php'; ?>
    </body>
</html>
