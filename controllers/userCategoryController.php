<?php

include '../models/userCategory.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new UserCategory();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllUserCategory") {
        $ctrl->setUsrcat_institute($_POST['usrcat_institute']);
        $ctrl->getAllUserCategory();
    } else if ($_POST['action'] == "getUserCategoryByID") {
        $ctrl->setUsrcat_id($_POST['usrcat_id']);
        $ctrl->getUserCategoryByID();
    } else if ($_POST['action'] == "cmbUserCategory") {
        $ctrl->setUsrcat_institute($_POST['usrcat_institute']);
        $ctrl->cmbUserCategory();
    } else if ($_POST['action'] == "deleteUserCategory") {
        $ctrl->setUsrcat_id($_POST['usrcat_id']);
        $ctrl->deleteUserCategory();
    } else if ($_POST['action'] == "saveUserCategory") {
        $ctrl->setUsrcat_name($_POST['usrcat_name']);
        $ctrl->setUsrcat_institute($_POST['usrcat_institute']);
        $ctrl->saveUserCategory();
    } else if ($_POST['action'] == 'editUserCategory') {
        $ctrl->setUsrcat_name($_POST['usrcat_name']);
        $ctrl->setUsrcat_institute($_POST['usrcat_institute']);
        $ctrl->setUsrcat_id($_POST['usrcat_id']);
        $ctrl->editUserCategory();
    }
}