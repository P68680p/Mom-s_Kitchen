<ul>
    <?php foreach ($recipes as $recipe): ?>
        <li class="recipe-summary">
            <a class="name" href="<?php echo "recipe.php?r_id={$recipe['recipe_id']}"; ?>">
                <h3>
                    <?php echo $recipe['name']; ?> <i><?php echo "({$recipe['cuisine']})"; ?></i>
                </h3>
            </a>
            <div class="star">
                <?php if($recipe['is_favorite']): ?>
                    <form action="../server/remove_favorite.php" method="post">
                        <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                        <input type="hidden" name="return_url" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="submit" value="&#9733;">
                    </form>
                <?php else: ?>
                    <form action="../server/add_favorite.php" method="post">
                        <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                        <input type="hidden" name="return_url" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="submit" value="&#9734;">
                    </form>
                <?php endif; ?>
            </div>
            <a class="image" href="<?php echo "recipe.php?r_id={$recipe['recipe_id']}"; ?>">
                <img height="150" width="150" src="<?php echo $recipe['image_url']; ?>" alt="<?php echo "Picture of {$recipe['name']}"; ?>">
            </a>
            <p class="description"><?php echo $recipe['description'] ?></p>
        </li>
    <?php endforeach; ?>
</ul>