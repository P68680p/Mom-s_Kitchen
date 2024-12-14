<?php
require_once '../server/assert_logged_in.php';
require_once '../server/dbconnection.php';

// create database connection
$db = db_connect(); // Ensure the db_connect() function returns a valid connection

// Check if the connection is successful
if (!$db) {
    die("Database connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $cuisine = mysqli_real_escape_string($db, $_POST['cuisine']);
    $image_url = mysqli_real_escape_string($db, $_POST['image_url']);
    
    // Handle the ingredients and instructions JSON
    $ingredients_raw = $_POST['ingredients_json'];
    $instructions_raw = $_POST['instructions_json'];
    
    // Clean the input data (if needed)
    $ingredients_array = explode("\r\n", $ingredients_raw); // Assumes ingredients are separated by newlines
    $instructions_array = explode("\r\n", $instructions_raw); // Assumes instructions are separated by newlines
    
    // check if the data is valid JSON
    $ingredients_json = json_encode($ingredients_array);
    $instructions_json = json_encode($instructions_array);

    // if (json_last_error() !== JSON_ERROR_NONE) {
    //     die('Error encoding JSON: ' . json_last_error_msg());
    // }

    // SQL insert statement
    $sql = "INSERT INTO recipes (name, description, cuisine, image_url, ingredients_json, instructions_json)
            VALUES ('$name', '$description', '$cuisine', '$image_url', '$ingredients_json', '$instructions_json')";

    // Insert the recipe into the database
    if (mysqli_query($db, $sql)) {
        header('Location: all_recipes.php');
    } else {
        die("Something went wrong! " . mysqli_error($db));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Recipe</title>
    <?php include_once "../includes/css_import.php" ?>
</head>
<body>
    
    <?php require_once '../includes/header.inc.php'; ?>
    
    <main>
        <h2>Add New Recipe</h2>
        <form class="pink-box" action="create.php" method="POST">
            <fieldset>
                <label>Name</label>
                <input type="text" name="name" required>
            </fieldset>
            
            <fieldset>
                <label>Description</label>
                <input type="text" name="description" required>
            </fieldset>

            <fieldset>
                <label>Cuisine</label>
                <input type="text" name="cuisine" required>
            </fieldset>

            <fieldset>
                <label>Image URL</label>
                <input type="text" name="image_url" required>
            </fieldset>

            <fieldset>
                <label>Ingredients (newline separated)</label>
                <textarea name="ingredients_json" rows="5" required></textarea>
            </fieldset>

            <fieldset>
                <label>Instructions (newline separated)</label>
                <textarea name="instructions_json" rows="5" required></textarea>
            </fieldset>
            
            <fieldset class="submit">
                <p></p>
                <input class="button" type="submit" value="Create Recipe">
            </fieldset>
            
        </form>
    </main>

    <?php require_once '../includes/footer.inc.php'; ?>
</body>
</html>