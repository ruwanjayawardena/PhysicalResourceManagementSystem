<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../dbconfig/connectDB.php';

/**
 * @author Ruwan Jayawardena
 */
class User extends ConnectDB {

    const TBL_User = 'df_user';

    private $flag = false;
    private $usr_id;
    private $usr_name;
    private $usr_username;
    private $usr_password;
    private $usr_email;
    private $usr_phone;
    private $usr_nic;
    private $usr_designation;
    private $usr_status;
    private $usr_is_superadmin;
    private $usr_usercategory;
    private $usr_create_date;
    private $usr_create_time;

    public function getFlag() {
        return $this->flag;
    }

    public function getUsr_id() {
        return $this->usr_id;
    }

    public function getUsr_name() {
        return $this->usr_name;
    }

    public function getUsr_username() {
        return $this->usr_username;
    }

    public function getUsr_password() {
        return $this->usr_password;
    }

    public function getUsr_email() {
        return $this->usr_email;
    }

    public function getUsr_phone() {
        return $this->usr_phone;
    }

    public function getUsr_nic() {
        return $this->usr_nic;
    }

    public function getUsr_designation() {
        return $this->usr_designation;
    }

    public function getUsr_status() {
        return $this->usr_status;
    }

    public function getUsr_is_superadmin() {
        return $this->usr_is_superadmin;
    }

    public function getUsr_usercategory() {
        return $this->usr_usercategory;
    }

    public function getUsr_create_date() {
        return $this->usr_create_date;
    }

    public function getUsr_create_time() {
        return $this->usr_create_time;
    }

    public function setFlag($flag) {
        $this->flag = $flag;
    }

    public function setUsr_id($usr_id) {
        $this->usr_id = $usr_id;
    }

    public function setUsr_name($usr_name) {
        $this->usr_name = $usr_name;
    }

    public function setUsr_username($usr_username) {
        $this->usr_username = strtolower(preg_replace('/\s/', '', $usr_username));
    }

    public function setUsr_password($usr_password) {
        $salt = 'ruwanj510*';
        $hashed = hash('sha256', $usr_password . $salt);
        $this->usr_password = $hashed;
    }

    public function setUsr_email($usr_email) {
        $this->usr_email = $usr_email;
    }

    public function setUsr_phone($usr_phone) {
        $this->usr_phone = $usr_phone;
    }

    public function setUsr_nic($usr_nic) {
        $this->usr_nic = $usr_nic;
    }

    public function setUsr_designation($usr_designation) {
        $this->usr_designation = $usr_designation;
    }

    public function setUsr_status($usr_status) {
        $this->usr_status = $usr_status;
    }

    public function setUsr_is_superadmin($usr_is_superadmin) {
        $this->usr_is_superadmin = $usr_is_superadmin;
    }

    public function setUsr_usercategory($usr_usercategory) {
        $this->usr_usercategory = $usr_usercategory;
    }

    public function setUsr_create_date($usr_create_date) {
        $this->usr_create_date = $usr_create_date;
    }

    public function setUsr_create_time($usr_create_time) {
        $this->usr_create_time = $usr_create_time;
    }

