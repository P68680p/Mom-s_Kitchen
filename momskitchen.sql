-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 12:51 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `momskitchen`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `username` varchar(30) NOT NULL,
  `recipe_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`username`, `recipe_id`) VALUES
('olaUser', 1),
('olaUser', 3),
('polinaUser', 2);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE recipes (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    cuisine VARCHAR(255),
    image_url TEXT,
    ingredients_json JSON,
    instructions_json JSON,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`name`, `description`, `cuisine`, `image_url`, `ingredients_json`, `instructions_json`, `date_added`) VALUES
('Banana Bread', 'This banana bread recipe creates the most delicious, moist loaf with loads of banana flavor. Why compromise the banana flavor? Friends and family love my recipe and say it\'s by far the best! It tastes wonderful toasted. Enjoy!', 'Baking', 'https://www.allrecipes.com/thmb/zksmXHLzXQ46d7CFgiDOMoHZ1ow=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/20144-banana-banana-bread-mfs-60-bddcb8e0caac452386de52f6fecf33db.jpg', '[\"2 cups all-purpose flour\",\"1 teaspoon baking soda\",\"¼ teaspoon salt\",\"¾ cup brown sugar\",\"½ cup butter\",\"2 large eggs, beaten\",\"2 ⅓ cups mashed overripe bananas\"]', '[\"Preheat the oven to 350 degrees F (175 degrees C). Lightly grease a 9x5-inch loaf pan.\",\"Combine flour, baking soda, and salt in a large bowl. Beat brown sugar and butter with an electric mixer in a separate large bowl until smooth. Stir in eggs and mashed bananas until well blended. Stir banana mixture into flour mixture until just combined. Pour batter into the prepared loaf pan.\",\"Bake in the preheated oven until a toothpick inserted into the center comes out clean, about 60 minutes. Let bread cool in pan for 10 minutes, then turn out onto a wire rack to cool completely.\"]', '2024-11-17'),
('Mashed Potatoes', 'Presenting my all-time favorite mashed potatoes recipe! These homemade mashed potatoes are perfectly rich and creamy, full of great flavor, easy to make, and always a crowd fave.', 'Sides', 'https://www.gimmesomeoven.com/wp-content/uploads/2018/11/The-Best-Mashed-Potatoes-Recipe-5-2.jpg', '[\"Potatoes: As mentioned above, I’m a big fan of using a mixture of half Yukon gold potatoes and half Russets. It gives you the best of both worlds — starchy and waxy potatoes — and they cook alongside one another beautifully. Although you are welcome to use just one variety of potatoes, if you prefer.\",\"Garlic: When serving these to a crowd, I like to add just 2-3 cloves to give just a subtle undertone of garlic to the recipe. But if making them for myself, I will toss in up to a dozen cloves. I adore good garlic mashed potatoes.\",\"Butter: When I eat mashed potatoes, I go all-out and want them to taste nice and buttery. We don’t add as much butter here as many recipes do, because the other ingredients help to make them nice and creamy, but you are of course welcome to add in more butter if you would like. If you are eating dairy-free and/or vegan, feel free to use vegan butter.\",\"Milk: I always use whole cow’s milk in my mashed potatoes. But you are welcome to amp things up with half and half or heavy cream, if you prefer. Or alternately, you can use a lighter milk or plain plant-based milk.\",\"Cream Cheese: I always grew up making mashed potatoes with cream cheese and enjoy the slight extra tangy and creaminess that it adds. Be sure that your cream cheese is room temperature and cut into small 1-inch chunks, for easy melting into the potatoes.\",\"Fine sea salt: Which we will use to season the potatoes at different points while cooking. (If you only have iodized table salt on hand, note that its flavor is different and stronger so you will need to use a bit less.)\",\"Toppings (Optional): I like to sprinkle on some chopped chives or green onions, for some extra color and freshness. Plus lots and lots of freshly-cracked black pepper. But feel free to add on what you’d like!\"]', '[\"Cut the potatoes. Again, feel free to peel your potatoes or leave the skins on. (I always leave them on for the extra nutrients and flavor.)  Then cut your potatoes into evenly-sized chunks, about an inch or so thick. Then transfer them to a large stockpot full of cold water until all of the potatoes are cut and ready to go.\",\"Boil the potatoes. Once all of your potatoes are cut, be sure that there is enough cold water in the pan so that the water line sits about 1 inch above the potatoes. Add the garlic and 1 tablespoon salt to the water. Then turn on high heat until the water comes to a boil. And boil the potatoes for about 10-12 minutes until a knife inserted in the middle of a potato goes in with almost no resistance. Carefully drain out all of the water.\",\"Prepare your melted butter mixture. Meanwhile, as the potatoes are boiling, heat your butter, milk and an additional 2 teaspoons of sea salt together either in a small saucepan or in the microwave until the butter is just melted. (You want to avoid boiling the milk.)  Set aside until ready to use.\",\"Pan-dry the potatoes. Return the potatoes to the hot stockpot, and then place the stockpot back on the hot burner, turning the heat down to low. Using two oven mitts, carefully hold the handles on the stockpot and shake it gently on the burner for about 1 minute to help cook off some of the remaining steam within the potatoes. Then remove the stockpot entirely from the heat.\",\"Mash the potatoes.  Using your preferred kind of masher (see above), mash the potatoes to your desired consistency.\",\"Stir everything together. Then pour half of the melted butter mixture over the potatoes, and fold it in with a wooden spoon or spatula until potatoes have soaked up the liquid. Repeat with the remaining butter. And then again with the cream cheese. Fold each addition in until just combined to avoid overmixing, or else you will end up with gummy potatoes.\",\"Taste and season. One final time, adding in extra salt (plus black pepper, if you would like) to taste.\",\"Serve warm. Then serve warm, garnished with any extra toppings that you might like, and enjoy!!\"]', '2024-11-17'),
('Orange Chicken', 'This 4-ingredient orange chicken made with frozen chicken tenders is great for when you’re craving takeout. It’s so simple to make at home, is very budget-friendly, and only takes 4 ingredients. I serve it over rice, topped with green onions and sesame seeds.', 'Chinese', 'https://www.allrecipes.com/thmb/ohu09JIacyje7-_COFh-71GN15M=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/4-ingredient-orange-chicken-recipe-8713472Christina4x3-d428f35780464083bacc79e7a37eae28.jpg', '[\"1 cup orange marmalade\",\"1/2 cup Kansas City-style BBQ sauce\",\"1/4 cup low sodium soy sauce\",\"1 (1 pound) bag frozen fully cooked chicken nuggets\",\"sliced green onions (optional)\",\"sesame seeds (optional)\"]', '[\"Preheat the oven to 400 degrees F (200 degrees C). Place frozen nuggets in a single layer on a baking sheet.\",\"Bake in the preheated oven until hot and crispy, 11 to 13 minutes, or according to package directions.\",\"Meanwhile, whisk marmalade, BBQ sauce, and soy sauce together in a small saucepan and heat over low heat until hot, about 5 minutes.\",\"Place nuggets in a large bowl. Drizzle sauce over the top. Toss to coat.\"]', '2024-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(30) NOT NULL,
  `pwd_hash` varchar(250) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `pwd_hash`, `first_name`, `last_name`, `email`) VALUES
('olaUser', '$2y$10$k6TL3QLS4fiaBL.1gliUIekowx75bUjk6zb6xZEBHLymPH0rb2I9.', 'Ola', 'Assaad', 'ola.assaad7@gmail.com'),
('polinaUser', '$2y$10$Y9DVetgljRVfE40YEArsF.9w0.VmdnKTwSlTeZmzJthkVWQKht4Xm', 'Polina', 'Debchuk', 'polina@debchuk.com'),
('zahraUser', '$2y$10$4C6l8KnA7XuElMfEZam5ruMsn4Oht88mQ7YwRBQ/INv60D/DegCSC', 'Zahra', 'Pyarali', 'zahra@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD UNIQUE KEY `username` (`username`,`recipe_id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`recipe_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `recipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
