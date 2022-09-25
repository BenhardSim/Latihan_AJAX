<?php

session_start();
require_once('./db_login.php');
// echo $_SESSION['username'];
if (isset($_POST['submit'])) {
    $valid = true;

    // cek email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = '<p><b>email is required</b></p>';
        $valid = false;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = '<p><b>invalid email format</b></p>';
        $valid = false;
    }

    // cek password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = '<p><b>Password is required</b></p>';
        $valid = false;
    }

    // cek validasi
    if ($valid) {
        $query = "SELECT * FROM admin where email='" . $email . "' AND password='" . md5($password) . "' ";
        $result = $db->query($query);
        if (!$result) {
            die("could not query the databse");
        } else {
            if ($result->num_rows > 0) {
                $_SESSION['username'] = $email;
                header('Location: view_customer.php');
                exit;
            } else {
                echo '<span class="error">Combination of username and password are not correct.</span>';
            }
        }
        $db->close();
    }
}
?>

<?php include('./header.html') ?>
<br>
<div class="card">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" size="30" value="<?php if (isset($email)) echo $email; ?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" size="30" value="<?php if (isset($password)) echo $password; ?>">
                <div class="error"><?php if (isset($error_password)) echo $error_password ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>

    </div>
</div>
<?php include('./footer.html') ?>