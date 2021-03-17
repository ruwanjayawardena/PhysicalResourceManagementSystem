<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class Attribute extends ConnectDB {

    const TBL_Attribute = 'st_item_attribute';

    private $flag = false;
    private $at_id;
    private $at_name;
    private $at_price;
    private $at_attributetype;

    public function getFlag() {
        return $this->flag;
    }

    public function getAt_id() {
        return $this->at_id;
    }

    public function getAt_name() {
        return $this->at_name;
    }

    public function getAt_price() {
        return $this->at_price;
    }

    public function getAt_attributetype() {
        return $this->at_attributetype;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setAt_id($at_id) {
        $this->at_id = $at_id;
    }

    public function setAt_name($at_name) {
        $this->at_name = $at_name;
    }

    public function setAt_price($at_price) {
        $this->at_price = $at_price;
    }

    public function setAt_attributetype($at_attributetype) {
        $this->at_attributetype = $at_attributetype;
    }

    public function getAllAttribute() {
        $data = array();
        $sql = "SELECT
st_item_attribute.at_id,
st_item_attribute.at_name,
st_item_attribute.at_price,
st_item_attribute.at_attributetype
FROM
st_item_attribute
WHERE
st_item_attribute.at_attributetype = :at_attributetype
ORDER BY
st_item_attribute.at_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':at_attributetype', $this->getAt_attributetype(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function cmbAttribute() {
        $data = array();
        $sql = "SELECT
st_item_attribute.at_id,
st_item_attribute.at_name,
st_item_attribute.at_price,
st_item_attribute.at_attributetype
FROM
st_item_attribute
WHERE
st_item_attribute.at_attributetype = :at_attributetype
ORDER BY
st_item_attribute.at_name ASC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':at_attributetype', $this->getAt_attributetype(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getAttributeByID() {
        $data = array();
        $sql = "SELECT
st_item_attribute.at_id,
st_item_attribute.at_name,
st_item_attribute.at_price,
st_item_attribute.at_attributetype
FROM
st_item_attribute
WHERE
st_item_attribute.at_id = :at_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':at_id', $this->getAt_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveAttribute() {
        $sql = "INSERT INTO `st_item_attribute` (`at_name`, `at_price`, `at_attributetype`) VALUES (:at_name, :at_price, :at_attributetype);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':at_name', $this->getAt_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':at_price', $this->getAt_price(), PDO::PARAM_STR);
            $createstmt->bindParam(':at_attributetype', $this->getAt_attributetype(), PDO::PARAM_INT);
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

    public function deleteAttribute() {
        $sql = "DELETE FROM `st_item_attribute` WHERE (`at_id`=:at_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':at_id', $this->getAt_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editAttribute() {
        $sql = "UPDATE `st_item_attribute` SET `at_name`=:at_name, `at_price`=:at_price, `at_attributetype`=:at_attributetype WHERE (`at_id` = :at_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':at_name', $this->getAt_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':at_price', $this->getAt_price(), PDO::PARAM_STR);
            $createstmt->bindParam(':at_attributetype', $this->getAt_attributetype(), PDO::PARAM_INT);
            $createstmt->bindParam(':at_id', $this->getAt_id(), PDO::PARAM_INT);
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
