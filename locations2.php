<?php
require_once 'classes/Location.php';
require_once 'classes/LocationTableGateway.php';
require_once 'classes/Connection.php';
require_once 'utils/checkLogin.php';

$connection = Connection::getInstance();
$gateway = new LocationTableGateway($connection);
$page = 1; // default page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
}
$start = ($page - 1) * 5; // calculate starting location based on page number
$numLocationsPerPage = 5; // number of locations to display per page
$totalNumLocations = $gateway->getNumLocations(); // get total number of locations from database
$statement = $gateway->getLocationsOrderById($start, $numLocationsPerPage);
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Locations</title>
    <?php require 'utils/styles.php'; ?><!--css links. file found in utils folder-->
    <?php require 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
</head>

<body>
    <?php require 'utils/header.php'; ?><!--header content. file found in utils folder-->
    <div class="content"><!--body content holder-->
        <div class="container">
            <div class="col-md-12"><!--body content title holder with 12 grid columns-->
                <h1>Our Venues</h1><!--body content title-->
            </div>
        </div>
        <?php
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        while ($row) {
            echo '<div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
			
            <div class="row"><!--location content -->
                <section>
                    <div class="container">
                        <div class="col-md-4"><!--image holder with 4 grid column-->
                            <img src="uploads/' . $row['Image'] . '" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-8"><!--location non modal content -->
                            <h1 class="title">' . $row['Name'] . '</h1><!--location title-->
                            <p class="location"><!--location secondary content-->
                                ' . $row['Address'] . '
                            </p>
                        </div><!--subcontent div-->
                    </div><!--container div-->
                </section>
            </div><!--row div-->';

            $row = $statement->fetch(PDO::FETCH_ASSOC);
        }
        echo '<div class="container" style="display: flex; align-items: center; justify-content:center; margin-top:1%;">
        <nav aria-label="Page navigation">
        <ul class="pagination">';
        $prev = $page - 1;
        if ($prev > 0) {
            echo '<li><a href="locations2.php?page=' . $prev . '">&laquo;</a></li>';
        }

        $numPages = ceil($totalNumLocations / $numLocationsPerPage);
        for ($i = 1; $i <= $numPages; $i++) {
            if ($i == $page) {
                echo '<li><a href="#" class="current">' . $i . '</a></li>';
            } else {
                echo '<li><a href="locations2.php?page=' . $i . '">' . $i . '</a></li>';
            }
        }

        $next = $page + 1;
        if ($next <= $numPages) {
            echo '<li><a href="locations2.php?page=' . $next . '">&raquo;</a></li>';
        }
        echo '</ul></nav></div>';
        ?>


    </div>
    <?php require 'utils/footer.php'; ?>
</body>

</html>