<?php
require_once '../server/assert_logged_in.php';
$user = $_SESSION['user'];

require_once '../server/dbconnection.php';

$db = db_connect();
$sql = "SELECT
            recipes.recipe_id,
            name,
            cuisine,
            image_url,
            description,
            true as is_favorite
        FROM recipes LEFT JOIN favorites
        ON recipes.recipe_id = favorites.recipe_id
        WHERE username = '{$user['username']}'";

$result_set = mysqli_query($db, $sql);

$recipes = [];
while ($row = mysqli_fetch_assoc($result_set)) {
    $recipes[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "../includes/css_import.php" ?>
    <title>Mom's Kitchen</title>
</head>
<body>
    <?php require_once '../includes/header.inc.php'; ?>
    <main class="favorites">
        <h2><?php echo $user['first_name'] ?>'s Favorites</h2>
        <?php if(count($recipes) > 0): ?>
            <?php include_once '../includes/recipe_list.inc.php' ?>
        <?php else: ?>
            <p>No Favorites. To add some recipes go to the <a href="all_recipes.php">All Recipes</a> page.</p>
        <?php endif; ?>
    </main>

    <?php require_once '../includes/footer.inc.php' ?>
</body>
</html>