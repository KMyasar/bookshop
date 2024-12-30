<!DOCTYPE html>
<html lang="en">
<?php
sessions::load_templates('head');
?>

<body>
    <?php
    if (sessions::get('is_logged') and sessions::get('session_token')) {
        if (usersession::authorize(sessions::get('session_token'))) {
    ?>
            <script>
                window.location.href = "/college-project/index.php";
            </script>
    <?php
        } else {
            sessions::load_templates(basename(sessions::CurrentScript(), ".php"));
        }
    } else {
        sessions::load_templates(basename(sessions::CurrentScript(), ".php"));
    }
    ?>
    <!-- partial -->
    <script src="js/lib/load.js"></script>
</body>

</html>