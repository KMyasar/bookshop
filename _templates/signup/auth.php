<?php
$signup = false;
if (isset($_POST['idfirst']) and isset($_POST['idlast']) and isset($_POST['idemail'])and isset($_POST['idpass'])) {
    $first = $_POST['idfirst'];
    $last = $_POST['idlast'];
    $email = $_POST['idemail'];
    $password = $_POST['idpass'];
    $error = user::signup($first, $last, $email, $password);
    if ($error != true) {
        die("\nconfiguration error happened please check it.");
    } else
        $signup = true;
}
?>

<?php
if ($signup) {
    if ($error) {
        // sessions::load_templates('index');
        ?>
        <script>window.location.href="/college-project/index.php";</script>
        <?php
    }
} else
    sessions::load_templates('signup/page');
