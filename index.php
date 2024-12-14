<?php require_once 'server/assert_logged_out.php' ?>

<?php
require_once 'server/dbconnection.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
    $password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    $db = db_connect();
    $sql = "SELECT username, pwd_hash, first_name, last_name, email
            FROM users
            WHERE username = '{$username}'";
    $result_set = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result_set);
    
    $login_error = null;
    if (empty($user)) {
        $login_error = "Username {$username} doesn't exist!";
    } elseif (!password_verify($password, $user['pwd_hash'])) {
        $login_error = 'Wrong Password!';
    } else {
        $user['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['user'] = $user;
        header("Location: pages/favorites.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css?v=<?php echo time(); ?>">
    <title>Mom's Kitchen</title>
</head>
<body>
    <?php require_once 'includes/header.inc.php' ?>

    <main class="login">
        <h2>User Login</h2>
        <form class="pink-box" action="index.php" method="post">
            <fieldset>
                <label>Username</label>
                <input type="text" name="username">
            </fieldset>
            <fieldset>
                <label>Password</label>
                <input type="password" name="password">
            </fieldset>
            <fieldset class="submit">
                <?php if(!empty($login_error)): ?>
                    <p><?php echo $login_error; ?></p>
                <?php else: ?>
                    <p></p>
                <?php endif; ?>
                <input class="button" type="submit" value="Log In">
            </fieldset>
        </form>
        <p>Don't have an account? Sign up <a href="pages/signup.php">here</a>.</p>
        <p></p><!-- space in between -->
        <h2>About Us</h2>
        <div class="about pink-box">
            <p>Hello, we are Ola and Polina.</p>
            <p>Nice to have you visit our virtual recipe book. We built this website with community in mind. We wanted to share our favorite recipes with you. We also hope you'll take the time to write your own recipes so we can all partake in building the best recipe website on the net.</p>
            <p>Hope you enjoy!</p>
        </div>
    </main>
    <hr>
    <?php require_once 'includes/footer.inc.php' ?>
</body>
</html>