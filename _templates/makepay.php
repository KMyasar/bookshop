<?php
include_once '/opt/lampp/htdocs/college-project/lib/load.php';
if (isset($_POST)) {
    $history = new history();
    $user = new user(sessions::get('username'));
    
    for ($i = 0; $i < count($_SESSION['checklist']); $i++) {
        $array = array();
        $transaction = md5($user->id.date("Y-m-d"));
        foreach ($_SESSION['checklist'][$i] as $key => $value) {
           array_push($array, $value);
        }
        foreach ($_POST as $key => $value) {
            array_push($array, $value);
        }
        array_push($array,$transaction);
        if ($history->makehistory($array,$user->id)) {
            $cart = new cart();
            if ($cart->clearcart($user->id)) {
                sessions::load_script('index');
            }
            else
            {
                echo "Oops something happened";
                // sleep(3);
                // sessions::load_script('index');
            }
        }
        else
        {
            echo "Invalid credentials contact admin";
            // sleep(3);
            // sessions::load_script('index');
        }
        unset($array);
    }
} else {
    echo "error..." . __LINE__;
}
