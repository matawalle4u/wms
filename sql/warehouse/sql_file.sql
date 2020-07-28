
-- CREATE TABLE `receptions` (
--   `reception_id` int(11) NOT NULL AUTO_INCREMENT,
--   `warehouse` int(11) NOT NULL,
--   `created_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   `details` TEXT NOT NULL,
--   PRIMARY KEY (`reception_id`)
--   FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `warehouses`(
--   `warehouse_id` int(11) NOT NULL,
--   `name` varchar(65) NOT NULL,
--   `delivery_zone` varchar(65) NOT NULL,
--   `reception_zone` varchar(65) NOT NULL,
--   `damage_zone` varchar(65) NOT NULL,
--   PRIMARY KEY (`order_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE  `racks`(
--   `rack_id` int(11) NOT NULL AUTO_INCREMENT,
--   `warehouse` int(11) NOT NULL,
--   `location` int(11),
--   `row` int(11) NOT NULL,
--   `column` int(11) NOT NULL,
--   `position` varchar(65) NOT NULL,
--    PRIMARY KEY (`rack_id`),
--   FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `supplier_orders`(
  `supplier_order_id` int(11) NOT NULL AUTO_INCREMENT,
  `request` int(11) NOT NULL,
  `date_confirmation` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  `arrived_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (`reception`) REFERENCES `receptions`(`reception_id`) ON DELETE CASCADE,
  FOREIGN KEY (`product`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `partner` (
--   `partner_id` int(11) NOT NULL AUTO_INCREMENT,
--   `partner_code` varchar(65) NOT NULL,
--   `role` varchar(65) NOT NULL,
--   `db_table`
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `customers` (
--   `customer_id` int(11) NOT NULL AUTO_INCREMENT,
--   `customer_code` varchar(65) NOT NULL,
--   `name` varchar(65) NOT NULL,
--   `phone`
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `orders` (
--   `order_id` int(11) NOT NULL AUTO_INCREMENT,
--   `customer` varchar(65) NOT NULL,
--   `catgory` varchar(65) NOT NULL,
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `assets` (
--   `asset_id` int(11) NOT NULL AUTO_INCREMENT,
--   `asset_code` varchar(65) NOT NULL,
--   `asset_description` TEXT NOT NULL,
--   `category` varchar(65) NOT NULL,
--   `warehouse` int(11) NOT NULL,
--   `quantity` int(11) NOT NULL,
--   `status` varchar(65) NOT NULL,
--   `purchase_date` DATE NOT NULL,
--   `barcode` varchar(65) NOT NULL,
--   PRIMARY KEY (`asset_id`),
--   UNIQUE KEY (`asset_code`),
--   FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `transfer` (
--   `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product` int(11) NOT NULL,
--   `quantity` int(11) NOT NULL,
--   `driver` int(11) NOT NULL,
--   `sender` int(11) NOT NULL,
--   `receiver` int(11) NOT NULL,
--   `transfer_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   PRIMARY KEY (`transfer_id`),
--   FOREIGN KEY (`driver`) REFERENCES `drivers`(`driver_id`) ON DELETE CASCADE,
--   FOREIGN KEY (`product`) REFERENCES `products`(`product_id`) ON DELETE CASCADE,
--   FOREIGN KEY (`sender`) REFERENCES `receptions`(`reception_id`) ON DELETE CASCADE, 
--   FOREIGN KEY (`receiver`) REFERENCES `receptions`(`reception_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `requests` (
--   `request_id` int(11) NOT NULL AUTO_INCREMENT,
--   `product` int(11) NOT NULL,
--   `quantity` int(11) NOT NULL,
--   `warehouse` int(11) NOT NULL,
--   `status` varchar(65) NOT NULL,
--   `supplier` int(11) NOT NULL,
--   `request_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   PRIMARY KEY (`request_id`),
--   FOREIGN KEY (`supplier`) REFERENCES `supplier`(`supplier_id`) ON DELETE CASCADE,
--   FOREIGN KEY (`product`) REFERENCES `products`(`product_id`) ON DELETE CASCADE,
--   FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `requests_hist` (
--   `request_hist_id` int(11) NOT NULL AUTO_INCREMENT,
--   `negotiated_price` int(11) NOT NULL,
--   `request` int(11) NOT NULL,
--   `contract_price` int(11) NOT NULL,
--   `history_price` int(11) NOT NULL,
--   PRIMARY KEY (`request_hist_id`),
--   FOREIGN KEY (`request`) REFERENCES `requests`(`request_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_code` varchar(65) NOT NULL,
  `delivery_note_code` varchar(65) NOT NULL,
  `invoice_date`
  `product`
  `details`
  FOREIGN KEY `delivery_note_code` REFERENCES `delivery`(`delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `delivery` (
  `delivery_id` int(11) NOT NULL AUTO_INCREMENT,
  `delivery_code` varchar(65) NOT NULL,
  `vehicle` varchar(65) NOT NULL,
  FOREIGN KEY `vehicle` REFERENCES `vehicles`(`vehicle_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

---`suplier/furnizor`
---`custumerclienti`

--- Trigggers
DELIMITER //

  CREATE TRIGGER after_sales_insert AFTER INSERT
    on sales
    for EACH ROW

    BEGIN
      insert into account (invoice, amount, user) VALUES (old.invoice, old.amount, old.owner)
    END //

DELIMETER ;
