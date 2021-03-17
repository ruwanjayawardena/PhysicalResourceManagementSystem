<?php

include '../models/itemSub2Category.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new ItemSub2Category();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllItemSub2Category") {
        $ctrl->setS2cat_subcategory($_POST['s2cat_subcategory']);
        $ctrl->getAllItemSub2Category();
    } else if ($_POST['action'] == "getItemSub2CategoryByID") {
        $ctrl->setS2cat_id($_POST['s2cat_id']);
        $ctrl->getItemSub2CategoryByID();
    } else if ($_POST['action'] == "cmbItemSub2Category") {
        $ctrl->setS2cat_subcategory($_POST['s2cat_subcategory']);
        $ctrl->cmbItemSub2Category();
    } else if ($_POST['action'] == "deleteItemSub2Category") {
        $ctrl->setS2cat_id($_POST['s2cat_id']);
        $ctrl->deleteItemSub2Category();
    } else if ($_POST['action'] == "saveItemSub2Category") {
        $ctrl->setS2cat_name($_POST['s2cat_name']);
        $ctrl->setS2cat_code($_POST['s2cat_code']);
        $ctrl->setS2cat_subcategory($_POST['s2cat_subcategory']);
        $ctrl->saveItemSub2Category();
    } else if ($_POST['action'] == 'editItemSub2Category') {
        $ctrl->setS2cat_id($_POST['s2cat_id']);
        $ctrl->setS2cat_name($_POST['s2cat_name']);
        $ctrl->setS2cat_code($_POST['s2cat_code']);
        $ctrl->setS2cat_subcategory($_POST['s2cat_subcategory']);
        $ctrl->editItemSub2Category();
    }
}