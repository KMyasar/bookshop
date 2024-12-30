<?php

$login = false;
if (isset($_POST['idemail']) and isset($_POST['idpass'])) {
    $email = htmlentities($_POST['idemail']);
    $pass = htmlentities($_POST['idpass']);
    $token = usersession::authenticate($email, $pass);
    $login = true;
}
if ($login) {
    if ($token) {
        $user = new usersession(sessions::get('session_token'));
        sessions::set("is_logged", true);
        sessions::set("username", $user->getUser());
        ?>
        <script>
            window.location.href = "/college-project/index.php";
        </script>
        <?php
        // sessions::load_templates("index");
    }
    else
        echo "invalid credits";
} else {
    sessions::load_templates('login/page');
}
