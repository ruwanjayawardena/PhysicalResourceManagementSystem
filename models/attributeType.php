<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class AttributeType extends ConnectDB {

    const TBL_AttributeType = 'st_item_attributetype';

    private $flag = false;
    private $attype_id;
    private $attype_name;
    private $attype_item;

    public function getFlag() {
        return $this->flag;
    }

    public function getAttype_id() {
        return $this->attype_id;
    }

    public function getAttype_name() {
        return $this->attype_name;
    }

    public function getAttype_item() {
        return $this->attype_item;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setAttype_id($attype_id) {
        $this->attype_id = $attype_id;
    }

    public function setAttype_name($attype_name) {
        $this->attype_name = $attype_name;
    }

    public function setAttype_item($attype_item) {
        $this->attype_item = $attype_item;
    }

    public function getAllAttributeType() {
        $data = array();
        $sql = "SELECT
st_item_attributetype.attype_id,
st_item_attributetype.attype_name,
st_item_attributetype.attype_item
FROM
st_item_attributetype
WHERE
st_item_attributetype.attype_item = :attype_item
ORDER BY
st_item_attributetype.attype_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':attype_item', $this->getAttype_item(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function cmbAttributeType() {
        $data = array();
        $sql = "SELECT
st_item_attributetype.attype_id,
st_item_attributetype.attype_name,
st_item_attributetype.attype_item
FROM
st_item_attributetype
WHERE
st_item_attributetype.attype_item = :attype_item
ORDER BY
st_item_attributetype.attype_name ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':attype_item', $this->getAttype_item(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getAttributeTypeByID() {
        $data = array();
        $sql = "SELECT
st_item_attributetype.attype_id,
st_item_attributetype.attype_name,
st_item_attributetype.attype_item
FROM
st_item_attributetype
WHERE
st_item_attributetype.attype_id = :attype_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':attype_id', $this->getAttype_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveAttributeType() {
        $sql = "INSERT INTO `st_item_attributetype` (`attype_name`, `attype_item`) VALUES (:attype_name, :attype_item);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':attype_name', $this->getAttype_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':attype_item', $this->getAttype_item(), PDO::PARAM_STR);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate attribute name.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteAttributeType() {
        $sql = "DELETE FROM `st_item_attributetype` WHERE (`attype_id`=:attype_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':attype_id', $this->getAttype_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editAttributeType() {
        $sql = "UPDATE `st_item_attributetype` SET `attype_name`=:attype_name, `attype_item`=:attype_item WHERE (`attype_id` = :attype_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':attype_name', $this->getAttype_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':attype_item', $this->getAttype_item(), PDO::PARAM_STR);
            $createstmt->bindParam(':attype_id', $this->getAttype_id(), PDO::PARAM_INT);
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

}
