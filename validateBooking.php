<?php

function validateEvents($inputMethod, &$formdata, &$errors)
{
    $formdata['Name'] = filter_input($inputMethod, "Name", FILTER_SANITIZE_STRING);
    $formdata['Email'] = filter_input($inputMethod, "Email", FILTER_SANITIZE_STRING);
    $formdata['ContactNum'] = filter_input($inputMethod, "ContactNum", FILTER_SANITIZE_STRING);
    $formdata['Title'] = filter_input($inputMethod, "Title", FILTER_SANITIZE_STRING);
    $formdata['Description'] = filter_input($inputMethod, "Description", FILTER_SANITIZE_STRING);
    $formdata['EventType'] = filter_input($inputMethod, "EventType", FILTER_SANITIZE_STRING);
    $formdata['StartDate'] = filter_input($inputMethod, "StartDate", FILTER_SANITIZE_STRING);
    $formdata['EndDate'] = filter_input($inputMethod, "EndDate", FILTER_SANITIZE_STRING);
    $formdata['Location'] = filter_input($inputMethod, "Location", FILTER_SANITIZE_NUMBER_INT);

    if ($formdata['Name'] === null ||
                    $formdata['Name'] === false ||
                    $formdata['Name'] === "") {
        $errors['Name'] = "Name required";
    }

    if ($formdata['Email'] === null ||
                    $formdata['Email'] === false ||
                    $formdata['Email'] === "") {
        $errors['Email'] = "Email required";
    }

    if ($formdata['ContactNum'] === null ||
                    $formdata['ContactNum'] === false ||
                    $formdata['ContactNum'] === "") {
        $errors['ContactNum'] = "Contact number required";
    }

    if ($formdata['Title'] === null ||
                    $formdata['Title'] === false ||
                    $formdata['Title'] === "") {
        $errors['Title'] = "Title required";
    }
    
    if ($formdata['Description'] === null ||
                    $formdata['Description'] === false ||
                    $formdata['Description'] === "") {
        $errors['Description'] = "Description required";
    }

    if ($formdata['EventType'] === null ||
                    $formdata['EventType'] === false ||
                    $formdata['EventType'] === "") {
        $errors['EventType'] = "Event type required";
    }
    
    if ($formdata['StartDate'] === null ||
                    $formdata['StartDate'] === false ||
                    $formdata['StartDate'] === "") {
        $errors['StartDate'] = "Start Date  required";
    }
    
    if ($formdata['EndDate'] === null ||
                    $formdata['EndDate'] === false ||
                    $formdata['EndDate'] === "") {
        $errors['EndDate'] = "End Date required";
    }
    
    if ($formdata['Location'] === "") {
        $errors['Location'] = "Location required";
    }
}
