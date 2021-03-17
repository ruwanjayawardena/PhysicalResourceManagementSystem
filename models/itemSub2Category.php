<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class ItemSub2Category extends ConnectDB {

    const TBL_ItemSub2Category = 'st_item_sub2category';

    private $flag = false;
    private $s2cat_id;
    private $s2cat_code;
    private $s2cat_name;
    private $s2cat_subcategory;

    public function getFlag() {
        return $this->flag;
    }

    public function getS2cat_id() {
        return $this->s2cat_id;
    }

    public function getS2cat_code() {
        return $this->s2cat_code;
    }

    public function getS2cat_name() {
        return $this->s2cat_name;
    }

    public function getS2cat_subcategory() {
        return $this->s2cat_subcategory;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setS2cat_id($s2cat_id) {
        $this->s2cat_id = $s2cat_id;
    }

    public function setS2cat_code($s2cat_code) {
        $this->s2cat_code = $s2cat_code;
    }

    public function setS2cat_name($s2cat_name) {
        $this->s2cat_name = $s2cat_name;
    }

    public function setS2cat_subcategory($s2cat_subcategory) {
        $this->s2cat_subcategory = $s2cat_subcategory;
    }

    public function getAllItemSub2Category() {
        $data = array();
        $sql = "SELECT
st_item_sub2category.s2cat_id,
st_item_sub2category.s2cat_code,
st_item_sub2category.s2cat_name,
st_item_sub2category.s2cat_subcategory
FROM
st_item_sub2category
WHERE
st_item_sub2category.s2cat_subcategory = :s2cat_subcategory
ORDER BY
st_item_sub2category.s2cat_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':s2cat_subcategory', $this->getS2cat_subcategory(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function cmbItemSub2Category() {
        $data = array();
        $sql = "SELECT
st_item_sub2category.s2cat_id,
st_item_sub2category.s2cat_code,
st_item_sub2category.s2cat_name,
st_item_sub2category.s2cat_subcategory
FROM
st_item_sub2category
WHERE
st_item_sub2category.s2cat_subcategory = :s2cat_subcategory
ORDER BY
st_item_sub2category.s2cat_code ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':s2cat_subcategory', $this->getS2cat_subcategory(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getItemSub2CategoryByID() {
        $data = array();
        $sql = "SELECT
st_item_sub2category.s2cat_id,
st_item_sub2category.s2cat_code,
st_item_sub2category.s2cat_name,
st_item_sub2category.s2cat_subcategory,
st_item_sub1category.scat_maincategory
FROM
st_item_sub2category
INNER JOIN st_item_sub1category ON st_item_sub2category.s2cat_subcategory = st_item_sub1category.scat_id
WHERE
st_item_sub2category.s2cat_id = :s2cat_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':s2cat_id', $this->getS2cat_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveItemSub2Category() {
        $sql = "INSERT INTO `st_item_sub2category` (`s2cat_code`, `s2cat_name`, `s2cat_subcategory`) VALUES (:s2cat_code, :s2cat_name, :s2cat_subcategory);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':s2cat_code', $this->getS2cat_code(), PDO::PARAM_STR);
            $createstmt->bindParam(':s2cat_name', $this->getS2cat_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':s2cat_subcategory', $this->getS2cat_subcategory(), PDO::PARAM_INT);
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

    public function deleteItemSub2Category() {
        $sql = "DELETE FROM `st_item_sub2category` WHERE (`s2cat_id`=:s2cat_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':s2cat_id', $this->getS2cat_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editItemSub2Category() {
        $sql = "UPDATE `st_item_sub2category` SET `s2cat_code`=:s2cat_code, `s2cat_name`=:s2cat_name, `s2cat_subcategory`=:s2cat_subcategory WHERE (`s2cat_id` =:s2cat_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':s2cat_id', $this->getS2cat_id(), PDO::PARAM_INT);
            $createstmt->bindParam(':s2cat_code', $this->getS2cat_code(), PDO::PARAM_STR);
            $createstmt->bindParam(':s2cat_name', $this->getS2cat_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':s2cat_subcategory', $this->getS2cat_subcategory(), PDO::PARAM_INT);
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
