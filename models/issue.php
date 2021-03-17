<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Issue extends ConnectDB {

	const TBL_Issue = 'st_issue';
	const TBL_IssueItem = 'st_issue_item';

	private $flag = false;
	private $issu_id;
	private $issu_institute;
	private $issu_send_institute;
	private $issu_custom_issueno;
	private $issu_description;
	private $issu_date;
	private $issu_time;
	private $issu_status;
	private $issu_created_usr;
	private $istm_id;
	private $istm_issue_id;
	private $istm_item;
	private $istm_qty;
	private $istm_status;
	private $istm_item_attribute;

	public function getIstm_item_attribute() {
		return $this->istm_item_attribute;
	}

	public function setIstm_item_attribute($istm_item_attribute) {
		$this->istm_item_attribute = $istm_item_attribute;
	}

	public function getFlag() {
		return $this->flag;
	}

	public function getIssu_id() {
		return $this->issu_id;
	}

	public function getIssu_institute() {
		return $this->issu_institute;
	}

	public function getIssu_send_institute() {
		return $this->issu_send_institute;
	}

	public function getIssu_custom_issueno() {
		return $this->issu_custom_issueno;
	}

	public function getIssu_description() {
		return $this->issu_description;
	}

	public function getIssu_date() {
		return $this->issu_date;
	}

	public function getIssu_time() {
		return $this->issu_time;
	}

	public function getIssu_status() {
		return $this->issu_status;
	}

	public function getIssu_created_usr() {
		return $this->issu_created_usr;
	}

	public function getIstm_id() {
		return $this->istm_id;
	}

	public function getIstm_issue_id() {
		return $this->istm_issue_id;
	}

	public function getIstm_item() {
		return $this->istm_item;
	}

	public function getIstm_qty() {
		return $this->istm_qty;
	}

	public function getIstm_status() {
		return $this->istm_status;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
	}

	public function setIssu_id($issu_id) {
		$this->issu_id = $issu_id;
	}

	public function setIssu_institute($issu_institute) {
		$this->issu_institute = $issu_institute;
	}

	public function setIssu_send_institute($issu_send_institute) {
		$this->issu_send_institute = $issu_send_institute;
	}

	public function setIssu_custom_issueno($issu_custom_issueno) {
		$this->issu_custom_issueno = $issu_custom_issueno;
	}

	public function setIssu_description($issu_description) {
		$this->issu_description = $issu_description;
	}

	public function setIssu_date($issu_date) {
		$this->issu_date = $issu_date;
	}

	public function setIssu_time($issu_time) {
		$this->issu_time = $issu_time;
	}

	public function setIssu_status($issu_status) {
		$this->issu_status = $issu_status;
	}

	public function setIssu_created_usr($issu_created_usr) {
		$this->issu_created_usr = $issu_created_usr;
	}

	public function setIstm_id($istm_id) {
		$this->istm_id = $istm_id;
	}

	public function setIstm_issue_id($istm_issue_id) {
		$this->istm_issue_id = $istm_issue_id;
	}

	public function setIstm_item($istm_item) {
		$this->istm_item = $istm_item;
	}

	public function setIstm_qty($istm_qty) {
		$this->istm_qty = $istm_qty;
	}

	public function setIstm_status($istm_status) {
		$this->istm_status = $istm_status;
	}

	public function getAllIssueItem() {
		$data = array();
		$sql = "SELECT
st_issue_item.istm_id,
st_issue_item.istm_issue_id,
st_issue_item.istm_item,
st_issue_item.istm_item_attribute,
st_issue_item.istm_qty,
st_issue_item.istm_status,
st_item_attribute.at_name,
st_item.itm_code,
st_item.itm_name,
st_mainstock.stk_qty,
st_item_attribute.at_price
FROM
st_issue_item
INNER JOIN st_mainstock ON st_issue_item.istm_item = st_mainstock.stk_item AND st_issue_item.istm_item_attribute = st_mainstock.stk_item_attribute
INNER JOIN st_item ON st_mainstock.stk_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_mainstock.stk_item_attribute = st_item_attribute.at_id
WHERE
st_issue_item.istm_issue_id = :istm_issue_id AND
st_mainstock.stk_institute = :stk_institute";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':istm_issue_id', $this->getIstm_issue_id(), PDO::PARAM_INT);
			$readstmt->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}
	
	public function getAllIssueItemNotInGRN($grtm_grn_id) {
		$data = array();
		$sql = "SELECT
st_issue_item.istm_id,
st_issue_item.istm_issue_id,
st_issue_item.istm_item,
st_issue_item.istm_item_attribute,
st_issue_item.istm_qty,
st_issue_item.istm_status,
st_item.itm_code,
st_item.itm_name,
st_item_attribute.at_name,
st_item_attribute.at_price
FROM
st_issue_item
INNER JOIN st_item ON st_issue_item.istm_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_issue_item.istm_item_attribute = st_item_attribute.at_id
WHERE
st_issue_item.istm_issue_id = :grn_issue_id AND
(st_issue_item.istm_item,st_issue_item.istm_item_attribute) NOT IN (SELECT
st_grn_item.grtm_item,
st_grn_item.grtm_item_attribute
FROM
st_grn_item
INNER JOIN st_grn ON st_grn_item.grtm_grn_id = st_grn.grn_id
WHERE
st_grn_item.grtm_grn_id = :grtm_grn_id AND
st_grn.grn_issue_id = :grn_issue_id) ";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':grn_issue_id', $this->getIstm_issue_id(), PDO::PARAM_INT);
			$readstmt->bindParam(':grtm_grn_id', $grtm_grn_id, PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getAllIssue() {
		$data = array();
		$sql = "SELECT
st_issue.issu_id,
st_issue.issu_institute,
st_issue.issu_send_institute,
st_issue.issu_custom_issueno,
st_issue.issu_description,
st_issue.issu_date,
st_issue.issu_time,
st_issue.issu_status,
st_issue.issu_created_usr,
st_institute.inst_name,
st_institute.inst_address,
st_institute.inst_phone,
st_institute.inst_email
FROM
st_issue
INNER JOIN st_institute ON st_issue.issu_send_institute = st_institute.inst_id
WHERE
st_issue.issu_institute = :issu_institute
ORDER BY
st_issue.issu_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':issu_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbIssue() {
		$data = array();
		$sql = "SELECT
st_issue.issu_id,
st_institute.inst_name,
st_issue.issu_custom_issueno
FROM
st_issue
INNER JOIN st_institute ON st_issue.issu_send_institute = st_institute.inst_id
WHERE
st_issue.issu_send_institute = :issu_send_institute AND
st_issue.issu_status = 1
ORDER BY
st_issue.issu_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':issu_send_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getIssueByID() {
		$data = array();
		$sql = "SELECT
st_issue.issu_id,
st_issue.issu_institute,
st_issue.issu_send_institute,
st_issue.issu_custom_issueno,
st_issue.issu_description,
st_issue.issu_date,
st_issue.issu_time,
st_issue.issu_status,
st_issue.issu_created_usr,
st_institute.inst_name,
st_institute.inst_address,
st_institute.inst_phone,
st_institute.inst_email
FROM
st_issue
INNER JOIN st_institute ON st_issue.issu_send_institute = st_institute.inst_id
WHERE
st_issue.issu_id = :issu_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}
	
	public function getIssueByIDReport() {
		$data = array();
		$dataIssue = array();
		$dataSend = array();
		$sql_sendInstitue = "SELECT
st_issue.issu_id,
st_issue.issu_institute,
st_issue.issu_send_institute,
st_issue.issu_custom_issueno,
st_issue.issu_description,
st_issue.issu_date,
st_issue.issu_time,
st_issue.issu_status,
st_issue.issu_created_usr,
st_institute.inst_name AS send_inst_name,
st_institute.inst_address AS send_inst_address,
st_institute.inst_phone AS send_inst_phone,
st_institute.inst_email AS send_inst_email,
st_division.div_name AS send_div_name,
st_zonal.zol_name AS send_zol_name,
st_province.prov_name AS send_prov_name,
st_institute_type.insttype_name AS send_insttype_name
FROM
st_issue
INNER JOIN st_institute ON st_issue.issu_send_institute = st_institute.inst_id
INNER JOIN st_division ON st_division.div_id = st_institute.inst_division
INNER JOIN st_zonal ON st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_zonal.zol_province = st_province.prov_id
INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
WHERE
st_issue.issu_id = :issu_id";
		$sql_issueInstitue = "SELECT
st_institute.inst_name AS issue_inst_name,
st_institute.inst_address AS issue_inst_address,
st_institute.inst_phone AS issue_inst_phone,
st_institute.inst_email AS issue_inst_email,
st_division.div_name AS issue_div_name,
st_zonal.zol_name AS issue_zol_name,
st_province.prov_name AS issue_prov_name,
st_institute_type.insttype_name AS issue_insttype_name
FROM
st_issue
INNER JOIN st_institute ON st_issue.issu_institute = st_institute.inst_id
INNER JOIN st_division ON st_institute.inst_division = st_division.div_id
INNER JOIN st_zonal ON st_institute.inst_zonal = st_zonal.zol_id AND st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_institute.inst_province = st_province.prov_id AND st_zonal.zol_province = st_province.prov_id
INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
WHERE
st_issue.issu_id = :issu_id";
		try {
			$readstmtSend = $this->con->prepare($sql_sendInstitue);
			$readstmtIssue = $this->con->prepare($sql_issueInstitue);
			$readstmtSend->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
			$readstmtIssue->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
			$readstmtSend->execute();
			$readstmtIssue->execute();
			while ($rowSend = $readstmtSend->fetch(PDO::FETCH_ASSOC)) {
				$dataSend[0] = $rowSend;
			}
			while ($rowIssue = $readstmtIssue->fetch(PDO::FETCH_ASSOC)) {
				$dataIssue[] = $rowIssue;
			}
			$data[] = array_merge_recursive($dataSend[0], $dataIssue[0]);
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getIssueItemByID() {
		$data = array();
		$sql = "SELECT
st_issue_item.istm_id,
st_issue_item.istm_issue_id,
st_issue_item.istm_item,
st_issue_item.istm_item_attribute,
st_issue_item.istm_qty,
st_issue_item.istm_status,
st_item.itm_sub2category,
st_item.itm_sub1category,
st_item.itm_maincategory,
st_item_attribute.at_attributetype
FROM
st_issue_item
INNER JOIN st_item ON st_issue_item.istm_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_issue_item.istm_item_attribute = st_item_attribute.at_id
WHERE
st_issue_item.istm_id = :istm_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':istm_id', $this->getIstm_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getNextAutoIssueID() {
		$nextid = 0;
		$sql = "SHOW TABLE STATUS LIKE 'st_issue'";
		$readstmt = $this->con->prepare($sql);
		$readstmt->execute();
		while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
			$nextid = $row->Auto_increment;
		}
		$this->setIssu_id($nextid);
		return $nextid;
	}

	public function completeIssue() {
		$flag = false;
		$sql_issueItem = "SELECT
st_issue_item.istm_id,
st_issue_item.istm_issue_id,
st_issue_item.istm_item,
st_issue_item.istm_item_attribute,
st_issue_item.istm_qty,
st_issue_item.istm_status,
st_item_attribute.at_name,
st_item.itm_code,
st_item.itm_name,
st_mainstock.stk_qty,
st_item_attribute.at_price
FROM
st_issue_item
INNER JOIN st_mainstock ON st_issue_item.istm_item = st_mainstock.stk_item AND st_issue_item.istm_item_attribute = st_mainstock.stk_item_attribute
INNER JOIN st_item ON st_mainstock.stk_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_mainstock.stk_item_attribute = st_item_attribute.at_id
WHERE
st_issue_item.istm_issue_id = :istm_issue_id AND
st_mainstock.stk_institute = :stk_institute";
		$sql_updateStock = "UPDATE `st_mainstock` SET `stk_qty`= :stk_qty WHERE (`stk_institute`= :stk_institute) AND (`stk_item` = :stk_item) AND (`stk_item_attribute` = :stk_item_attribute);
";
		try {
			$this->getCon()->beginTransaction();
			$readIsseItem = $this->con->prepare($sql_issueItem);
			$readIsseItem->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readIsseItem->bindParam(':istm_issue_id', $this->getIssu_id(), PDO::PARAM_INT);
			$readIsseItem->execute();

			while ($row = $readIsseItem->fetch(PDO::FETCH_OBJ)) {
				$balance_qty = ($row->stk_qty) - ($row->istm_qty);
				if ($balance_qty >= 0) {
					$updatestmt = $this->con->prepare($sql_updateStock);
					$updatestmt->bindParam(':stk_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
					$updatestmt->bindParam(':stk_item', $row->istm_item, PDO::PARAM_INT);
					$updatestmt->bindParam(':stk_item_attribute', $row->istm_item_attribute, PDO::PARAM_INT);
					$updatestmt->bindParam(':stk_qty', $balance_qty, PDO::PARAM_INT);
					$updatestmt->execute();
					$flag = true;
				} else {
					break;
					$flag = false;
				}
			}
			if ($flag) {
				$this->getCon()->commit();
				$this->setIssu_status(1);
				$status = $this->changeIssueStatus();
				if ($status) {
					echo json_encode(array("msgType" => 1, "msg" => "Successfully Processed"));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Processing Failed ! Please check Issue Item Qty with Available stock and fix it"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function saveIssue() {
		$this->getNextAutoIssueID();
		$sql = "INSERT INTO `st_issue` (`issu_institute`, `issu_send_institute`, `issu_custom_issueno`, `issu_description`, `issu_date`, `issu_time`, `issu_created_usr`) VALUES (:issu_institute, :issu_send_institute, :issu_custom_issueno, :issu_description, :issu_date, :issu_time, :issu_created_usr);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':issu_institute', $_SESSION['usrcat_institute'], PDO::PARAM_STR);
			$createstmt->bindParam(':issu_send_institute', $this->getIssu_send_institute(), PDO::PARAM_INT);
			$createstmt->bindParam(':issu_custom_issueno', $this->getIssu_custom_issueno(), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_description', $this->getIssu_description(), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_date', date("Y-m-d"), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_time', date("H:i:s"), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_created_usr', $_SESSION['usr_id'], PDO::PARAM_STR);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully saved.Please wait for continue to next item adding step", "issu_id" => $this->getIssu_id()));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate custom issue no.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function saveIssueItem() {
		$sql = "INSERT INTO `st_issue_item` (`istm_issue_id`, `istm_item`, `istm_item_attribute`, `istm_qty`) VALUES (:istm_issue_id, :istm_item, :istm_item_attribute, :istm_qty);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':istm_issue_id', $this->getIstm_issue_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':istm_item', $this->getIstm_item(), PDO::PARAM_INT);
			$createstmt->bindParam(':istm_qty', $this->getIstm_qty(), PDO::PARAM_INT);
			$createstmt->bindParam(':istm_item_attribute', $this->getIstm_item_attribute(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Item Added."));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! Item adding failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered Item was duplicated I.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function changeIssueStatus() {
		$sql = "UPDATE `st_issue` SET `issu_status`= :issu_status WHERE (`issu_id`=:issu_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':issu_status', $this->getIssu_status(), PDO::PARAM_INT);
			$createstmt->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				//0 - preparing, 1 - submited & pending ,2- accepted & processing, 3 - completed
				return true;
			} else {
				return false;
			}
		} catch (Exception $exc) {
			return false;
		}
	}

	public function deleteIssue() {
		$sql = "DELETE FROM `st_issue` WHERE (`issu_id`=:issu_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function deleteIssueItem() {
		$sql = "DELETE FROM `st_issue_item` WHERE (`istm_id`=:istm_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':istm_id', $this->getIstm_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function editIssue() {
		$sql = "UPDATE `st_issue` SET  `issu_send_institute`=:issu_send_institute, `issu_custom_issueno`=:issu_custom_issueno, `issu_description`=:issu_description, `issu_date`=:issu_date, `issu_time`=:issu_time, `issu_created_usr`=:issu_created_usr WHERE (`issu_id` = :issu_id) AND (`issu_status` = 0);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':issu_id', $this->getIssu_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':issu_send_institute', $this->getIssu_send_institute(), PDO::PARAM_INT);
			$createstmt->bindParam(':issu_custom_issueno', $this->getIssu_custom_issueno(), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_description', $this->getIssu_description(), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_date', date("Y-m-d"), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_time', date("H:i:s"), PDO::PARAM_STR);
			$createstmt->bindParam(':issu_created_usr', $_SESSION['usr_id'], PDO::PARAM_STR);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate attribute name.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function editIssueItem() {
		$sql = "UPDATE `st_issue_item` SET `istm_item`=:istm_item, `istm_item_attribute`=:istm_item_attribute, `istm_qty`=:istm_qty WHERE (`istm_id` = :istm_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':istm_id', $this->getIstm_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':istm_item', $this->getIstm_item(), PDO::PARAM_INT);
			$createstmt->bindParam(':istm_qty', $this->getIstm_qty(), PDO::PARAM_INT);
			$createstmt->bindParam(':istm_item_attribute', $this->getIstm_item_attribute(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully Item updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered Item was duplicated.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

}
