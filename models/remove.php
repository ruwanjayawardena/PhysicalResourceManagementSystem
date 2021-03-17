<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Remove extends ConnectDB {

	const TBL_Remove = 'st_remove';

	private $flag = false;
	private $rm_id;
	private $rm_custom_no;
	private $rm_institute;
	private $rm_item;
	private $rm_item_attribute;
	private $rm_qty;
	private $rm_desc;
	private $rm_date;
	private $rm_time;
	private $rm_created_usr;

	public function getFlag() {
		return $this->flag;
	}

	public function getRm_id() {
		return $this->rm_id;
	}

	public function getRm_custom_no() {
		return $this->rm_custom_no;
	}

	public function getRm_institute() {
		return $this->rm_institute;
	}

	public function getRm_item() {
		return $this->rm_item;
	}

	public function getRm_item_attribute() {
		return $this->rm_item_attribute;
	}

	public function getRm_qty() {
		return $this->rm_qty;
	}

	public function getRm_desc() {
		return $this->rm_desc;
	}

	public function getRm_date() {
		return $this->rm_date;
	}

	public function getRm_time() {
		return $this->rm_time;
	}

	public function getRm_created_usr() {
		return $this->rm_created_usr;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
	}

	public function setRm_id($rm_id) {
		$this->rm_id = $rm_id;
	}

	public function setRm_custom_no($rm_custom_no) {
		$this->rm_custom_no = $rm_custom_no;
	}

	public function setRm_institute($rm_institute) {
		$this->rm_institute = $rm_institute;
	}

	public function setRm_item($rm_item) {
		$this->rm_item = $rm_item;
	}

	public function setRm_item_attribute($rm_item_attribute) {
		$this->rm_item_attribute = $rm_item_attribute;
	}

	public function setRm_qty($rm_qty) {
		$this->rm_qty = $rm_qty;
	}

	public function setRm_desc($rm_desc) {
		$this->rm_desc = $rm_desc;
	}

	public function setRm_date($rm_date) {
		$this->rm_date = $rm_date;
	}

	public function setRm_time($rm_time) {
		$this->rm_time = $rm_time;
	}

	public function setRm_created_usr($rm_created_usr) {
		$this->rm_created_usr = $rm_created_usr;
	}

	public function getAllRemove() {
		$data = array();
		$sql = "SELECT
st_remove.rm_id,
st_remove.rm_custom_no,
st_remove.rm_institute,
st_remove.rm_item,
st_remove.rm_item_attribute,
st_remove.rm_qty,
st_remove.rm_desc,
st_remove.rm_date,
st_remove.rm_time,
st_remove.rm_created_usr,
st_item.itm_code,
st_item.itm_name,
st_item_attribute.at_name,
st_item_attribute.at_price,
st_item_attribute.at_attributetype,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category,
st_item.itm_selection_key,
IFNULL((SELECT
st_mainstock.stk_qty
FROM
st_mainstock
WHERE
st_mainstock.stk_institute = :rm_institute AND
st_mainstock.stk_item = st_remove.rm_item AND
st_mainstock.stk_item_attribute = st_remove.rm_item_attribute),'Stock not Available') AS stk_qty
FROM
st_remove
INNER JOIN st_item ON st_remove.rm_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_remove.rm_item_attribute = st_item_attribute.at_id
WHERE
st_remove.rm_institute = :rm_institute";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':rm_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getRemoveByID() {
		$data = array();
		$sql = "SELECT
st_remove.rm_id,
st_remove.rm_custom_no,
st_remove.rm_institute,
st_remove.rm_item,
st_remove.rm_item_attribute,
st_remove.rm_qty,
st_remove.rm_desc,
st_remove.rm_date,
st_remove.rm_time,
st_remove.rm_created_usr,
st_item.itm_code,
st_item.itm_name,
st_item_attribute.at_name,
st_item_attribute.at_price,
st_item_attribute.at_attributetype,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category,
st_item.itm_selection_key,
IFNULL((SELECT
st_mainstock.stk_qty
FROM
st_mainstock
WHERE
st_mainstock.stk_institute = :rm_institute AND
st_mainstock.stk_item = st_remove.rm_item AND
st_mainstock.stk_item_attribute = st_remove.rm_item_attribute),'Stock not Available') AS stk_qty
FROM
st_remove
INNER JOIN st_item ON st_remove.rm_item = st_item.itm_id
INNER JOIN st_item_attribute ON st_remove.rm_item_attribute = st_item_attribute.at_id
WHERE
st_remove.rm_institute = :rm_institute AND
st_remove.rm_id = :rm_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':rm_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->bindParam(':rm_id', $this->getRm_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function saveRemove() {
		$sql = "INSERT INTO `st_remove` (`rm_custom_no`, `rm_institute`, `rm_item`, `rm_item_attribute`, `rm_qty`, `rm_desc`, `rm_date`, `rm_time`, `rm_created_usr`) VALUES (:rm_custom_no, :rm_institute, :rm_item, :rm_item_attribute, :rm_qty, :rm_desc, :rm_date, :rm_time, :rm_created_usr);";
		$sql_updateStock = "UPDATE `st_mainstock` SET `stk_qty`= `stk_qty`-:rm_qty WHERE (`stk_institute`=:rm_institute) AND (`stk_item` = :rm_item) AND (`stk_item_attribute` = :rm_item_attribute);
";
		try {
			$this->getCon()->beginTransaction();
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':rm_custom_no', $this->getRm_custom_no(), PDO::PARAM_STR);
			$createstmt->bindParam(':rm_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$createstmt->bindParam(':rm_item', $this->getRm_item(), PDO::PARAM_INT);
			$createstmt->bindParam(':rm_item_attribute', $this->getRm_item_attribute(), PDO::PARAM_INT);
			$createstmt->bindParam(':rm_qty', $this->getRm_qty(), PDO::PARAM_INT);
			$createstmt->bindParam(':rm_desc', $this->getRm_desc(), PDO::PARAM_STR);
			$createstmt->bindParam(':rm_date', date("Y-m-d"), PDO::PARAM_STR);
			$createstmt->bindParam(':rm_time', date("H:i:s"), PDO::PARAM_STR);
			$createstmt->bindParam(':rm_created_usr', $_SESSION['usr_id'], PDO::PARAM_STR);
			if ($createstmt->execute()) {
				//update stock
				$createstmt2 = $this->con->prepare($sql_updateStock);
				$createstmt2->bindParam(':rm_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
				$createstmt2->bindParam(':rm_item', $this->getRm_item(), PDO::PARAM_INT);
				$createstmt2->bindParam(':rm_item_attribute', $this->getRm_item_attribute(), PDO::PARAM_INT);
				$createstmt2->bindParam(':rm_qty', $this->getRm_qty(), PDO::PARAM_INT);
				if ($createstmt2->execute()) {
					$this->getCon()->commit();
					echo json_encode(array("msgType" => 1, "msg" => "Successfully saved & stock updated"));
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate remove ID.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

	public function deleteRemove() {
		$flag = false;
		$flag2 = false;
		$sql = "DELETE FROM `st_remove` WHERE (`rm_id`=:rm_id);";
		$sql_removeItemInfo = "SELECT
st_remove.rm_id,
st_remove.rm_custom_no,
st_remove.rm_institute,
st_remove.rm_item,
st_remove.rm_item_attribute,
st_remove.rm_qty,
st_remove.rm_desc,
st_remove.rm_date,
st_remove.rm_time,
st_remove.rm_created_usr
FROM
st_remove
WHERE
st_remove.rm_id = :rm_id AND
st_remove.rm_institute = :rm_institute";
		$sql_updateStock = "UPDATE `st_mainstock` SET `stk_qty`=`stk_qty`+:rm_qty WHERE (`stk_institute`=:rm_institute) AND (`stk_item` = :rm_item) AND (`stk_item_attribute` = :rm_item_attribute);";
		try {
			$this->getCon()->beginTransaction();
			$readstmt = $this->con->prepare($sql_removeItemInfo);
			$readstmt->bindParam(':rm_id', $this->getRm_id(), PDO::PARAM_INT);
			$readstmt->bindParam(':rm_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {				
				$createstmt = $this->con->prepare($sql_updateStock);
				$createstmt->bindParam(':rm_qty', $row->rm_qty, PDO::PARAM_INT);
				$createstmt->bindParam(':rm_institute', $_SESSION['usrcat_institute'], PDO::PARAM_INT);
				$createstmt->bindParam(':rm_item', $row->rm_item, PDO::PARAM_INT);
				$createstmt->bindParam(':rm_item_attribute', $row->rm_item_attribute, PDO::PARAM_INT);
				$flag = $createstmt->execute();
			}
			if ($flag) {
				$createstmt2 = $this->con->prepare($sql);
				$createstmt2->bindParam(':rm_id', $this->getRm_id(), PDO::PARAM_INT);
				$flag2 = $createstmt2->execute();				
				if ($flag2) {
					$this->getCon()->commit();
					echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted and re-stocked removed item"));
				}else{
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
				}
			} else {
				$this->getCon()->rollBack();
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}			
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function editRemove() {
		$sql = "UPDATE `st_remove` SET `rm_custom_no`=:rm_custom_no, `rm_item`=:rm_item, `rm_item_attribute`=:rm_item_attribute, `rm_qty`=:rm_qty, `rm_desc`=:rm_desc WHERE (`rm_id = :rm_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':rm_custom_no', $this->getRm_custom_no(), PDO::PARAM_STR);
			$createstmt->bindParam(':rm_item', $this->getRm_item(), PDO::PARAM_INT);
			$createstmt->bindParam(':rm_item_attribute', $this->getRm_item_attribute(), PDO::PARAM_INT);
			$createstmt->bindParam(':rm_qty', $this->getRm_qty(), PDO::PARAM_INT);
			$createstmt->bindParam(':rm_desc', $this->getRm_desc(), PDO::PARAM_STR);
			$createstmt->bindParam(':rm_id', $this->getRm_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate remove ID.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

}
