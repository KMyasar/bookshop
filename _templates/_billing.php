<!DOCTYPE html>
<html lang="en">
<?php
sessions::load_templates('head');
?>

<body>
    <?php
    $value = true;
    if (sessions::get('is_logged') and sessions::get('session_token')) {
        if (usersession::authorize(sessions::get('session_token'))) {
            $value = false;
            sessions::load_templates('checkout');
        }
    }
    if ($value) {
        sessions::load_script('login');
    }
    ?>
    <!-- partial -->
    <script src="js/lib/load.js"></script>
    <script>
        loadScript('js/checkout.js');
        loadScript('js/bootstrap.bundle.min.js');
    </script>
</body>

</html>