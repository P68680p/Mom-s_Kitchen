<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "{$_SERVER['DOCUMENT_ROOT']}/CST8285_Assignment2/server/root.php";
$rootUrl = rootUrl();
?>

<header>
    <div class="title">
        <h1>Mom's Kitchen</h1>
        <p><i>Ola's & Polina's Recipes for the soul</i></p>
    </div>
    <?php if (empty($_SESSION['user'])): ?>
        <div class="login">
            <a class="button" href="<?php echo "$rootUrl/index.php"; ?>"><b>Log In</b></a>
            <a href="<?php echo "$rootUrl/pages/signup.php"; ?>">Sign Up</a>
        </div>
    <?php else: ?>
        <div class="logout">
            <form action="<?php echo "$rootUrl/server/logout.php"; ?>" method="post">
                <label><?php echo $_SESSION['user']['full_name'];?></label>
                <input class="button" type="submit" value="Logout">
            </form>
        </div>
        <nav>
            <a href="<?php echo "$rootUrl/pages/favorites.php"; ?>">Favorites</a>
            <a href="<?php echo "$rootUrl/pages/all_recipes.php"; ?>">All Recipes</a>
            <a href="<?php echo "$rootUrl/pages/create.php"; ?>">Add New</a>
        </nav>
    <?php endif; ?>
</header>
