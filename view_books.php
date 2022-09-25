<?php include('./header.html') ?>
<div class="card">
    <div class="card-header">Books Data</div>
    <div class="card-body">
        <br>
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>ISBN</th>
                <th>Author</th>
                <th>Title</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

            <?php
            require_once('./db_login.php');
            $query = "select isbn , author , title , price from books order by isbn";
            $result = $db->query($query);
            if (!$result) {
                die('Could not query the database');
            }

            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $row->isbn . '</td>';
                echo '<td>' . $row->author . '</td>';
                echo '<td>' . $row->title . '</td>';
                echo '<td> $' . $row->price . '</td>';
                echo '<td><a class="btn btn-primary btn-sm" href="show_cart.php?id=' . $row->isbn . '">Add To Cart</a>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br>';
            echo 'Total Rows = ' . $result->num_rows;
            $result->free();
            $db->close();

            ?>
        </table>
    </div>
</div>
</body>

</html>