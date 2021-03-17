<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class ItemSub1Category extends ConnectDB {

	const TBL_ItemSub1Category = 'st_item_sub1category';

	private $flag = false;
	private $scat_id;
	private $scat_code;
	private $scat_name;
	private $scat_maincategory;

	public function getFlag() {
		return $this->flag;
	}

	public function getScat_id() {
		return $this->scat_id;
	}

	public function getScat_code() {
		return $this->scat_code;
	}

	public function getScat_name() {
		return $this->scat_name;
	}

	public function getScat_maincategory() {
		return $this->scat_maincategory;
	}

	public function setFlag($flag) {
		$this->flag = $flag;
	}

	public function setScat_id($scat_id) {
		$this->scat_id = $scat_id;
	}

	public function setScat_code($scat_code) {
		$this->scat_code = $scat_code;
	}

	public function setScat_name($scat_name) {
		$this->scat_name = $scat_name;
	}

	public function setScat_maincategory($scat_maincategory) {
		$this->scat_maincategory = $scat_maincategory;
	}

	function getNextAutoSub1Category() {
		$nextid = 0;
		$sql = "SHOW TABLE STATUS LIKE 'st_item_sub1category'";
		$readstmt = $this->con->prepare($sql);
		$readstmt->execute();
		while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
			$nextid = $row->Auto_increment;
		}
		$this->setScat_id($nextid);
	}

	public function getAllItemSub1Category() {
		$data = array();
		$sql = "SELECT
st_item_sub1category.scat_id,
st_item_sub1category.scat_code,
st_item_sub1category.scat_name,
st_item_sub1category.scat_maincategory
FROM
st_item_sub1category
WHERE
st_item_sub1category.scat_maincategory = :scat_maincategory
ORDER BY
st_item_sub1category.scat_id DESC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':scat_maincategory', $this->getScat_maincategory(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function cmbItemSub1Category() {
		$data = array();
		$sql = "SELECT
st_item_sub1category.scat_id,
st_item_sub1category.scat_code,
st_item_sub1category.scat_name,
st_item_sub1category.scat_maincategory
FROM
st_item_sub1category
WHERE
st_item_sub1category.scat_maincategory = :scat_maincategory
ORDER BY
st_item_sub1category.scat_code ASC";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':scat_maincategory', $this->getScat_maincategory(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function getItemSub1CategoryByID() {
		$data = array();
		$sql = "SELECT
st_item_sub1category.scat_id,
st_item_sub1category.scat_code,
st_item_sub1category.scat_name,
st_item_sub1category.scat_maincategory
FROM
st_item_sub1category
WHERE
st_item_sub1category.scat_id = :scat_id";
		try {
			$readstmt = $this->con->prepare($sql);
			$readstmt->bindParam(':scat_id', $this->getScat_id(), PDO::PARAM_INT);
			$readstmt->execute();
			while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
			echo json_encode($data);
		} catch (Exception $exc) {
			echo json_encode($data);
		}
	}

	public function saveItemSub1Category($addDefault2ndSub) {
		$this->getNextAutoSub1Category();
		$sql = "INSERT INTO `st_item_sub1category` (`scat_code`, `scat_name`, `scat_maincategory`) VALUES (:scat_code, :scat_name, :scat_maincategory);";
		$sql_sub2 = "INSERT INTO `st_item_sub2category` (`s2cat_code`, `s2cat_name`, `s2cat_subcategory`) VALUES('DEF','Default', :s2cat_subcategory);";
		try {
			$this->getCon()->beginTransaction();
			if ($addDefault2ndSub == 1) {
				$createstmt = $this->con->prepare($sql);
				$createstmt->bindParam(':scat_code', $this->getScat_code(), PDO::PARAM_STR);
				$createstmt->bindParam(':scat_name', $this->getScat_name(), PDO::PARAM_STR);
				$createstmt->bindParam(':scat_maincategory', $this->getScat_maincategory(), PDO::PARAM_INT);
				if ($createstmt->execute()) {
					$createstmt2 = $this->con->prepare($sql_sub2);					
					$createstmt2->bindParam(':s2cat_subcategory', $this->getScat_id(), PDO::PARAM_INT);
					if ($createstmt2->execute()) {
						$this->getCon()->commit();
						echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
					} else {
						$this->getCon()->rollBack();
						echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
					}					
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
				}
			} else {
				$createstmt = $this->con->prepare($sql);
				$createstmt->bindParam(':scat_code', $this->getScat_code(), PDO::PARAM_STR);
				$createstmt->bindParam(':scat_name', $this->getScat_name(), PDO::PARAM_STR);
				$createstmt->bindParam(':scat_maincategory', $this->getScat_maincategory(), PDO::PARAM_INT);
				if ($createstmt->execute()) {
					$this->getCon()->commit();
					echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
				} else {
					$this->getCon()->rollBack();
					echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
				}
			}
		} catch (Exception $exc) {
//			if ($exc->getCode() == 23000) {
//				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate category code.Please check and change it"));
//			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
//			}
		}
	}

	public function deleteItemSub1Category() {
		$sql = "DELETE FROM `st_item_sub1category` WHERE (`scat_id`=:scat_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':scat_id', $this->getScat_id(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
			}
		} catch (Exception $exc) {
			echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
		}
	}

	public function editItemSub1Category() {
		$sql = "UPDATE `st_item_sub1category` SET `scat_code`=:scat_code, `scat_name`=:scat_name, `scat_maincategory`=:scat_maincategory WHERE (`scat_id` =:scat_id);";
		try {
			$createstmt = $this->con->prepare($sql);
			$createstmt->bindParam(':scat_id', $this->getScat_id(), PDO::PARAM_INT);
			$createstmt->bindParam(':scat_code', $this->getScat_code(), PDO::PARAM_STR);
			$createstmt->bindParam(':scat_name', $this->getScat_name(), PDO::PARAM_STR);
			$createstmt->bindParam(':scat_maincategory', $this->getScat_maincategory(), PDO::PARAM_INT);
			if ($createstmt->execute()) {
				echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
			}
		} catch (Exception $exc) {
			if ($exc->getCode() == 23000) {
				echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate category code.Please check and change it"));
			} else {
				echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
			}
		}
	}

}
