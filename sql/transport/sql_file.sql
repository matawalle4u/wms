
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
  
CREATE TABLE `transportation` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver` int(11) NOT NULL,
  `transport_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  `details` varchar(65) NOT NULL,
  `price` int(11) NOT NULL,
  `contract` int(11) NOT NULL,
  PRIMARY KEY (`transport_id`),
  FOREIGN KEY (`contract`) REFERENCES `drivers`(`driver_id`) ON DELETE CASCADE,
  FOREIGN KEY (`driver`) REFERENCES `drivers`(`driver_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;