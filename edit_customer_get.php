<?php

use LDAP\Result;

require_once("./db_login.php");
$name = $db->real_escape_string($_GET['name']);
$address = $db->real_escape_string($_GET['address']);
$city = $db->real_escape_string($_GET['city']);
$id = $db->real_escape_string($_GET['id']);

$query = "update customers set name='" . $name . "', address= '" . $address . "',city= '" . $city . "' where customerid='" . $id . "' ";
$result = $db->query($query);
if (!$result) {
    echo '<p>query gagal</p>';
} else {
    echo '
    <div class="data-val">
    <h2>Data Berhasil di Edit</h2><br>
    <p>Name : ' . $name . ' </p>
    <p>Address : ' . $address . ' </p>
    <p>City : ' . $city . ' </p>
    <a href="view_customer.php" class="btn btn-primary">View Customer</a>
</div>';
}
