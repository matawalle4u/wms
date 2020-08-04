-- CREATE TABLE `products` (
--   `product_id` int(11) NOT NULL AUTO_INCREMENT,
--   `description` varchar(65) NOT NULL,
--   `category` varchar(65) NOT NULL,
--   `barcode` varchar(256) NOT NULL,
--   `product_code` varchar(65) NOT NULL,
--   `img_src` varchar(65) NOT NULL,
--   `supplier` int(11) NOT NULL,
--   `expiry_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   `rack` int(11) NOT NULL,
--   `item_type` varcha(65) NOT NULL,
--    PRIMARY KEY (`product_id`),
--    FOREIGN KEY (`supplier`) REFERENCES `supplier`(`supplier_id`) ON DELETE CASCADE,
--    FOREIGN KEY (`rack`) REFERENCES `racks` (`rack_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `product_config` (
--   `prod_config_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product` varchar(65) NOT NULL,
--   `unit_measure` varchar(65) NOT NULL,
--   `unit_restr` varchar(65) NOT NULL,
--    PRIMARY KEY (`prod_config_id`),
--    FOREIGN KEY (`product`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `prices` (
--   `price_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product` varchar(65) NOT NULL,
--   `unit_measure` varchar(11) NOT NULL,
--   `amount` int(11) NOT NULL,
--    PRIMARY KEY (`price_id`),
--    FOREIGN KEY (`product`) REFERENCES `products`(`product_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `stocks` (
--   `stock_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product` int(11) NOT NULL,
--   `warehouse` int(11) NOT NULL,
--   `quantity` int(11) NOT NULL,
--   `status` varchar(65) NOT NULL,
--    PRIMARY KEY (`stock_id`),
--    FOREIGN KEY (`product`) REFERENCES `products`(`product_code`) ON DELETE CASCADE,
--    FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `damages`(
--   `damage_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product` int(11) NOT NULL,
--   `quantity` int(11) NOT NULL,
--   `details` TEXT NOT NULL,
--   `img_src` varchar(65),
--   `damaged_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   PRIMARY KEY (`damage_id`),
--   FOREIGN KEY (`product`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `customers` (
--   `customer_id` int(11) NOT NULL AUTO_INCREMENT,
--   `customer_code` varchar(65) NOT NULL,
--   `cust_reg_code` varchar(65) NOT NULL,
--   `name` varchar(65) NOT NULL,
--   `email` varchar(256) NOT NULL,
--   `contact` VARCHAR(65) NOT NULL,
--   `address` TEXT NOT NULL,
--   `type` varchar(65) NOT NULL,
--   `category` varchar(65) NOT NULL,
--   `status` int(11) DEFAULT 1 NOT NULL,
--    PRIMARY KEY (`customer_id`),
--    UNIQUE KEY (`phone`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ALTER TABLE `products`
--   ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`category`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE

-- CREATE TABLE `product_category` (
--   `product_category_id` int(11) NOT NULL AUTO_INCREMENT,
--   `category_name` varchar(256) NOT NULL,
--   `category_desc` TEXT NOT NULL,
--    PRIMARY KEY (`product_category_id`),
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `product_discounts` (
--   `product_disc_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product_category` int(11) NOT NULL,
--   `details` TEXT NOT NULL,
--   `amount` int(11) NOT NULL,
--   `date_from` TIMESTAMP(6) NOT NULL,
--   `date_after` TIMESTAMP(6) NOT NULL,
--    PRIMARY KEY (`product_disc_id`),
--    FOREIGN KEY (`product_category`) REFERENCES `product_category` (`product_category_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `cust_disc` (
--   `cust_disc_id` int(11) NOT NULL AUTO_INCREMENT,
--   `customer` int(11) NOT NULL,
--   `percentage` int(11) NOT NULL,
--   `product_categ` int(11) NOT NULL,
--    PRIMARY KEY (`cust_disc_id`),
--    FOREIGN KEY (`customer`) REFERENCES `customers`(`customer_id`),
--    FOREIGN KEY (`product_categ`) REFERENCES `product_category`(`product_category_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

