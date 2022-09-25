<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

?>

<?php include('./header.html') ?>
<div class="card">
    <div class="card-header">Customers Data</div>
    <div class="card-body">
        <br>
        <a href="add_customer.php" class="btn btn-primary">+ Add Customer Data</a>
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>

            <?php
            require_once('./db_login.php');
            $query = "select customerid , name , address , city from customers order by customerid";
            $result = $db->query($query);
            if (!$result) {
                die('Could not query the database');
            }

            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $row->name . '</td>';
                echo '<td>' . $row->address . '</td>';
                echo '<td>' . $row->city . '</td>';
                echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id=' . $row->customerid . '">Edit</a>
                <a class="btn btn-danger btn-sm" href="delete_customer.php?id=' . $row->customerid . '">Delete</a></td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br>';
            echo 'Total Rows = ' . $result->num_rows;
            $result->free();
            $db->close();

            ?>
            <br>
            <a class="btn btn-danger btn-sm" href="admin.php">Log Out</a>
        </table>
    </div>
</div>
</body>

</html>