    public function getNextAutoIncrementID($table) {
        $nextid = 0;
        $sql = "SHOW TABLE STATUS LIKE '" . $table . "'";
        $readstmt = $this->con->prepare($sql);
        $readstmt->execute();
        while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
            $nextid = $row->Auto_increment;
        }
        return $nextid;
    }

    public function getRandomConfirmationCode() {
        $this->usr_confirm_code = rand(10000, 99999);
        return $this->usr_confirm_code;
    }

    public function logout() {
        if (isset($_SESSION) && !empty($_SESSION)) {
            unset($_SESSION['usr_id']);
            unset($_SESSION['usr_name']);
            unset($_SESSION['usr_username']);
            unset($_SESSION['usr_usercategory']);
            unset($_SESSION['inst_division']);
            unset($_SESSION['inst_zonal']);
            unset($_SESSION['inst_province']);
            unset($_SESSION['inst_institutetype']);
            unset($_SESSION['inst_selection_key']);
            unset($_SESSION['usrcat_institute']);
            unset($_SESSION['usr_is_superadmin']);
            if (!isset($_SESSION['usr_id'])) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully Logout"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry ! Logout Failed"));
            }
        }
    }

    public function login() {
        try {
            $readstmt = $this->con->prepare("SELECT
st_institute.inst_division,
st_institute.inst_zonal,
st_institute.inst_province,
st_institute.inst_institutetype,
st_institute.inst_selection_key,
df_usercategory.usrcat_institute,
df_user.usr_id,
df_user.usr_name,
df_user.usr_username,
df_user.usr_usercategory,
df_user.usr_password,
df_user.usr_is_superadmin
FROM
df_user
INNER JOIN df_usercategory ON df_user.usr_usercategory = df_usercategory.usrcat_id
INNER JOIN st_institute ON df_usercategory.usrcat_institute = st_institute.inst_id
WHERE
df_user.usr_username = :usr_username AND
df_user.usr_status = 1");
            $readstmt->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_OBJ)) {
                if ($this->getUsr_password() == $row->usr_password) {
                    $_SESSION['usr_id'] = $row->usr_id;
                    $_SESSION['usr_name'] = $row->usr_name;
                    $_SESSION['usr_username'] = $row->usr_username;
                    $_SESSION['usr_usercategory'] = $row->usr_usercategory;
                    $_SESSION['inst_division'] = $row->inst_division;
                    $_SESSION['inst_zonal'] = $row->inst_zonal;
                    $_SESSION['inst_province'] = $row->inst_province;
                    $_SESSION['inst_institutetype'] = $row->inst_institutetype;
                    $_SESSION['inst_selection_key'] = $row->inst_selection_key;
                    $_SESSION['usrcat_institute'] = $row->usrcat_institute;
                    $_SESSION['usr_is_superadmin'] = $row->usr_is_superadmin;
                    $this->setUsr_is_superadmin($row->usr_is_superadmin);
                    $this->setFlag(true);
                }
            }
            if ($this->getFlag()) {
                echo json_encode(array("msgType" => 1, "msg" => "Welcome, Login Successfull!", "usr_is_superadmin" => $this->getUsr_is_superadmin()));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Inavalid login ! Please check your username/password"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function getAllUser() {
        $data = array();
        $sql = "SELECT
df_user.usr_id,
df_user.usr_name,
df_user.usr_username,
df_user.usr_password,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_nic,
df_user.usr_designation,
df_user.usr_status,
df_user.usr_is_superadmin,
df_user.usr_usercategory,
df_user.usr_create_date,
df_user.usr_create_time
FROM
df_user
WHERE
df_user.usr_usercategory = :usr_usercategory AND
df_user.usr_is_superadmin <> 1
ORDER BY
df_user.usr_id DESC";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':usr_usercategory', $this->getUsr_usercategory(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function getUserByID() {
        $data = array();
        $sql = "SELECT
df_user.usr_id,
df_user.usr_name,
df_user.usr_username,
df_user.usr_password,
df_user.usr_email,
df_user.usr_phone,
df_user.usr_nic,
df_user.usr_designation,
df_user.usr_status,
df_user.usr_is_superadmin,
df_user.usr_usercategory,
df_user.usr_create_date,
df_user.usr_create_time
FROM
df_user
WHERE
df_user.usr_id = :usr_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }
    
    public function loggedUsersInfo() {
        $data = array();
        $sql = "SELECT
df_user.usr_id,
df_usercategory.usrcat_name,
st_institute.inst_name,
st_institute_type.insttype_name,
st_division.div_name,
st_zonal.zol_name,
st_province.prov_name,
df_user.usr_username,
df_user.usr_name,
df_user.usr_designation,
df_user.usr_nic,
df_user.usr_phone,
df_user.usr_email,
st_institute.inst_selection_key,
df_usercategory.usrcat_id,
st_institute.inst_id,
st_institute_type.insttype_id,
st_division.div_id,
st_zonal.zol_id,
st_province.prov_id
FROM
df_user
INNER JOIN df_usercategory ON df_user.usr_usercategory = df_usercategory.usrcat_id
INNER JOIN st_institute ON df_usercategory.usrcat_institute = st_institute.inst_id
INNER JOIN st_institute_type ON st_institute.inst_institutetype = st_institute_type.insttype_id
INNER JOIN st_division ON st_institute.inst_division = st_division.div_id
INNER JOIN st_zonal ON st_institute.inst_zonal = st_zonal.zol_id AND st_division.div_zone = st_zonal.zol_id
INNER JOIN st_province ON st_institute.inst_province = st_province.prov_id AND st_zonal.zol_province = st_province.prov_id
WHERE
df_user.usr_id = :usr_id";
        try {
            $readstmt = $this->con->prepare($sql);
            $readstmt->bindParam(':usr_id', $_SESSION['usr_id'], PDO::PARAM_INT);
            $readstmt->execute();
            while ($row = $readstmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            echo json_encode($data);
        } catch (Exception $exc) {
            echo json_encode($data);
        }
    }

    public function saveUser() {
        $sql = "INSERT INTO `df_user` (`usr_name`, `usr_username`, `usr_password`, `usr_email`, `usr_phone`, `usr_nic`, `usr_designation`, `usr_usercategory`, `usr_create_date`, `usr_create_time`) VALUES (:usr_name, :usr_username, :usr_password, :usr_email, :usr_phone, :usr_nic, :usr_designation, :usr_usercategory, :usr_create_date, :usr_create_time);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':usr_name', $this->getUsr_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_password', $this->getUsr_password(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_nic', $this->getUsr_nic(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_designation', $this->getUsr_designation(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_usercategory', $this->getUsr_usercategory(), PDO::PARAM_INT);
            $createstmt->bindParam(':usr_create_date', date("Y-m-d"), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_create_time', date("H:i:s"), PDO::PARAM_STR);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully saved"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! saving failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate username.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

    public function deleteUser() {
        $sql = "DELETE FROM `df_user` WHERE (`usr_id`=:usr_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully deleted"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! deleting failed"));
            }
        } catch (Exception $exc) {
            echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
        }
    }

    public function editUser() {
        $sql = "UPDATE `df_user` SET `usr_name`=:usr_name, `usr_username`=:usr_username, `usr_email`=:usr_email, `usr_phone`=:usr_phone, `usr_nic`=:usr_nic, `usr_designation`=:usr_designation, `usr_usercategory`=:usr_usercategory  WHERE (`usr_id` = :usr_id);";
        try {
            $createstmt = $this->con->prepare($sql);
            $createstmt->bindParam(':usr_name', $this->getUsr_name(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_username', $this->getUsr_username(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_email', $this->getUsr_email(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_phone', $this->getUsr_phone(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_nic', $this->getUsr_nic(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_designation', $this->getUsr_designation(), PDO::PARAM_STR);
            $createstmt->bindParam(':usr_usercategory', $this->getUsr_usercategory(), PDO::PARAM_INT);
            $createstmt->bindParam(':usr_id', $this->getUsr_id(), PDO::PARAM_INT);
            if ($createstmt->execute()) {
                echo json_encode(array("msgType" => 1, "msg" => "Successfully updated"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => "Sorry! updating failed"));
            }
        } catch (Exception $exc) {
            if ($exc->getCode() == 23000) {
                echo json_encode(array("msgType" => 2, "msg" => "You are entered duplicate username.Please check and change it"));
            } else {
                echo json_encode(array("msgType" => 2, "msg" => $exc->getMessage()));
            }
        }
    }

}
