<!-- single page form so we get the id and if we hit post the we update so we will process the update mysqli_query
and redirect to show page otherwise just display the record. -->
<?php
require_once '../server/assert_logged_in.php';

require_once '../server/dbconnection.php';
$db = db_connect();

$id = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //access the recipe information
    $id = $_POST['recipe_id'];
    $name = $_POST['name'];
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $cuisine = $_POST['cuisine'];
    $image_url = $_POST['image_url'];
    $ingredients_json = mysqli_real_escape_string($db, json_encode(explode("\r\n", $_POST['ingredients_json'])));
    $instructions_json = mysqli_real_escape_string($db, json_encode(explode("\r\n", $_POST['instructions_json'])));


    //update the table with new information
    $sql = "UPDATE recipes SET name = '$name' , 
                            description= '$description', 
                            cuisine= '$cuisine',
                            image_url= '$image_url' ,
                            ingredients_json= '$ingredients_json',
                            instructions_json= '$instructions_json' 
            WHERE recipe_id = $id";

    $result = mysqli_query($db, $sql);

    //redirect to show page
    if (mysqli_errno($db)) {
        die("Something went wrong! " . mysqli_error($db));
    } else {
        header("Location: recipe.php?r_id=  $id");
    }
} else {
    $id = filter_input(INPUT_GET, 'recipe_id', FILTER_DEFAULT);
}

// display the recipe information
$sql = "SELECT * FROM recipes WHERE recipe_id= '$id' ";

$result_set = mysqli_query($db, $sql);

$result = mysqli_fetch_assoc($result_set);

$ingredients = implode("\r\n", json_decode($result['ingredients_json'], true));
$instructions = implode("\r\n", json_decode($result['instructions_json'], true));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe</title>
    <?php include_once "../includes/css_import.php" ?>
</head>

<body>

    <?php require_once '../includes/header.inc.php'; ?>

    <main>
        <a class="back-link" href="<?php echo "recipe.php?r_id=$id" ?>">&laquo; Back</a>
        <h2>Edit <?php echo $result['name']; ?></h2>
        <form class="pink-box" action="edit.php" method="POST">
            <input type="hidden" name="recipe_id" value="<?php echo $id; ?>">
            <fieldset>
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $result['name']; ?>">
            </fieldset>

            <fieldset>
                <label>Description</label>
                <input type="text" name="description" value="<?php echo $result['description']; ?>">
            </fieldset>

            <fieldset>
                <label>Cuisine</label>
                <input type="text" name="cuisine" value="<?php echo $result['cuisine']; ?>">
            </fieldset>

            <fieldset>
                <label>Image URL</label>
                <input type="text" name="image_url" value="<?php echo $result['image_url']; ?>">
            </fieldset>

            <fieldset>
                <label>Ingredients (newline separated)</label>
                <textarea name="ingredients_json" rows="5"><?php echo $ingredients; ?></textarea>
            </fieldset>

            <fieldset>
                <label>Instructions (newline separated)</label>
                <textarea name="instructions_json" rows="5"><?php echo $instructions; ?></textarea>
            </fieldset>

            <fieldset class="submit">
                <a href="<?php echo "recipe.php?r_id=$id"; ?>">Cancel</a>
                <input class="button" type="submit" value="Save">
            </fieldset>

        </form>
    </main>

    <?php require_once '../includes/footer.inc.php'; ?>
</body>

</html>