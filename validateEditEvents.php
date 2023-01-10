<?php

function validateEvents($input_method, &$formdata, &$errors)
{
    $formdata['Title'] = filter_input($input_method, "Title");
    $formdata['Description'] = filter_input($input_method, "Description");
    $formdata['EventType'] = filter_input($input_method, "EventType", FILTER_SANITIZE_NUMBER_INT);
    $formdata['StartDate'] = filter_input($input_method, "StartDate");
    $formdata['EndDate'] = filter_input($input_method, "EndDate");
    $formdata['Cost'] = filter_input($input_method, "Cost", FILTER_SANITIZE_NUMBER_INT);
    $formdata['LocID'] = filter_input($input_method, "LocID", FILTER_SANITIZE_NUMBER_INT);

    if (
        $formdata['Title'] === NULL ||
        $formdata['Title'] === FALSE ||
        $formdata['Title'] === ""
    ) {
        $errors['Title'] = "Title required";
    }

    if (
        $formdata['Description'] === NULL ||
        $formdata['Description'] === FALSE ||
        $formdata['Description'] === ""
    ) {
        $errors['Description'] = "Description required";
    }

    if (
        $formdata['EventType'] !== NULL &&
        $formdata['EventType'] !== FALSE &&
        $formdata['EventType'] !== ""
    ) {
        $type = array(1, 2, 3, 4);
        if (!in_array($formdata['EventType'], $type)) {
            $errors['EventType'] = "Invalid type";
        }
    }

    if (
        $formdata['StartDate'] === NULL ||
        $formdata['StartDate'] === FALSE ||
        $formdata['StartDate'] === ""
    ) {
        $errors['StartDate'] = "Start Date  required";
    }

    if (
        $formdata['EndDate'] === NULL ||
        $formdata['EndDate'] === FALSE ||
        $formdata['EndDate'] === ""
    ) {
        $errors['EndDate'] = "End Date required";
    }

    if ($formdata['Cost'] === "") {
        $capacity = intval($formdata['Cost']);
        if ($capacity < 0 || $capacity > 999999) {
        }
        $errors['Cost'] = "Cost required. Cannot be a negative value";
    }

    if ($formdata['LocID'] === "") {
        $locID = intval($formdata['LocID']);
        if ($locID < 0 || $capacity > 999999) {
        }
        $errors['LocID'] = "LocationID required. Cannot be a negative value";
    }
}
