<?php
$signup = false;
if (isset($_POST['idfirst']) and isset($_POST['idlast']) and isset($_POST['idemail'])and isset($_POST['idpass'])) {
    $first = htmlentities($_POST['idfirst']);
    $last = htmlentities($_POST['idlast']);
    $email = htmlentities($_POST['idemail']);
    $password = htmlentities($_POST['idpass']);
    $error = user::signup($first, $last, filter_var($email,FILTER_VALIDATE_EMAIL), $password);
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
