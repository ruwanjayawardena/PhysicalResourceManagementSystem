<?php

include '../models/remove.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Remove();
if (array_key_exists("action", $_POST)) {
	if ($_POST['action'] == "getAllRemove") {
		$ctrl->getAllRemove();
	} else if ($_POST['action'] == "getRemoveByID") {
		$ctrl->setRm_id($_POST['rm_id']);
		$ctrl->getRemoveByID();
	} else if ($_POST['action'] == "deleteRemove") {
		$ctrl->setRm_id($_POST['rm_id']);
		$ctrl->deleteRemove();
	} else if ($_POST['action'] == "saveRemove") {
		$ctrl->setRm_custom_no($_POST['rm_custom_no']);
		$ctrl->setRm_desc($_POST['rm_desc']);
		$ctrl->setRm_item($_POST['rm_item']);
		$ctrl->setRm_item_attribute($_POST['rm_item_attribute']);
		$ctrl->setRm_qty($_POST['rm_qty']);
		$ctrl->saveRemove();
	} else if ($_POST['action'] == 'editRemove') {
		$ctrl->setRm_custom_no($_POST['rm_custom_no']);
		$ctrl->setRm_desc($_POST['rm_desc']);
		$ctrl->setRm_item($_POST['rm_item']);
		$ctrl->setRm_item_attribute($_POST['rm_item_attribute']);
		$ctrl->setRm_qty($_POST['rm_qty']);
		$ctrl->editRemove();
	}
}