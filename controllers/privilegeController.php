<?php

include '../models/privilege.php';

/**
 * @author Ruwan Jayawardena
 */
$ctrl = new Privilege();
if (array_key_exists("action", $_POST)) {
	if ($_POST['action'] == "availablePrivileges") {
		$ctrl->setAsn_usercategory($_POST['asn_usercategory']);
		$ctrl->availablePrivileges();
	} else if ($_POST['action'] == "availablePrivilegesInstitute") {
		$ctrl->setAsn_usercategory($_POST['asn_usercategory']);
		$ctrl->availablePrivilegesInstitute();
	} 
	else if ($_POST['action'] == "assignedPrivileges") {
		$ctrl->setAsn_usercategory($_POST['asn_usercategory']);
		$ctrl->assignedPrivileges();
	}
	else if ($_POST['action'] == "assignedPrivilegesInstitute") {
		$ctrl->setAsn_usercategory($_POST['asn_usercategory']);
		$ctrl->assignedPrivilegesInstitute();
	}
	else if ($_POST['action'] == "assignPrivilege") {
		$ctrl->setAsn_usercategory($_POST['asn_usercategory']);
		$ctrl->assignPrivilege($_POST['assignselected']);
	} else if ($_POST['action'] == "removeselected") {
		$ctrl->setAsn_usercategory($_POST['asn_usercategory']);
		$ctrl->removePrivilege($_POST['removeselected']);
	}
//    else if ($_POST['action'] == "deleteUserCategory") {
//        $ctrl->setUsrcat_id($_POST['usrcat_id']);
//        $ctrl->deleteUserCategory();
//    } else if ($_POST['action'] == "saveUserCategory") {
//        $ctrl->setUsrcat_name($_POST['usrcat_name']);
//        $ctrl->setUsrcat_institute($_POST['usrcat_institute']);
//        $ctrl->saveUserCategory();
//    } else if ($_POST['action'] == 'editUserCategory') {
//        $ctrl->setUsrcat_name($_POST['usrcat_name']);
//        $ctrl->setUsrcat_institute($_POST['usrcat_institute']);
//        $ctrl->setUsrcat_id($_POST['usrcat_id']);
//        $ctrl->editUserCategory();
//    }
}