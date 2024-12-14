<?php require_once '../server/assert_logged_in.php' ?>

<?php
if(!isset($_GET['r_id'])) {
    header ('Location: index.php');
    exit();
}

$r_id = $_GET['r_id'];

require_once '../server/dbconnection.php';

$db = db_connect();
$sql = "SELECT * FROM recipes WHERE recipe_id = '{$r_id}'";

$result_set = mysqli_query($db, $sql);
if (empty($result_set)) {
    die("Failed to call DB. " . mysqli_error($db));
}

$recipe = mysqli_fetch_assoc($result_set);
if(empty($recipe)) {
    header ('Location: index.php');
}
$recipe['ingredients'] = json_decode($recipe['ingredients_json']);
$recipe['instructions'] = json_decode($recipe['instructions_json']);
$recipe_id = $recipe['recipe_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once "../includes/css_import.php" ?>
    <title><?php echo $recipe['name'];?></title>
</head>
<body>
    <?php require_once '../includes/header.inc.php' ?>

    <main class="recipe">
        <div class="title">
            <h2><?php echo $recipe['name']; ?></h2>
            <h3><i><?php echo "({$recipe['cuisine']})"; ?> <?php echo $recipe['date_added']; ?></i></h3>
        </div>
        <div class="modifiers">
            <a class="edit" href="<?php echo "edit.php?recipe_id=$recipe_id" ?>">&#x270F;</a>
            <a class="delete" href="<?php echo "delete.php?recipe_id=$recipe_id" ?>">&#x1F5D1;</a>
        </div>
        <img class="image" src="<?php echo $recipe['image_url'] ?>" alt="<?php echo "Picture of {$recipe['name']}"; ?>">
        
        <p class="description"><?php echo $recipe['description']; ?></p>
        <div class="ingredients">
            <h3>Ingredients</h3>
            <ul>
                <?php foreach($recipe['ingredients'] as $ingredient): ?>
                    <li><?php echo $ingredient; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="instructions">
            <h3>Instructions</h3>
            <ol>
                <?php foreach($recipe['instructions'] as $instruction): ?>
                    <li><?php echo $instruction; ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
    </main>

    <?php require_once '../includes/footer.inc.php' ?>
</body>
</html>