<?php
require_once 'utils/functions.php';
require_once 'classes/User.php';
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'utils/checkLogin.php';

$connection = Connection::getInstance();
$gateway = new LocationTableGateway($connection);
$gateway1 = new EventTableGateway($connection);

$statement = $gateway->getLocations();
$statement1 = $gateway1->getEvents();

start_session();

if (!is_logged_in()) {
    header("Location: login_form.php");
}

$user = $_SESSION['user'];
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
    <div class="content">
        <div class="container">
            <?php
            if (isset($message)) {
                echo '<p>' . $message . '</p>';
            }
            ?>
            <h3>Location List</h3>
            <table class="table table-hover" aria-describedby="location list">
                <thead>
                    <tr>
                        <!--table label-->
                        <!--this will only show the detail of a location with specific ID chosen by the user-->
                        <th>No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Manager First Name</th>
                        <th>Manager Last Name</th>
                        <th>Manager Email</th>
                        <th>Manager Number</th>
                        <th>Max Capacity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!--table contents-->
                    <?php
                    $row = $statement->fetch(PDO::FETCH_ASSOC);
                    $row1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                    $events = array_column($row1, 'LocationID');
                    $count = 1;
                    $tdClosing = '</td>';
                    while ($row) {
                        echo '<tr data-depth = 0>';
                        echo '<td>' . $count . $tdClosing;
                        echo '<td>' . $row['Name'] . $tdClosing;
                        echo '<td>' . $row['Address'] . $tdClosing;
                        echo '<td>' . $row['ManagerFName'] . $tdClosing;
                        echo '<td>' . $row['ManagerLName'] . $tdClosing;
                        echo '<td>' . $row['ManagerEmail'] . $tdClosing;
                        echo '<td>' . $row['ManagerNumber'] . $tdClosing;
                        echo '<td>' . $row['MaxCapacity'] . $tdClosing;
                        echo '<td>'
                            . '<a href="editLocationForm.php?id=' . $row['LocationID'] . '">
                            <span class="glyphicon glyphicon-pencil mr-2"></a> ';
                        if (in_array($row['LocationID'], $events)) {
                            echo '<a class="cannotDeleteButton" style="cursor:pointer;">
                            <span class="glyphicon glyphicon-trash mr-2"></a> ';
                        } else {
                            echo '<a onclick="deleteLocation(' . $row['LocationID'] . ')" data-toggle="modal"
                             data-target="#deleteModal" class="deleteButton" style="cursor:pointer;">
                             <span class="glyphicon glyphicon-trash mr-2"></a> ';
                        }
                        echo '<a href="viewLocation.php?id=' . $row['LocationID'] . '">View Event</a> ';
                        echo $tdClosing . '</tr>';

                        $count++;
                        $row = $statement->fetch(PDO::FETCH_ASSOC);
                    }
                    ?>
                </tbody>
            </table>
            <a class="btn btn-default" href="createLocationForm.php">Create Location</a>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
                </div>
                <form id="delete-form" action="" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="deleteId" id="deleteId">
                        Are you sure you want to delete this location?
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="cannotDeleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Unable to Delete Location</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="cannotDeleteId" id="cannotDeleteId">
                    There are still events associated with this location.
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default" data-dismiss="modal">Okay</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteLocation(id) {
            document.getElementById("delete-form").action = "deleteLocation.php?id=" + id;

        }

        $(document).ready(function() {
            $('.cannotDeleteButton').on('click', function() {
                $('#cannotDeleteModal').modal('show');
            })
        })
    </script>

    <?php require_once 'utils/footer.php'; ?>
</body>

</html>