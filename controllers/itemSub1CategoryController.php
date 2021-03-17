<?php

include '../models/itemSub1Category.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new ItemSub1Category();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllItemSub1Category") {
        $ctrl->setScat_maincategory($_POST['scat_maincategory']);
        $ctrl->getAllItemSub1Category();
    } else if ($_POST['action'] == "getItemSub1CategoryByID") {
        $ctrl->setScat_id($_POST['scat_id']);
        $ctrl->getItemSub1CategoryByID();
    } else if ($_POST['action'] == "cmbItemSub1Category") {
        $ctrl->setScat_maincategory($_POST['scat_maincategory']);
        $ctrl->cmbItemSub1Category();
    } else if ($_POST['action'] == "deleteItemSub1Category") {
        $ctrl->setScat_id($_POST['scat_id']);
        $ctrl->deleteItemSub1Category();
    } else if ($_POST['action'] == "saveItemSub1Category") {
        $ctrl->setScat_name($_POST['scat_name']);
        $ctrl->setScat_code($_POST['scat_code']);
        $ctrl->setScat_maincategory($_POST['scat_maincategory']);
        $ctrl->saveItemSub1Category($_POST['addDefault2ndSub']);
    } else if ($_POST['action'] == 'editItemSub1Category') {
        $ctrl->setScat_id($_POST['scat_id']);
        $ctrl->setScat_name($_POST['scat_name']);
        $ctrl->setScat_code($_POST['scat_code']);
        $ctrl->setScat_maincategory($_POST['scat_maincategory']);
        $ctrl->editItemSub1Category();
    }
}