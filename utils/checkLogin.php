<?php
require_once 'utils/functions.php';

if (is_logged_in()) {
    $logged_in = true;
} else {
    $logged_in = false;
}
