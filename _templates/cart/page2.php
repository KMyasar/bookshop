<h3>Your Cart</h3>
<?php
$pid = filter_input(INPUT_GET, 'pid', FILTER_SANITIZE_NUMBER_INT);
$item = filter_input(INPUT_GET, 'item', FILTER_SANITIZE_NUMBER_INT);
$cart = new cart();
$user = new user(sessions::get("username"));
$uid = $user->id;
$cartid = $cart->isexist($uid);

if (isset($_POST['save_change'])) {
    foreach ($_POST as $key => $value) {
        $key = filter_var($key, ENT_QUOTES,'UTF-8');
        $value = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        if ($value != 0) {
            $cart->setquantity($value, 'cartid', $key);
        } else {
            $cart->zerotodel($key);
        }
    }
}

if ($cartid || $pid) {
    if ($pid) {
        $newadd = md5($uid . $pid);
        $quan = $cart->checkexist($newadd);
        $stock = new stock($pid);
        $price = $stock->getprice('pid', $pid);
        $bookname = $stock->getbookname('pid', $pid);
        if (!$quan) {
            $sql = "INSERT INTO `cart` (`uid`, `pid`, `item`, `quantity`, `price`, `cartid`)
            VALUES (?, ?, ?, 1, ?, ?)";
            try {
                $conn = database::connection();
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iisss", $uid, $pid, $bookname, $price, $newadd);
                $stmt->execute();
            } catch (Exception $e) {
                error_log($e->getMessage(), 3, "/var/log/college-project-errors.log");
            }
        } else {
            $item += $quan;
            $cart->setquantity($item, 'cartid', $newadd);
        }
    }
?>
    <form action="cart.php" method="post">
        <table class="table">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
            <?php
            $cartid = $cart->isexist($uid);
            $sub_total = array();
            $sub_quan = array();
            $array_product = array();
            for ($i = 0; $i < $cart->cart_count; $i++) {
            ?>
                <tr>
                    <?php
                    $name = htmlspecialchars($cart->getitem('cartid', $cartid[$i]), ENT_QUOTES, 'UTF-8');
                    $name_price = htmlspecialchars($cart->getprice('cartid', $cartid[$i]), ENT_QUOTES, 'UTF-8');
                    $name_pid = htmlspecialchars($cart->getpid('cartid', $cartid[$i]), ENT_QUOTES, 'UTF-8');
                    ?>
                    <td><?php echo substr($name, 0, 48) . "..."; ?></td>
                    <td>&#8377;<?php echo $name_price; ?></td>
                    <td><input type="text" value="<?php echo htmlspecialchars($cart->checkexist($cartid[$i]), ENT_QUOTES, 'UTF-8'); ?>" size="2" name="<?php echo htmlspecialchars($cartid[$i], ENT_QUOTES, 'UTF-8'); ?>"></td>
                    <td>&#8377;<?php echo htmlspecialchars($cart->checkexist($cartid[$i]) * $cart->getprice('cartid', $cartid[$i]), ENT_QUOTES, 'UTF-8'); ?></td>
                </tr>
                <?php
                $sub_total[$i] = $cart->checkexist($cartid[$i]) * $cart->getprice('cartid', $cartid[$i]);
                $sub_quan[$i] = $cart->checkexist($cartid[$i]);
                array_push($array_product, array($name_pid, $name, $name_price, $cartid[$i]));
            }
            sessions::set('checklist', $array_product);
            ?>
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th><?php echo array_sum($sub_quan); ?></th>
                <th>&#8377;<?php echo array_sum($sub_total); ?></th>
            </tr>
        </table>
        <input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
    </form>
    <br /><br />
    <a href="checkout.php" class="btn btn-primary">Go To Checkout</a>
    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
<?php
} else {
    echo "<b><p> Empty cart </p></b>";
}
?>