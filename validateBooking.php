<?php

function validateEvents($input_method, &$formdata, &$errors) {
    $formdata['Name'] = filter_input($input_method, "Name", FILTER_SANITIZE_STRING);
    $formdata['Email'] = filter_input($input_method, "Email", FILTER_SANITIZE_STRING);
    $formdata['ContactNum'] = filter_input($input_method, "ContactNum", FILTER_SANITIZE_STRING);
    $formdata['Title'] = filter_input($input_method, "Title", FILTER_SANITIZE_STRING);
    $formdata['Description'] = filter_input($input_method, "Description", FILTER_SANITIZE_STRING);
    $formdata['EventType'] = filter_input($input_method, "EventType", FILTER_SANITIZE_STRING);
    $formdata['StartDate'] = filter_input($input_method, "StartDate", FILTER_SANITIZE_STRING);
    $formdata['EndDate'] = filter_input($input_method, "EndDate", FILTER_SANITIZE_STRING);
    $formdata['Location'] = filter_input($input_method, "Location", FILTER_SANITIZE_NUMBER_INT);

    if ($formdata['Name'] === NULL ||
                    $formdata['Name'] === FALSE ||
                    $formdata['Name'] === "")
    {
        $errors['Name'] = "Name required";
    }

    if ($formdata['Email'] === NULL ||
                    $formdata['Email'] === FALSE ||
                    $formdata['Email'] === "")
    {
        $errors['Email'] = "Email required";
    }

    if ($formdata['ContactNum'] === NULL ||
                    $formdata['ContactNum'] === FALSE ||
                    $formdata['ContactNum'] === "")
    {
        $errors['ContactNum'] = "Contact number required";
    }

    if ($formdata['Title'] === NULL ||
                    $formdata['Title'] === FALSE ||
                    $formdata['Title'] === "")
    {
        $errors['Title'] = "Title required";
    }
    
    if ($formdata['Description'] === NULL ||
                    $formdata['Description'] === FALSE ||
                    $formdata['Description'] === "")
    {
        $errors['Description'] = "Description required";
    }   

    if ($formdata['EventType'] === NULL ||
                    $formdata['EventType'] === FALSE ||
                    $formdata['EventType'] === "")
    {
        $errors['EventType'] = "Event type required";
    } 
    
    if ($formdata['StartDate'] === NULL ||
                    $formdata['StartDate'] === FALSE ||
                    $formdata['StartDate'] === "")
    {
        $errors['StartDate'] = "Start Date  required";
    }
    
    if ($formdata['EndDate'] === NULL ||
                    $formdata['EndDate'] === FALSE ||
                    $formdata['EndDate'] === "")
    {
        $errors['EndDate'] = "End Date required";
    }
    
    if ($formdata['Location'] === ""){
        $locID = intval($formdata['Location']);
        if ($locID < 0 || $capacity > 999999) {
    }
        $errors['Location'] = "Location required";
    }
    
}
