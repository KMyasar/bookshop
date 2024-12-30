<?php
include_once 'lib/load.php';
if (usersession::authorize(sessions::get('session_token'))) {
    sessions::Render_page();
}
else
    sessions::load_script('login');
?>