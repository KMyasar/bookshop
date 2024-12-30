<h3>Your Cart</h3>
<?php
$pid = $_GET['pid'];
$item = $_GET['item'];
$cart = new cart();
$user = new user(sessions::get("username"));
$uid = $user->id;
$cartid = $cart->isexist($uid);
if ($_POST['save_change']) {
    foreach ($_POST as $key => $value) {
        if ($value != 0) {
            $cart->setquantity("$value", 'cartid', "$key");
        } else {
            $cart->zerotodel("$key");
        }
    }
}
if ($cartid or $pid) {
    if ($pid) {
        $newadd = md5($uid . $pid);
        $quan = $cart->checkexist($newadd);
        $stock = new stock($pid);
        $price = $stock->getprice('pid', $pid);
        $bookname = $stock->getbookname('pid', $pid);
        if (!$quan) {
            $sql = "INSERT INTO `cart` (`uid`, `pid`, `item`, `quantity`, `price`, `cartid`)
            VALUES ('$uid', '$pid', '$bookname', '1', '$price', '$newadd');";
            try {
                $conn = database::connection();
                $conn->query($sql);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            $item = $item + $quan;
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
                    $name = $cart->getitem('cartid', $cartid[$i]);
                    $name_price = $cart->getprice('cartid', $cartid[$i]);
                    $name_pid = $cart->getpid('cartid', $cartid[$i]);
                    ?>
                    <td><?php echo substr($name, 0, 48) . "..."; ?>
                    </td>
                    <td>&#8377;<?php echo $name_price; ?>
                    </td>
                    <td><input type="text" value="<?php echo $cart->checkexist($cartid[$i]); ?>" size="2" name="<?php echo $cartid[$i]; ?>"></td>
                    <td>&#8377;<?php echo $cart->checkexist($cartid[$i]) * $cart->getprice('cartid', $cartid[$i]); ?>
                    </td>
                </tr><?php
                        $sub_total[$i] = $cart->checkexist($cartid[$i]) * $cart->getprice('cartid', $cartid[$i]);
                        $sub_quan[$i] = $cart->checkexist($cartid[$i]);
                        array_push($array_product, array($name_pid,$name, $name_price, $cartid[$i]));
                    }
                    sessions::set('checklist', $array_product);
                        ?>
            <tr>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th><?php
                    echo array_sum($sub_quan);
                    ?></th>
                <th>&#8377;<?php echo array_sum($sub_total);
                    ?></th>
            </tr>
        </table>
        <input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
    </form>
    <br /><br />
    <a href="checkout.php" class="btn btn-primary">Go To Checkout</a>
    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
<?php
} else {
    print("<b><p> Empty cart </p></b>");
}
?>