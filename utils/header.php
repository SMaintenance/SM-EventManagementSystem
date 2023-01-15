
<?php
if ($logged_in) {
    require 'utils/loginNav.php';
} else {
    require 'utils/logoutNav.php';
}
