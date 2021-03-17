<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class ItemMainCategory extends ConnectDB {

    const TBL_ItemMainCategory = 'st_item_maincategory';

    private $flag = false;
    private $mcat_id;
    private $mcat_code;
    private $mcat_name;

    public function getFlag() {
        return $this->flag;
    }

    public function getMcat_id() {
        return $this->mcat_id;
    }

    public function getMcat_code() {
        return $this->mcat_code;
    }

    public function getMcat_name() {
        return $this->mcat_name;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setMcat_id($mcat_id) {
        $this->mcat_id = $mcat_id;
    }

    public function setMcat_code($mcat_code) {
        $this->mcat_code = $mcat_code;
    }

    public function setMcat_name($mcat_name) {
        $this->mcat_name = $mcat_name;
    }

    public function getAllItemMainCategory() {
        $data = array();
        $sql = "SELECT
st_item_maincategory.mcat_id,
st_item_maincategory.mcat_code,
st_item_maincategory.mcat_name
FROM
st_item_maincategory
ORDER BY
st_item_maincategory.mcat_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function cmbItemMainCategory() {
        $data = array();
        $sql = "SELECT
st_item_maincategory.mcat_id,
st_item_maincategory.mcat_code,
st_item_maincategory.mcat_name
FROM
st_item_maincategory
ORDER BY
st_item_maincategory.mcat_code ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getItemMainCategoryByID() {
        $data = array();
        $sql = "SELECT
st_item_maincategory.mcat_id,
st_item_maincategory.mcat_code,
st_item_maincategory.mcat_name
FROM
st_item_maincategory
WHERE
st_item_maincategory.mcat_id = :mcat_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':mcat_id', $this->getMcat_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveItemMainCategory() {
        $sql = "INSERT INTO `st_item_maincategory` (`mcat_code`, `mcat_name`) VALUES (:mcat_code, :mcat_name);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':mcat_code', $this->getMcat_code(), PDO::PARAM_STR);
            $createstmt->bindParam(':mcat_name', $this->getMcat_name(), PDO::PARAM_STR);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate category code.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteItemMainCategory() {
        $sql = "DELETE FROM `st_item_maincategory` WHERE (`mcat_id`=:mcat_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':mcat_id', $this->getMcat_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editItemMainCategory() {
        $sql = "UPDATE `st_item_maincategory` SET `mcat_code`=:mcat_code, `mcat_name`=:mcat_name WHERE (`mcat_id`= :mcat_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':mcat_id', $this->getMcat_id(), PDO::PARAM_INT);
            $createstmt->bindParam(':mcat_code', $this->getMcat_code(), PDO::PARAM_STR);
            $createstmt->bindParam(':mcat_name', $this->getMcat_name(), PDO::PARAM_STR);
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
