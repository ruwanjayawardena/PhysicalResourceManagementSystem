<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Item extends ConnectDB {

    const TBL_Item = 'st_item';

    private $flag = false;
    private $itm_id;
    private $itm_code;
    private $itm_name;
    private $itm_maincategory;
    private $itm_sub1category;
    private $itm_sub2category;
    private $itm_selection_key;

    public function getFlag() {
        return $this->flag;
    }

    public function getItm_id() {
        return $this->itm_id;
    }

    public function getItm_code() {
        return $this->itm_code;
    }

    public function getItm_name() {
        return $this->itm_name;
    }

    public function getItm_maincategory() {
        return $this->itm_maincategory;
    }

    public function getItm_sub1category() {
        return $this->itm_sub1category;
    }

    public function getItm_sub2category() {
        return $this->itm_sub2category;
    }

    public function getItm_selection_key() {
        return $this->itm_selection_key;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setItm_id($itm_id) {
        $this->itm_id = $itm_id;
    }

    public function setItm_code($itm_code) {
        $this->itm_code = $itm_code;
    }

    public function setItm_name($itm_name) {
        $this->itm_name = $itm_name;
    }

    public function setItm_maincategory($itm_maincategory) {
        $this->itm_maincategory = $itm_maincategory;
    }

    public function setItm_sub1category($itm_sub1category) {
        $this->itm_sub1category = $itm_sub1category;
    }

    public function setItm_sub2category($itm_sub2category) {
        $this->itm_sub2category = $itm_sub2category;
    }

    public function setItm_selection_key($itm_selection_key) {
        $this->itm_selection_key = $itm_selection_key;
    }

    public function getAllItem() {
        $data = array();
        $sql = "SELECT
st_item.itm_id,
st_item.itm_code,
st_item.itm_name,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category,
st_item.itm_selection_key
FROM
st_item
WHERE
st_item.itm_sub2category = :itm_sub2category
ORDER BY
st_item.itm_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':itm_sub2category', $this->getItm_sub2category(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }
    
    public function cmbItem() {
        $data = array();
        $sql = "SELECT
st_item.itm_id,
st_item.itm_code,
st_item.itm_name
FROM
st_item
WHERE
st_item.itm_sub2category = :itm_sub2category
ORDER BY
st_item.itm_code ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':itm_sub2category', $this->getItm_sub2category(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getItemByID() {
        $data = array();
        $sql = "SELECT
st_item.itm_id,
st_item.itm_code,
st_item.itm_name,
st_item.itm_maincategory,
st_item.itm_sub1category,
st_item.itm_sub2category,
st_item.itm_selection_key
FROM
st_item
WHERE
st_item.itm_id = :itm_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':itm_id', $this->getItm_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveItem() {
        $sql = "INSERT INTO `st_item` (`itm_code`, `itm_name`, `itm_maincategory`, `itm_sub1category`, `itm_sub2category`, `itm_selection_key`) VALUES (:itm_code, :itm_name, :itm_maincategory, :itm_sub1category, :itm_sub2category, :itm_selection_key);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':itm_code', $this->getItm_code(), PDO::PARAM_STR);
            $createstmt->bindParam(':itm_name', $this->getItm_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':itm_selection_key', $this->getItm_selection_key(), PDO::PARAM_INT);
            $createstmt->bindParam(':itm_maincategory', $this->getItm_maincategory(), PDO::PARAM_INT);
            $createstmt->bindParam(':itm_sub1category', $this->getItm_sub1category(), PDO::PARAM_INT);
            $createstmt->bindParam(':itm_sub2category', $this->getItm_sub2category(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate item code.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteItem() {
        $sql = "DELETE FROM `st_item` WHERE (`itm_id`=:itm_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':itm_id', $this->getItm_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editItem() {
        $sql = "UPDATE `st_item` SET `itm_code`=:itm_code, `itm_name`=:itm_name, `itm_maincategory`=:itm_maincategory, `itm_sub1category`=:itm_sub1category, `itm_sub2category`=:itm_sub2category, `itm_selection_key`=:itm_selection_key WHERE (`itm_id` = :itm_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':itm_code', $this->getItm_code(), PDO::PARAM_STR);
            $createstmt->bindParam(':itm_name', $this->getItm_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':itm_selection_key', $this->getItm_selection_key(), PDO::PARAM_INT);
            $createstmt->bindParam(':itm_maincategory', $this->getItm_maincategory(), PDO::PARAM_INT);
            $createstmt->bindParam(':itm_sub1category', $this->getItm_sub1category(), PDO::PARAM_INT);
            $createstmt->bindParam(':itm_sub2category', $this->getItm_sub2category(), PDO::PARAM_INT);
            $createstmt->bindParam(':itm_id', $this->getItm_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate item code.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

}
