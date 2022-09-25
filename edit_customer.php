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
    $valid = true;
    $name = test_input($_POST['name']);
    if ($name == '') {
        $error_name = '<p><b>Name is required</b></p>';
        $valid = false;
    } elseif (!preg_match('/^[a-zA-Z\s]*$/', $name)) {
        $error_name = '<p><b>Only letters and white space allowed</b></p>';
        $valid = false;
    }

    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = '<p><b>Address is required</b></p>';
        $valid = false;
    }

    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = '<p><b>City is required</b></p>';
        $valid = false;
    }

    // update info
    if ($valid) {
        $query = "update customers set name='" . $name . "', address= '" . $address . "',city= '" . $city . "' where customerid=" . $id ." ";
        $result = $db->query($query);
        if (!$result) {
            die("could not query the databse");
        } else {
            $db->close();
            header("Location: view_customer.php");
        }
    }
}
?>
<?php include('./header.html') ?>
<br>
<div class="card">
    <div class="card-header">Edit Customers Data</div>
    <div class="card-body">
        <!-- action berguna untuk memindah page sesuai URL action pada saat tombol submit di tekan -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id; ?>" method="POST" autocomplete="on" >
            <div class="form-group">
                <label for="name">Nama : </label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>

            <div class="form-group">
                <label for="address">Address : </label>
                <textarea rows="5" class="form-control" id="address" name="address"><?php echo $address ?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>

            <div class="form-group">
                <label for="city">City : </label>
                <select class="form-control" name="city" id="city">
                    <option value="none" <?php if (!isset($city)) echo 'selected="true"' ?>>-- Select a City --</option>
                    <option value="Airport West" <?php if (isset($city) && $city == 'Airport West') echo 'selected="true"' ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == 'Box Hill') echo 'selected="true"' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (!isset($city) && $city == 'Yarraville') echo 'selected="true"' ?>>Yarraville</option>
                </select>

                <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
            </div>
            <br>
            <button class="btn btn-primary" name="submit" value="submit" type="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>
<?php
$db->close();
?>
<?php include('./footer.html') ?>