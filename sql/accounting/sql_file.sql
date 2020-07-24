CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(65) NOT NULL,
  `request` varchar(65) NOT NULL,
  `purchased_qty` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `purchase_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  FOREIGN KEY `request` REFERENCES `requests`(`request_id`),
  FOREIGN KEY `driver` REFERENCES `drivers`(`driver_code`),
  FOREIGN KEY `warehouse` REFERENCES `warehouses`(`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(65) NOT NULL,
  `order` int(11) NOT NULL,
  `purchased_qty` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `sales_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  FOREIGN KEY `warehouse` REFERENCES `warehouses`(`warehouse_id`),
  FOREIGN KEY `order` REFERENCES `orders`(`order_id`),
  FOREIGN KEY `driver` REFERENCES `drivers`(`driver_id`),
  FOREIGN KEY `invoice` REFERENCES `invoices`(`invoice_id`)

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `agents` (
  `agent_id` int(11) NOT NULL AUTO_INCREMENT,
  `agent_code` varchar(65) NOT NULL,
  `role` varchar(65) NOT NULL,
  `db_table` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;