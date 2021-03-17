<input type="hidden" id="usr_id" value="<?php
if (isset($_SESSION) && !empty($_SESSION['usr_id'])) {
    echo $_SESSION['usr_id'];
}
?>">
<input type="hidden" id="usr_name" value="<?php
if (isset($_SESSION) && !empty($_SESSION['usr_name'])) {
    echo $_SESSION['usr_name'];
}
?>">
<input type="hidden" id="usr_username" value="<?php
if (isset($_SESSION) && !empty($_SESSION['usr_username'])) {
    echo $_SESSION['usr_username'];
}
?>">
<input type="hidden" id="usr_usercategory" value="<?php
if (isset($_SESSION) && !empty($_SESSION['usr_usercategory'])) {
    echo $_SESSION['usr_usercategory'];
}
?>">
<input type="hidden" id="inst_division" value="<?php
if (isset($_SESSION) && !empty($_SESSION['inst_division'])) {
    echo $_SESSION['inst_division'];
}
?>">
<input type="hidden" id="inst_zonal" value="<?php
if (isset($_SESSION) && !empty($_SESSION['inst_zonal'])) {
    echo $_SESSION['inst_zonal'];
}
?>">
<input type="hidden" id="inst_province" value="<?php
if (isset($_SESSION) && !empty($_SESSION['inst_province'])) {
    echo $_SESSION['inst_province'];
}
?>">
<input type="hidden" id="inst_institutetype" value="<?php
if (isset($_SESSION) && !empty($_SESSION['inst_institutetype'])) {
    echo $_SESSION['inst_institutetype'];
}
?>">
<input type="hidden" id="inst_selection_key" value="<?php
if (isset($_SESSION) && !empty($_SESSION['inst_selection_key'])) {
    echo $_SESSION['inst_selection_key'];
}
?>">
<input type="hidden" id="usrcat_institute" value="<?php
if (isset($_SESSION) && !empty($_SESSION['usrcat_institute'])) {
    echo $_SESSION['usrcat_institute'];
}
?>">
<input type="hidden" id="usr_is_superadmin" value="<?php
       if (isset($_SESSION) && !empty($_SESSION['usr_is_superadmin'])) {
           echo $_SESSION['usr_is_superadmin'];
       }
       ?>">

