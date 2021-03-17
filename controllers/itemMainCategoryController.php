<?php

include '../models/itemMainCategory.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new ItemMainCategory();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllItemMainCategory") {
        $ctrl->getAllItemMainCategory();
    } else if ($_POST['action'] == "getItemMainCategoryByID") {
        $ctrl->setMcat_id($_POST['mcat_id']);
        $ctrl->getItemMainCategoryByID();
    } else if ($_POST['action'] == "cmbItemMainCategory") {
        $ctrl->cmbItemMainCategory();
    } else if ($_POST['action'] == "deleteItemMainCategory") {
        $ctrl->setMcat_id($_POST['mcat_id']);
        $ctrl->deleteItemMainCategory();
    } else if ($_POST['action'] == "saveItemMainCategory") {
        $ctrl->setMcat_name($_POST['mcat_name']);
        $ctrl->setMcat_code($_POST['mcat_code']);
        $ctrl->saveItemMainCategory();
    } else if ($_POST['action'] == 'editItemMainCategory') {
        $ctrl->setMcat_id($_POST['mcat_id']);
        $ctrl->setMcat_name($_POST['mcat_name']);
        $ctrl->setMcat_code($_POST['mcat_code']);
        $ctrl->editItemMainCategory();
    }
}