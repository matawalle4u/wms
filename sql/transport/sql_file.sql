
CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_code` varchar(65) NOT NULL,
  `description` varchar(65) NOT NULL,
  `licence_expiry`
  `insurance_expiry`,
  `other_expiries`
  `gps_data` varchar(256)
  UNIQUE KEY (`vehicle_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_code` varchar(65) NOT NULL,
  `phone`
  `identity_card` 
  `role` varchar(65) NOT NULL,
  `vehicle` int(11) NOT NULL,
  UNIQUE KEY `driver_code`,
  UNIQUE KEY `phone`,
  FOREIGN KEY `vehicle` REFERENCES `vehicles`(`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `transportation` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver` int(11) NOT NULL,
  `transport_date` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `request_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  FOREIGN KEY `invoice` REFERENCES `invoice`(`vehicle_code`)
  FOREIGN KEY `product` REFERENCES `products`(`product_id`)
   FOREIGN KEY `customer` REFERENCES `products`(`product_id`)
    FOREIGN KEY `warehouse` REFERENCES `products`(`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;