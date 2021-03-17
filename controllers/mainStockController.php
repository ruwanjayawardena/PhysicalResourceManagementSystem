<?php

include '../models/mainstock.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new MainStock();
if (array_key_exists("action", $_POST)) {
    if ($_POST['action'] == "getAllMainStock") {
//        $ctrl->setStk_item($_POST['stk_item']);
        $ctrl->getAllMainStock();
    } 
    else if ($_POST['action'] == "getAllMainStockFormat2") {
        $ctrl->getAllMainStockFormat2();
    } 
    else if ($_POST['action'] == "getAllMainStockFormatCentralized") {
        $ctrl->getAllMainStockFormatCentralized();
    } 
	else if ($_POST['action'] == "getMainStockByID") {
        $ctrl->setStk_id($_POST['stk_id']);
        $ctrl->getMainStockByID();
    } else if ($_POST['action'] == "deleteMainStock") {
        $ctrl->setStk_id($_POST['stk_id']);
        $ctrl->deleteMainStock();
    } else if ($_POST['action'] == "saveMainStock") {
        $ctrl->setStk_institute($_POST['stk_institute']);
        $ctrl->setStk_item($_POST['stk_item']);
        $ctrl->setStk_item_attribute($_POST['stk_item_attribute']);
        $ctrl->setStk_qty($_POST['stk_qty']);
        $ctrl->saveMainStock();
    } else if ($_POST['action'] == 'editMainStock') {
        $ctrl->setStk_institute($_POST['stk_institute']);
        $ctrl->setStk_item($_POST['stk_item']);
        $ctrl->setStk_item_attribute($_POST['stk_item_attribute']);
        $ctrl->setStk_qty($_POST['stk_qty']);
        $ctrl->setStk_id($_POST['stk_id']);
        $ctrl->editMainStock();
	}else if($_POST['action'] == 'getAvailableItemQTY'){		
        $ctrl->setStk_item($_POST['stk_item']);
        $ctrl->setStk_item_attribute($_POST['stk_item_attribute']);
		$ctrl->getAvailableItemQTY();
	}
}