<?php

require_once('./db_login.php');
$id = $_GET['id'];


if (!isset($_POST['submit'])) {
    // apabil blm di submit maka nilai akan diisi sesuai dengan apa yang ada di database
    $query = 'select * from customers where customerid=' . $id;
    $result = $db->query($query);
    if (!$result) {
        dir('Could not query the database');
    } else {
        while ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }
} else {
    // validasi dari nilai yang dimasukkan ke form
    $name = test_input($_POST['name']);
    $address = test_input($_POST['address']);
    $city = $_POST['city'];

    $query = " DELETE FROM customers WHERE customerid='" . $id . "' ";
    $result = $db->query($query);
    if (!$result) {
        die("could not query the databse");
    } else {
        $db->close();
        header("Location: view_customer.php");
    }
}
?>
<?php include('./header.html') ?>
<br>
<div class="card">
    <div class="card-header">Delete Customers Data</div>
    <div class="card-body">
        <!-- action berguna untuk memindah page sesuai URL action pada saat tombol submit di tekan -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id; ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Nama : <?php echo $name ?></label>
            </div>

            <div class="form-group">
                <label for="address">Address : <?php echo $address ?></label>
            </div>

            <div class="form-group">
                <label for="city">City : <?php echo $city ?></label>
            </div>
            <br>
            <button class="btn btn-danger" name="submit" value="submit" type="submit">Delete</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
<?php
$db->close();
?>
<?php include('./footer.html') ?>