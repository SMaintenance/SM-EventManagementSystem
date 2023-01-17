
<?php
if ($logged_in) {
    require_once 'utils/loginNav.php';
} else {
    require_once 'utils/logoutNav.php';
}
