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

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(65) NOT NULL,
  `quantity` varchar(20) NOT NULL,
   PRIMARY KEY (`product_id`),
   FOREIGN KEY (`product`) REFERENCES `products`(`product_code`)
   FOREIGN KEY (`rack`) REFERENCES `racks` (`rack_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `damages`(
  `product` int(11) NOT NULL,
  `details` TEXT NOT NULL,
  `img_src` varchar(65) NOT NULL,
  `damaged_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  FOREIGN KEY (`product`) REFERENCES `products`(`product_id`),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `tailor` int(11) NOT NULL,
   PRIMARY KEY (`sales_id`),
  CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`tailor`) REFERENCES `followup`.`tailors` (`tailor_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
