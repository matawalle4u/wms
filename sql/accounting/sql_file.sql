-- CREATE TABLE `purchase` (
--   `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
--   `invoice` varchar(65) NOT NULL,
--   `request` int(11) NOT NULL,
--   `purchased_qty` int(11) NOT NULL,
--   `driver` int(11) NOT NULL,
--   `purchase_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   PRIMARY KEY (`purchase_id`),
--   FOREIGN KEY (`request`) REFERENCES `requests`(`request_id`) ON DELETE CASCADE,
--   FOREIGN KEY (`driver`) REFERENCES `drivers`(`driver_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `sales` (
--   `sales_id` int(11) NOT NULL AUTO_INCREMENT,
--   `invoice` varchar(65) NOT NULL,
--   `seller` int(11) NOT NULL,
--   `product` int(11) NOT NULL,
--   `sold_qty` int(11) NOT NULL,
--   `sales_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   FOREIGN KEY (`seller`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

