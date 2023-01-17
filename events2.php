<?php
require_once 'classes/Event.php';
require_once 'classes/EventTableGateway.php';
require_once 'classes/Connection.php';
require_once 'utils/checkLogin.php';

$connection = Connection::getInstance();
$gateway = new EventTableGateway($connection);
$page = 1; // default page number
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = $_GET['page'];
}
$start = ($page - 1) * 5; // calculate starting event based on page number
$numEventsPerPage = 5; // number of events to display per page
$totalNumEvents = $gateway->getNumEvents(); // get total number of events from database
$statement = $gateway->getEventsOrderByDate($start, $numEventsPerPage);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Events</title>
    <?php require_once 'utils/styles.php'; ?><!--css links. file found in utils folder-->
    <?php require_once 'utils/scripts.php'; ?><!--js links. file found in utils folder-->
</head>

<body>
    <?php require_once 'utils/header.php'; ?><!--header content. file found in utils folder-->
    <div class="content"><!--body content holder-->
        <div class="container">
            <div class="col-md-12"><!--body content title holder with 12 grid columns-->
                <h1>What's On</h1><!--body content title-->
            </div>
        </div>
        <?php
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        while ($row) {
            $month = date("M", strtotime($row['StartDate']));
            $MONTH = strtoupper($month);
            $day = date("j", strtotime($row['StartDate']));
            echo '<div class="container">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row"><!--event content-->
                <section>
                    <div class="container">
                        <div class="date col-md-1"><!--date holder with 1 grid column-->
                            <span class="month">' . $MONTH . '</span><br><!--month-->
                            <hr class="line"><!--css modified horizontal line-->
                            <span class="day">' . $day . '</span><!--day-->
                        </div>
                        <div class="col-md-5"><!--image holder with 5 grid column-->
                            <img src="uploads/' . $row['Image'] . '" class="img-responsive">
                        </div>
                        <div class="subcontent col-md-6"><!--event content holder with 6 grid column-->
                            <h1 class="title">' . $row['Title'] . '</h1><!--event content title-->';
            echo '<p class="location"><!--event content location-->
                                    ' . $row['name'] . '
                                </p>';
            echo '<p class="definition"><!--event content definition-->
                                ' . $row['Description'] . '
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
        $str = '<li><a href="events2.php?page=';
        if ($prev > 0) {
            echo $str . $prev . '">&laquo;</a></li>';
        }

        $numPages = ceil($totalNumEvents / $numEventsPerPage);
        for ($i = 1; $i <= $numPages; $i++) {
            if ($i == $page) {
                echo '<li><a href="#" class="current">' . $i . '</a></li>';
            } else {
                echo $str . $i . '">' . $i . '</a></li>';
            }
        }

        $next = $page + 1;
        if ($next <= $numPages) {
            echo $str . $next . '">&raquo;</a></li>';
        }
        echo '</ul></nav></div>';
        ?>
    </div><!--row div-->
    <?php require_once 'utils/footer.php'; ?><!--footer content. file found in utils folder-->
</body>
</html>
