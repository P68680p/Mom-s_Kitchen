<?php
require_once '../server/assert_logged_out.php';

require_once '../server/dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $password_check = filter_input(INPUT_POST, 'password_check', FILTER_DEFAULT);
    $pwd_hash = password_hash($password, PASSWORD_DEFAULT);
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_DEFAULT);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_DEFAULT);

    if (empty($username) || strlen($username) > 30) {
        $signup_error = 'Username must be between 1 and 30 characters';
    } elseif ($password !== $password_check) {
        $signup_error = 'Passwords do not match!';
    } else {
        $db = db_connect();
        $sql = "SELECT username FROM users WHERE username = '{$username}'";
        $result_set = mysqli_query($db, $sql);

        if (!$result_set) {
            $signup_error = 'Something went wrong!';
        } else {
            $username_taken = mysqli_num_rows($result_set) > 0;
            if (!$username_taken) {
                // Insert user into the database
                $insert_sql = "INSERT INTO users (username, pwd_hash, first_name, last_name, email) 
                                VALUES ('$username', '$pwd_hash', '$firstname', '$lastname', '$email');";
                mysqli_query($db, $insert_sql);
    
                if (mysqli_errno($db)) {
                    $signup_error = mysqli_error($db);
                } else {
                    // Redirect to login page
                    header("Location: ../index.php");
                    exit();
                }
            } else {
                $signup_error = "Username {$username} is already taken!";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "../includes/css_import.php" ?>
    <title>Mom's Kitchen</title>
    <script src="../js/signup-validation.js" defer></script>
</head>
<body>
    <?php require_once '../includes/header.inc.php' ?>

    <main class="signup">
        <h2>Sign Up</h2>
        <form class="pink-box" name="signup" action="signup.php" method="post" onsubmit="return validate();">
            <section id="user-info">
                <fieldset>
                    <label>First Name</label>
                    <input id="firstname" type="text" name="firstname">
                    <p class="error-message"></p>
                </fieldset>
                <fieldset>
                    <label>Last Name</label>
                    <input id="lastname" type="text" name="lastname">
                    <p class="error-message"></p>
                </fieldset>
                <fieldset>
                    <label>Email</label>
                    <input id="email" type="text" name="email">
                    <p class="error-message"></p>
                </fieldset>
            </section>

            <section id="login-info">
                <fieldset>
                    <label>Username</label>
                    <input id="login" type="text" name="username">
                    <p class="error-message"></p>
                </fieldset>
                <fieldset>
                    <label>Password</label>
                    <input id="pass" type="password" name="password">
                    <p class="error-message"></p>
                </fieldset>
                <fieldset>
                    <label>Re-type Pwd</label>
                    <input id="pass2" type="password" name="password_check">
                    <p class="error-message"></p>
                </fieldset>
            </section>

            <fieldset class="submit">
                <?php if (!empty($signup_error)): ?>
                    <p class="error-message"><?php echo $signup_error; ?></p>
                <?php else: ?>
                    <p></p>
                <?php endif; ?>

                <input class="button" type="submit" value="Sign Up">
            </fieldset>
        </form>

        <p>Already have an account? Log in <a href="../index.php">here</a>.</p>
    </main>

    <?php require_once '../includes/footer.inc.php' ?>
</body>
</html>
