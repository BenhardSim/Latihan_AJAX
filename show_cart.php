<?php

session_start();
$id = $_GET['id'];
if ($id != '') {
    // kalau session cart belum ada
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // kalau session cart dengan isbn blm ada
    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        // kalau session cart dengan isbn sudah ada
        $_SESSION['cart'][$id] += 1;
    }
}

?>

<?php include('./header.html') ?>
<br>
<div class="card">
    <div class="card-header">Shoping Cart</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Price * Qty</th>
            </tr>

            <?php
            require_once('./db_login.php');
            $sum_qty = 0;
            $sum_price = 0;
            if (is_array($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $query = "SELECT * FROM books where isbn='" . $id . "' ";
                    $result = $db->query($query);
                    if (!$result) {
                        die('Could not query the database');
                    }
                    while ($row = $result->fetch_object()) {
                        echo '<tr>';
                        echo '<td>' . $row->isbn . '</td>';
                        echo '<td>' . $row->author . '</td>';
                        echo '<td>' . $row->title . '</td>';
                        echo '<td> $' . $row->price . '</td>';
                        echo '<td>' . $qty . '</td>';
                        echo '<td> $' . ($row->price * $qty) . '</td>';
                        $sum_qty += $qty;
                        $sum_price += ($row->price * $qty);
                    }
                }
                echo '<tr><td></td><td></td><td></td><td></td><td>' . $sum_qty . '</td><td> $' . $sum_price . '</td></tr>';
                $result->free();
                $db->close();
            } else {
                echo '<tr><td colspan="6" align="center">There is no item in shopping cart</td></tr>';
            }
            ?>
        </table>
        Total items = <?php echo $sum_qty; ?><br><br>
        <a href="view_books.php" class="btn btn-primary">Continue Shopping</a>
        <a href="delete_cart.php" class="btn btn-danger">Empty Cart</a><br><br>
    </div>
</div>
<?php include('./footer.html') ?>