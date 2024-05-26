CREATE DATABASE IF NOT EXISTS `php_project`;

USE `php_project`;

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,  
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` varchar(20) NOT NULL,  
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `order_items`(
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` INT NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,  -- Increased length for potential hashing
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `UX_Constraint` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name`varchar(255) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
 `admin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name`varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
 `user_password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(16, 'YSL Jacket', 'clothes', 'Very expensive', 'clothe3.1.jpg', 'clothe3.2.jpg', 'clothe3.3.jpg', 'clothe3.4.jpg', '1998.00', 0, 'Black'),
(5, 'Gris  Dior  Perfume ', 'perfumes', 'Very good look', 'feature2.1.jpg', 'feature2.2.jpg', 'feature2.3.jpg', 'feature2.4.jpg', '320.00', 0, 'purple'),
(14, 'Chanel ', 'perfumes', 'A very good ', 'clothe1.1.jpg', 'clothe1.2.jpg', 'clothe1.3.jpg', 'clothe1.4.jpg', '1199.00', 0, 'black, white $ purple'),
(12, 'Chance Chanel', 'Perfume', 'look expensive one', 'feature3.1.jpg', 'feature3.2.jpg', 'feature3.3.jpg', 'feature3.4.jpg', '399.00', 0, 'Pink , Green , Orange '),
(7, 'YSL Perfume', 'Perfume', 'Look Expensive', 'feature4.1.jpg', 'feature4.2.jpg', 'feature4.3.jpg', 'feature4.4.jpg', '399.00', 0, ''),
(15, 'Chanel ', 'coats', 'Sexy One', 'clothe2.1.jpg', 'clothe2.2.jpg', 'clothe2.3.jpg', 'clothe2.4.jpg', '799.00', 0, 'Black , White & Red'),
(10, 'Miss Dior', 'Perfume', 'Feeling Sweet', 'feature1.1.jpg', 'feature1.2.jpg', 'feature1.3.jpg', 'feature1.4.jpg', '299.00', 0, 'pink & orange'),
(17, 'LV', 'coats', 'Look expensive', 'clothe4.1.jpg', 'clothe4.2.jpg', 'clothe4.3.jpg', 'clothe4.4.jpg', '299.00', 0, 'Colorful'),
(18, 'LV bag', 'bag', 'Luxury and expensive', 'bag1.1.jpg', 'bag1.2.jpg', 'bag1.3.jpg', 'bag1.4.jpg', '4999.00', 0, 'Orange'),
(19, 'YSL bag  ', 'perfumes', 'Really Recommend', 'bag2.1.jpg', 'bag2.2.jpg', 'bag2.3.jpg', 'bag2.4.jpg', '1521.00', 0, 'Black , Red & Brown'),
(21, 'Dior bag', 'bag', 'Nice one', 'bag3.1.jpg', 'bag3.2.jpg', 'bag3.3.jpg', 'bag3.4.jpg', '1189.00', 0, 'Black'),
(22, 'Chanel bag', 'bag', 'Nice one', 'bag4.1.jpg', 'bag4.2.jpg', 'bag4.3.jpg', 'bag4.4.jpg', '1899.00', 0, 'Colorful'),
(23, 'LV Shoes', 'shoes', 'Sport', 'shoes1.1.jpg', 'shoes1.2.jpg', 'shoes1.3.jpg', 'shoes1.4.jpg', '488.00', 0, 'Colorful'),
(24, 'Chanel Shoes', 'shoes', 'Soft and cute', 'shoes2.1.jpg', 'shoes2.2.jpg', 'shoes2.3.jpg', 'shoes2.4.jpg', '999.00', 0, 'Black & White '),
(25, 'YSL Shoes', 'shoes', 'Look so elegand', 'shoes3.1.jpg', 'shoes3.2.jpg', 'shoes3.3.jpg', 'shoes3.4.jpg', '399.00', 0, 'Colorful'),
(27, 'Miss Dior Perfume', 'Perfume', 'Awesome Perfume', 'feature2.1.jpg', 'feature2.2.jpg', 'feature2.3.jpg', 'feature2.4.jpg', '229.00', 0, 'Colorful'),
(29, 'YSL Dress', 'coats', 'Very Quality Dress', 'clothe3.1.jpg', 'clothe3.2.jpg', 'clothe3.3.jpg', 'clothe3.4.jpg', '877.00', 0, 'Black'),
(30, 'Dior Dress', 'coats', 'Very Quality Dress', 'clothe1.1.jpg', 'clothe1.2.jpg', 'clothe1.3.jpg', 'clothe1.4.jpg', '988.00', 0, 'Black'),
(31, 'YSL Bag', 'bag', 'Very Quality Bag', 'bag2.1.jpg', 'bag2.2.jpg', 'bag2.3.jpg', 'bag2.4.jpg', '1278.00', 0, 'Black & Red'),
(33, 'Dior Shoes', 'shoes', 'Very Quality Shoes', 'shoes4.1.jpg', 'shoes4.2.jpg', 'shoes4.3.jpg', 'shoes4..4.jpg', '278.00', 0, 'Colorful');
COMMIT;