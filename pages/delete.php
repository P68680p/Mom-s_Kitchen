<?php
require_once '../server/assert_logged_in.php';

require_once '../server/dbconnection.php';
$db = db_connect();

if(!isset($_GET['recipe_id'])) {
  header("Location:  all_recipes.php");
}

// if we decided to delete, execute delete query and redirect to the main page
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(!isset($_POST['recipe_id'])) {
    header("Location:  all_recipes.php");
  }
  $recipe_id = filter_input(INPUT_POST, 'recipe_id', FILTER_DEFAULT);
  $sql = "DELETE FROM recipes WHERE recipe_id ='$recipe_id'";
  $result = mysqli_query($db, $sql);
//redirect to the main page
  header("Location: all_recipes.php");
  exit;
} else {  // to access the employee data
  if(!isset($_GET['recipe_id'])) {
    header("Location:  all_recipes.php");
  }
  $recipe_id = filter_input(INPUT_GET, 'recipe_id', FILTER_DEFAULT);
  $sql = "SELECT * FROM recipes WHERE recipe_id= '$recipe_id' ";

  $result_set = mysqli_query($db, $sql);
  $result = mysqli_fetch_assoc($result_set);  
}
?>

<!-- example of single page processing form  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Recipe</title>
    <?php include_once "../includes/css_import.php" ?>
</head>
<body>
  <?php include '../includes/header.inc.php'; ?>

  <main class="delete">
    <a class="back-link" href="<?php echo "recipe.php?r_id=$recipe_id" ?>">&laquo; Back</a>
    <h2>Delete <?php echo $result['name'] ?></h2>
    <form class="pink-box" action="delete.php"  method="post">
      <label>Are you sure you want to delete this recipe?</label>
      <fieldset class="submit">
        <input type="hidden" name="recipe_id" value="<?php echo $recipe_id; ?>">
        <p></p>
        <input class="button" type="submit" value="Delete" />
      </fieldset>
    </form>
  </main>

  <?php include '../includes/footer.inc.php'; ?>
</body>
</html>