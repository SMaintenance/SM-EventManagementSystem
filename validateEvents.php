<?php

function validateEvents($inputMethod, &$formdata, &$errors)
{
    $formdata['Title'] = filter_input($inputMethod, "Title");
    $formdata['Description'] = filter_input($inputMethod, "Description");
    $formdata['eType'] = filter_input($inputMethod, "eType", FILTER_SANITIZE_NUMBER_INT);
    $formdata['StartDate'] = filter_input($inputMethod, "StartDate");
    $formdata['EndDate'] = filter_input($inputMethod, "EndDate");
    $formdata['Cost'] = filter_input($inputMethod, "Cost", FILTER_SANITIZE_NUMBER_INT);
    $formdata['LocID'] = filter_input($inputMethod, "LocID", FILTER_SANITIZE_NUMBER_INT);

    if (
        $formdata['Title'] === null ||
        $formdata['Title'] === false ||
        $formdata['Title'] === ""
    ) {
        $errors['Title'] = "Title required";
    }

    if (
        $formdata['Description'] === null ||
        $formdata['Description'] === false ||
        $formdata['Description'] === ""
    ) {
        $errors['Description'] = "Description required";
    }

    if (
        $formdata['eType'] !== null &&
        $formdata['eType'] !== false &&
        $formdata['eType'] !== ""
    ) {
        $type = array(1, 2, 3, 4);
        if (!in_array($formdata['eType'], $type)) {
            $errors['eType'] = "Invalid type";
        }
    }

    if (
        $formdata['StartDate'] === null ||
        $formdata['StartDate'] === false ||
        $formdata['StartDate'] === ""
    ) {
        $errors['StartDate'] = "Start Date  required";
    }

    if (
        $formdata['EndDate'] === null ||
        $formdata['EndDate'] === false ||
        $formdata['EndDate'] === ""
    ) {
        $errors['EndDate'] = "End Date required";
    }

    if ($formdata['Cost'] === "") {
        $capacity = intval($formdata['Cost']);
        $errors['Cost'] = "Cost required. Cannot be a negative value";
    }

    if ($formdata['LocID'] === "") {
        $locID = intval($formdata['LocID']);
        $errors['LocID'] = "LocationID required. Cannot be a negative value";
    }
}
