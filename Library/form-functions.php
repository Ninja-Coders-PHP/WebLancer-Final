<?php

// To populate a dropdown menu for roles.
function populateDropdown($roles, $select = "")
{
    $html_dropdown = "";
    foreach ($roles as $role) {
//        if(!($role->role_name == "Admin"))
//        {
//            $selected = $select == $role->id ? "selected" : "";
//            $html_dropdown .= "<option $selected value='$role->id'>$role->role_name</option>";
//        }
        $selected = $select == $role->id ? "selected" : "";
        $html_dropdown .= "<option $selected value='$role->id'>$role->role_name</option>";

    }

    return $html_dropdown;

}

// To populate a dropdown menu for statuses.
function populateDropdownStatus($statuses, $select = ""){
    $html_dropdown = "";
    foreach ($statuses as $status) {
        $selected = $select == $status->id ? "selected" : "";
        $html_dropdown .= "<option $selected value='$status->id'>$status->status</option>";
    }

    return $html_dropdown;
}
