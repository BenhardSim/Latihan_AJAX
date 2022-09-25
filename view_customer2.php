<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
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
            $query = "select customerid as ID, name as Nama, address as Alamat, city as Kota from customers order by customerid";
            $result = $db->query($query);
            if(!$result){
                die('Could not query the database');
            }

            $i = 1;
            while($row = $result->fetch_object()){
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row->Nama.'</td>';
                echo '<td>'.$row->Alamat.'</td>';
                echo '<td>'.$row->Kota.'</td>';
                echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id='.$row->ID.'">Edit</a>
                <a class="btn btn-danger btn-sm" href="confirm_delete_customer.php?id'.$row->ID.'">Delete</a></td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br>';
            echo 'Total Rows = '.$result->num_rows;
            $result->free();
            $db->close();
        
        ?>
        </table>
    </div>
</div>
</body>
</html>