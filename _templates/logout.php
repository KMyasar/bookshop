<?php
include_once 'lib/load.php';
if (sessions::get('is_logged') and sessions::get('session_token')) {
    $user = new usersession(sessions::get('session_token'));
    $user->removeSession();
    sessions::destory();
?>
    <script>
        window.location.href="/college-project/login.php";
    </script>
<?php
}
?>
