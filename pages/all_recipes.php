//This file display a list of all recipies 
<?php 

//open session
require_once __DIR__ . '/../server/assert_logged_in.php';
$user = $_SESSION['user'];

//create connection to DB
require_once __DIR__ . '/../server/dbconnection.php';
$db = db_connect();

//functions to work with filter's list
require_once __DIR__ . '/../server/filter_functions.php';

$sql = "SELECT
            recipes.recipe_id,
            name,
            cuisine,
            image_url,
            description,
            favorites.recipe_id IS NOT NULL as is_favorite
        FROM recipes LEFT OUTER JOIN favorites
            ON recipes.recipe_id = favorites.recipe_id
            AND favorites.username = '{$user['username']}'";

// Retrieve the search query from the URL if it exists
$search = '';
$search_where_clause = '';

if (isset($_GET['search'])) {
    $search = $_GET['search']; 
    // Modify the SQL query to include search filtering if a search term is present
    $search_where_clause = "WHERE name LIKE '%$search%' OR cuisine LIKE '%$search%' OR description LIKE '%$search%'";
    $sql = "$sql $search_where_clause ORDER BY name ASC";
}

// Retrieve the filter query from the URL if it exists
$arr_selected_cuisine=[];
$filtered_where_clause = '';
if (isset($_GET['cuisine'])){
    $arr_selected_cuisine=$_GET['cuisine'];
    // Modify the SQL query to include filters if it is present
    foreach($arr_selected_cuisine as $selected_checkbox){
        $filtered_where_clause.='cuisine = "'.$selected_checkbox.'" OR ';
    }
    $filtered_where_clause = substr($filtered_where_clause, 0, -3);
    $sql = "$sql WHERE $filtered_where_clause ORDER BY name ASC";
}

// Execute the query
$result_set = mysqli_query($db, $sql);
// if (mysqli_errno($db)) {
//     die("Something went wrong. " . mysqli_error($db));
// }

// Populate the $recipes array with the searched/filtered or full result set
$recipes = [];
// Loop through each row in the result set fetched from the database.
while ($row = mysqli_fetch_assoc($result_set)) {
    // Add the current row (which is an associative array) to the $recipes array.
    // Each $row represents a recipe fetched from the database.
    $recipes[] = $row;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once __DIR__ . '/../includes/css_import.php' ?>
    <title>Mom's Kitchen</title>
</head>
<body>
    <?php require_once __DIR__ . '/../includes/header.inc.php'; ?>

    <main class="all-recipes">
        <h2>All Recipes</h2>

        <form class="search pink-box" action="all_recipes.php" method="get">
            <input type="search" name="search" value="<?php echo $search; ?>" placeholder="Search for recipes...">
            <input class="button" type="submit" value="Search">
        </form>

        <div class="filter">
            <h2>Filter Recipes</h2>
            <form name="checkBoxForm" action="all_recipes.php" method="get">
                <?php
                    // Retrieve the list of all available cuisines from the database.
                    // This function is assumed to return an array of all cuisines found in the 'recipes' table.
                    $arr_all_cuisine = get_cuisines_list($db);
                    // Generate HTML checkboxes based on the list of cuisines.
                    // The function `get_html_checkbox` will create checkbox inputs, marking them checked if they are in $arr_selected_cuisine.
                    $myhtml = get_html_checkbox($arr_all_cuisine, $arr_selected_cuisine);
                    // Display the generated HTML checkboxes on the web page.
                    echo $myhtml;
                ?>
                
                <input class="button" type="submit" value="Apply Filter">
            </form>
        </div>
        <div>
            <?php include_once __DIR__ . '/../includes/recipe_list.inc.php' ?>
        </div>
    </main>

    <?php require_once __DIR__ . '/../includes/footer.inc.php' ?>
</body>
</html>
