-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 06:10 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monde_floral_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL DEFAULT 1,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(186, 0, 29, 'Dahlias', 30, 1, '61HDBKRte2L.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_message`
--

CREATE TABLE `tbl_message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL DEFAULT 'Cash on delivery',
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(22, 16, 'ssd', '9858585858', 'dsfsf@gmail.com', 'Cash on delivery', 'flat no. 321, dfgdgfg , himmatnagar,gujrat,india - ', 'pink rose (1) ', 12, '04-Jan-2023', 'pending'),
(26, 18, 'sdasd', '6787654356', 'hibiwig102@fsouda.com', 'Cash on delivery', 'flat no. ygy esfvjhsdf snmdfbshjdbf, , himmatnagar,gujrat,india - 383001', ', cottage rose (1) ', 15, '06-Feb-2023', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `details`, `price`, `image`) VALUES
(25, 'Azalea', 'Buy  Azalea at best price in India. Get your plants delivered at your home all over India with Monde Floral ', 150, 'istockphoto-184961793-612x612.jpg'),
(26, 'California Poppy', 'Buy the finest Poppy California Flower Online for decoration. only for Rs.99/Pack with free Home Delivery across India only at Monde Floral now.', 99, 'poppypotion4_1024x1024.webp'),
(27, 'Calla Lilies', 'Place this charming Calla Lily bundle in a clear vase to brighten up your living room. Team it with other flowers to create a lovely tabletop display.', 20, '10676315_2.webp'),
(29, 'Dahlias', 'Buy the finest Dahlia Mixed Seeds Online for decoration. only for Rs.30 to 300 Piece with free Home Delivery across India only at Monde Floral Store now.', 30, '61HDBKRte2L.jpg'),
(30, 'marigold', 'Marigold is a flower commonly grown in Asian regions. It is used for religious and decorative purpose.', 45, 'marigold-flowers-100-g-product-images-o590001663-p590363525-0-202203171015.jpg'),
(31, 'crocus', 'Saffron can grow nearly anywhere in the world. The kind of soil is far more important than the climate of the region where one wants to grow it. ', 359, 'Closeup on two purple crocus flowers on a lawn.jpg'),
(32, 'Tulip', 'Tulip flower and leaves: PU (poly urethane), Stem: \r\nsteel wire + plastic.', 700, 's20657_5000x.webp'),
(33, 'Lavender', 'Lavender is a flowering plant in the mint family that\'s easily identified by its sweet floral scent. It\'s believed to be native to the Mediterranean, the Middle East, and India, with a history dating as far back as 2,500 years.', 1600, 'Artificial-Flowers-Lavender-Bouquet-for-Home-Wedding-Garden-Patio-Decoration.jpg'),
(34, 'zinnia', 'Zinnia is a genus of plants of the tribe Heliantheae within the family Asteraceae. They are native to scrub and dry grassland in an area stretching from the Southwestern United States to South America, with a centre of diversity in Mexico.', 10, 'how-to-grow-zinnias-4121894-06-bb520358b22645d68ed1924976b414bb.webp'),
(35, 'Orchids', 'A cluster of striking flowers is certain to make any special day or celebration more thrilling, colorful, and memorable.', 250, 'white-orchids-in-a-vase.jpg'),
(36, 'jasmine', 'Jasmine is a genus of shrubs and vines in the olive family. It contains around 200 species native to tropical and warm temperate regions of Eurasia, Africa, and Oceania. Jasmines are widely cultivated for the characteristic fragrance of their flowers.', 42, 'istockphoto-1134069126-612x612.jpg'),
(37, 'Rose', 'A rose is either a woody perennial flowering plant of the genus Rosa, in the family Rosaceae, or the flower it bears. There are over three hundred species and tens of thousands of cultivars.', 68, 'beautiful-velvet-rose-isolated-white_173032-143.avif'),
(38, 'Daffodils', 'Narcissus is a genus of predominantly spring flowering perennial plants of the amaryllis family, Amaryllidaceae. Various common names including daffodil, narcissus, and jonquil are used to describe all or some members of the genus.', 10, 'daffodils-b-b-b_560x.jpg'),
(39, 'Iris', 'Iris is a flowering plant genus of 310 accepted species with showy flowers. As well as being the scientific name, iris is also widely used as a common name for all Iris species, as well as some belonging to other closely related genera.', 200, 'side-view-dark-purple-color-iris-flower-isolated-white-background_141793-8059.avif'),
(40, 'Dusty Miller', 'Jacobaea maritima, commonly known as silver ragwort, is a perennial plant species in the genus Jacobaea in the family Asteraceae, native to the Mediterranean region. It was formerly placed in the genus Senecio, and is still widely referred to as Senecio cineraria; see the list of synonyms for other names.', 80, '60.-HF4680WHT-White-COLOURED-DUSTY-MILLER-80CM.jpg'),
(41, 'Carnation', 'Dianthus caryophyllus, commonly known as the carnation or clove pink, is a species of Dianthus. It is likely native to the Mediterranean region but its exact range is unknown due to extensive cultivation for the last 2,000 years.', 549, 'pink-carnation-flower-beautiful-isolated-white-background-66861923.jpg'),
(42, 'Gardenias', 'Gardenia is a genus of flowering plants in the coffee family, Rubiaceae, native to the tropical and subtropical regions of Africa, Asia, Madagascar and Pacific Islands, and Australia. The genus was named by Carl Linnaeus and John Ellis after Alexander Garden, a Scottish-born American naturalist.', 50, 'white-gardenia-blossom-400x533.webp'),
(43, 'Delphinium', 'Delphinium is a genus of about 300 species of annual and perennial flowering plants in the family Ranunculaceae, native throughout the Northern Hemisphere and also on the high mountains of tropical Africa. The genus was erected by Carl Linnaeus. All members of the genus Delphinium are toxic to humans and livestock.', 1500, 'download.jpg'),
(44, 'buttercup', 'Ranunculus bulbosus, commonly known as bulbous buttercup or St. Anthony\'s turnip, is a perennial flowering plant in the buttercup family Ranunculaceae. It has bright yellow flowers, and deeply divided, three-lobed long-petioled basal leaves. ', 50, 'Creeping_butercup_close_800.jpg'),
(45, 'Prime Rose', 'Primula vulgaris, the common primrose, is a species of flowering plant in the family Primulaceae, native to western and southern Europe, northwest Africa, and parts of southwest Asia. ', 15, 'images.jpg'),
(46, 'Red Poinsettia', 'The poinsettia is a commercially important flowering plant species of the diverse spurge family Euphorbiaceae. Indigenous to Mexico and Central America, the poinsettia was first described by Europeans in 1834. It is particularly well known for its red and green foliage and is widely used in Christmas floral displays. ', 500, '41OIoeHqlgL.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products_review`
--

CREATE TABLE `tbl_products_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` varchar(50) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products_review`
--

INSERT INTO `tbl_products_review` (`id`, `product_id`, `user_id`, `rating`, `review`, `status`, `added_on`) VALUES
(3, 13, 16, 'Fantastic', 'One of the best online florist I have ever dealt with! The customer service is beyond excellent.', 1, '2022-12-29 02:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(10, 'admin A', 'admin01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'admin'),
(14, 'user A', 'user01@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(15, 'user B', 'user02@gmail.com', '698d51a19d8a121ce581499d7b701668', 'user'),
(16, 'shahid rajpura', 'shahid@mars.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(17, 'mars123', 'mars@hmsdghd.com', '81dc9bdb52d04dc20036dbd8313ed055', 'admin'),
(19, 'xyz', 'xyz@xmars.com', '81dc9bdb52d04dc20036dbd8313ed055', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_message`
--
ALTER TABLE `tbl_message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products_review`
--
ALTER TABLE `tbl_products_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `tbl_message`
--
ALTER TABLE `tbl_message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_products_review`
--
ALTER TABLE `tbl_products_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
