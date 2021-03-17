<?php

include '../models/issue.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Issue();
if (array_key_exists("action", $_POST)) {
	if ($_POST['action'] == "saveIssue") {
		$ctrl->setIssu_custom_issueno($_POST['issu_custom_issueno']);
		$ctrl->setIssu_description($_POST['issu_description']);
		$ctrl->setIssu_send_institute($_POST['issu_send_institute']);
		$ctrl->saveIssue();
	}
	else if ($_POST['action'] == "getIssueByID") {
		$ctrl->setIssu_id($_POST['issu_id']);
		$ctrl->getIssueByID();
	} 
	else if ($_POST['action'] == "getIssueByIDReport") {
		$ctrl->setIssu_id($_POST['issu_id']);
		$ctrl->getIssueByIDReport();
	} 
	else if ($_POST['action'] == "saveIssueItem") {
		$ctrl->setIstm_issue_id($_POST['istm_issue_id']);
		$ctrl->setIstm_item($_POST['istm_item']);
		$ctrl->setIstm_item_attribute($_POST['istm_item_attribute']);
		$ctrl->setIstm_qty($_POST['istm_qty']);
		$ctrl->saveIssueItem();
	} else if ($_POST['action'] == "deleteIssueItem") {
		$ctrl->setIstm_id($_POST['istm_id']);
		$ctrl->deleteIssueItem();
	} else if ($_POST['action'] == "deleteIssue") {
		$ctrl->setIssu_id($_POST['issu_id']);
		$ctrl->deleteIssue();
	} else if ($_POST['action'] == "editIssueItem") {
		$ctrl->setIstm_id($_POST['istm_id']);
		$ctrl->setIstm_item($_POST['istm_item']);
		$ctrl->setIstm_item_attribute($_POST['istm_item_attribute']);
		$ctrl->setIstm_qty($_POST['istm_qty']);
		$ctrl->editIssueItem();
	} 
	else if ($_POST['action'] == "getAllIssueItem") {
		$ctrl->setIstm_issue_id($_POST['istm_issue_id']);
		$ctrl->getAllIssueItem();
	} 
	else if ($_POST['action'] == "getAllIssueItemNotInGRN") {
		$ctrl->setIstm_issue_id($_POST['istm_issue_id']);
		$ctrl->getAllIssueItemNotInGRN($_POST['grtm_grn_id']);
	} 
	else if ($_POST['action'] == "getAllIssue") {
		$ctrl->getAllIssue();
	} else if ($_POST['action'] == "getIssueItemByID") {
		$ctrl->setIstm_id($_POST['istm_id']);
		$ctrl->getIssueItemByID();
	}
	else if ($_POST['action'] == "completeIssue") {
		$ctrl->setIssu_id($_POST['issu_id']);
		$ctrl->completeIssue();
	}
	else if ($_POST['action'] == "cmbIssue") {		
		$ctrl->cmbIssue();
	}
}