
-- CREATE TABLE `vehicles` (
--   `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
--   `vehicle_code` varchar(65) NOT NULL,
--   `description` varchar(65) NOT NULL,
--   `licence_expiry` date NOT NULL,
--   `insurance_expiry` date NOT NULL,
--   `other_expiries` date,
--   `category` varchar(65) NOT NULL,
--   `gps_data` varchar(256),
--   PRIMARY KEY (`vehicle_id`),
--   UNIQUE KEY (`vehicle_code`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `drivers` (
--   `driver_id` int(11) NOT NULL AUTO_INCREMENT,
--   `driver_code` varchar(65) NOT NULL,
--   `phone` varchar(30) NOT NULL,
--   `identity_card` TEXT NOT NULL,
--   `status` int(3) NOT NULL,
--   `role` varchar(65) NOT NULL,
--   `vehicle` int(11) NOT NULL,
--   PRIMARY KEY (`driver_id`),
--   UNIQUE KEY (`driver_code`),
--   UNIQUE KEY (`phone`),
--   FOREIGN KEY (`vehicle`) REFERENCES `vehicles`(`vehicle_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--TODO Review the architecutrue for performance
-- CREATE TABLE `transactions` (
--   `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
--   `transaction_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   `transaction_able` varchar(65) NOT NULL,
--   `table_id` int(11) NOT NULL,
--   PRIMARY KEY (`transport_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
-- Review



CREATE TABLE `truck_rents` (
  `truck_rent_id` int(11) NOT NULL AUTO_INCREMENT,
  `rent_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  `company` int(11) NOT NULL,
  `details` varchar(65) NOT NULL,
  FOREIGN KEY (`company`) REFERENCES `supplier`(`supplier_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `transportation` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver` int(11) NOT NULL,
  `transport_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  `type_of_transport` varchar(65) NOT NULL,
  `connector` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `price` int(11) NOT NULL
  PRIMARY KEY (`transport_id`),
  FOREIGN KEY (`driver`) REFERENCES `drivers`(`driver_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;