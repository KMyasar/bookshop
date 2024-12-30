<?php
include_once '/opt/lampp/htdocs/college-project/lib/load.php';
if (sessions::get("is_logged") and sessions::get("session_token")) {
    if (usersession::authorize(sessions::get("session_token"))) {
        $details = [$_POST['idphone'], $_POST['idbio'], $_POST['idprofession'], $_POST['iddob'], $_POST['idcity'], $_POST['idcountry']];
        $uid = $_POST['uid'];
        $sql = "UPDATE `user` SET `phone`='$details[0]',`bio`='$details[1]',`profession`='$details[2]',`dob`='$details[3]',`state`='$details[4]',`country`='$details[5]' WHERE `uid`='$uid'";
        print($sql);
        $conn = database::connection();

        try {
            $conn->query($sql);
            sessions::load_script("account");
        } catch (Exception $e) {
            echo $e->getMessage() . "update error happened in change.php";
            sessions::load_script("account");
        }
    }
} else {
    sessions::load_templates('logout');
}
