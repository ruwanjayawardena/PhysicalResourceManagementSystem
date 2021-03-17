<?php

include '../models/item.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Item();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllItem") {
        $ctrl->setItm_sub2category($_POST['itm_sub2category']);
        $ctrl->getAllItem();
    } else if ($_POST['action'] == "getItemByID") {
        $ctrl->setItm_id($_POST['itm_id']);
        $ctrl->getItemByID();
    } else if ($_POST['action'] == "cmbItem") {
        $ctrl->setItm_sub2category($_POST['itm_sub2category']);
        $ctrl->cmbItem();
    } else if ($_POST['action'] == "deleteItem") {
        $ctrl->setItm_id($_POST['itm_id']);
        $ctrl->deleteItem();
    } else if ($_POST['action'] == "saveItem") {
        $ctrl->setItm_code($_POST['itm_code']);
        $ctrl->setItm_name($_POST['itm_name']);
        $ctrl->setItm_maincategory($_POST['itm_maincategory']);
        $ctrl->setItm_sub1category($_POST['itm_sub1category']);
        $ctrl->setItm_sub2category($_POST['itm_sub2category']);
        $ctrl->setItm_selection_key($_POST['itm_selection_key']);
        $ctrl->saveItem();
    } else if ($_POST['action'] == 'editItem') {
        $ctrl->setItm_code($_POST['itm_code']);
        $ctrl->setItm_name($_POST['itm_name']);
        $ctrl->setItm_maincategory($_POST['itm_maincategory']);
        $ctrl->setItm_sub1category($_POST['itm_sub1category']);
        $ctrl->setItm_sub2category($_POST['itm_sub2category']);
        $ctrl->setItm_selection_key($_POST['itm_selection_key']);
        $ctrl->setItm_id($_POST['itm_id']);
        $ctrl->editItem();
    }
}