
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(35) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(65) NOT NULL,
  `admin_img_src` varchar(65) NOT NULL,
  `admin_last_login` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `status` int(2) NOT NULL,
  `role` varchar(35) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `admin_logins` (
  `admin_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_admin` int(11) NOT NULL,
  `login_cordinates` varchar(256) NOT NULL,
  `ip_address` varchar(256) NOT NULL,
  `login_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`admin_login_id`),
  FOREIGN KEY (`login_admin`) REFERENCES `admin`(`admin_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `warehouses` (
  `warehouse_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_name` varchar(65) NOT NULL,
  `warehouse_address` varchar(65) NOT NULL,
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `asset_categ` (
  `asset_categ_id` int(11) NOT NULL AUTO_INCREMENT,
  `categ_name` varchar(256) NOT NULL,
  `categ_desc` text NOT NULL,
  PRIMARY KEY (`asset_categ_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `assets` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_code` varchar(65) NOT NULL,
  `asset_description` text NOT NULL,
  `category` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(65) NOT NULL,
  `purchase_date` date NOT NULL,
  `barcode` varchar(65) NOT NULL,
  PRIMARY KEY (`asset_id`),
  FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE,
  FOREIGN KEY (`category`) REFERENCES `asset_categ`(`asset_categ_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_code` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `last_name` varchar(65) NOT NULL,
  `identity_card` varchar(6) NOT NULL,
  `role` varchar(65) NOT NULL,
  `dept` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `img_src` varchar(65) NOT NULL,
  `status` int(2) NOT NULL,
  `employment_date` date NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff` int(11) NOT NULL,
  `supervisor` int(11) NOT NULL,
  `arrived_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `closing_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `tumb_print` text NOT NULL,
  PRIMARY KEY (`attendance_id`),
  FOREIGN KEY (`staff`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_code` varchar(65) NOT NULL,
  `cust_reg_code` varchar(65) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(256) NOT NULL,
  `contact` varchar(65) NOT NULL,
  `address` text NOT NULL,
  `category` varchar(65) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `password` varchar(65) NOT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `admin_noti` (
  `admin_noti_id` int(11) NOT NULL AUTO_INCREMENT,
  `noti_owner` VARCHAR(35) NOT NULL,
  `title` VARCHAR(65) NOT NULL,
  `content` TEXT NOT NULL,
  `subject_table` VARCHAR(35) NOT NULL,
  `message_icon` VARCHAR(35) NOT NULL,
  `subject_id_table` int(11) NOT NULL,
  `date_of_noti` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`admin_noti_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `product_category` (
  `prod_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(256) NOT NULL,
  `category_desc` text NOT NULL,
  PRIMARY KEY (`prod_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `cust_disc` (
  `cust_disc_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `product_categ` int(11) NOT NULL,
  PRIMARY KEY (`cust_disc_id`),
  FOREIGN KEY (`customer`) REFERENCES `customers`(`customer_id`) ON DELETE CASCADE,
  FOREIGN KEY (`product_categ`) REFERENCES `product_category`(`prod_category_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `cust_messages` (
  `cust_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(65) NOT NULL,
  `duration` varchar(65) NOT NULL,
  `category` int(3) NOT NULL,
  `date_of_message` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`cust_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(35) NOT NULL,
  `name` varchar(65) NOT NULL,
  `email` varchar(256) NOT NULL,
  `role` varchar(256) NOT NULL,
  `password` varchar(65) NOT NULL,
  `status` int(2) NOT NULL,
  `last_coordinates` varchar(256) NOT NULL,
  `date_added` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `last_login` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `admin_message` (
  `admin_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_owner` VARCHAR(35) NOT NULL,
  `subject` VARCHAR(65) NOT NULL,
  `body` TEXT NOT NULL,
  `sender` int(11) NOT NULL,
  `message_icon` VARCHAR(35) NOT NULL,
  `date_sent` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`admin_message_id`),
  FOREIGN KEY (`sender`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `damages` (
  `damage_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock` int(11) NOT NULL,
  `damage_quantity` int(11) NOT NULL,
  `details` text NOT NULL,
  `img_src` varchar(65) DEFAULT NULL,
  `damaged_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `damages_recorder` int(11) NOT NULL,
  PRIMARY KEY (`damage_id`),
  FOREIGN KEY (`damages_recorder`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`stock`) REFERENCES `stocks`(`stock_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_code` varchar(65) NOT NULL,
  `description` varchar(65) NOT NULL,
  `licence_expiry` date NOT NULL,
  `insurance_expiry` date NOT NULL,
  `other_expiries` date DEFAULT NULL,
  `category` varchar(65) NOT NULL,
  `gps_data` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `drivers` (
  `driver_id` int(11) NOT NULL AUTO_INCREMENT,
  `driver_code` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `identity_card` text NOT NULL,
  `status` int(3) NOT NULL,
  `role` varchar(65) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`driver_id`),
  FOREIGN KEY (`user`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`vehicle`) REFERENCES `vehicles`(`vehicle_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `equip_records` (
  `eq_record_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff` int(11) NOT NULL,
  `duration` text NOT NULL,
  `status` int(3) NOT NULL,
  `description` text NOT NULL,
  `item_code` int(11) NOT NULL,
  `doc_src` varchar(65) DEFAULT NULL,
  PRIMARY KEY (`eq_record_id`),
  FOREIGN KEY (`staff`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `details` text NOT NULL,
  `order_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `order_status` varchar(65) NOT NULL,
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (`customer`) REFERENCES `customers`(`customer_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `product_config` (
  `prod_config_id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_measure` varchar(65) NOT NULL,
  `unit_restr` varchar(65) NOT NULL,
  PRIMARY KEY (`prod_config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(65) NOT NULL,
  `category` int(11) NOT NULL,
  `config` int(11) NOT NULL,
  `barcode` varchar(256) NOT NULL,
  `product_code` varchar(65) NOT NULL,
  `img_src` varchar(65) NOT NULL,
  `item_type` varchar(65) NOT NULL,
  PRIMARY KEY (`product_id`),
  FOREIGN KEY (`category`) REFERENCES `product_category`(`prod_category_id`) ON DELETE CASCADE,
  FOREIGN KEY (`config`) REFERENCES `product_config`(`prod_config_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `prices` (
  `price_id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `unit_measure` varchar(11) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`price_id`),
  FOREIGN KEY (`product`) REFERENCES `products`(`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `privelages` (
  `priv_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `actions` text NOT NULL,
  `last_updated` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `assigner` int(11) NOT NULL,
  `user_menus` text NOT NULL,
  PRIMARY KEY (`priv_id`),
  FOREIGN KEY (`user`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`assigner`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `product_discounts` (
  `product_disc_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category` int(11) NOT NULL,
  `details` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date_from` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `date_after` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`product_disc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `racks` (
  `rack_id` int(11) NOT NULL AUTO_INCREMENT,
  `rack_warehouse` int(11) NOT NULL,
  `rack_row` int(11) NOT NULL,
  `rack_column` int(11) NOT NULL,
  `rack_level` varchar(65) NOT NULL,
  `rack_zone` int(11) NOT NULL,
  `rack_position` varchar(65) NOT NULL,
  PRIMARY KEY (`rack_id`),
  FOREIGN KEY (`rack_warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `receptions` (
  `reception_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse` int(11) NOT NULL,
  `created_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `details` text NOT NULL,
  PRIMARY KEY (`reception_id`),
  FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse` int(11) NOT NULL,
  `products_details` TEXT NOT NULL,
  `request_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `status` VARCHAR(35) NOT NULL,
  PRIMARY KEY (`request_id`),
  FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `requests_hist` (
  `request_hist_id` int(11) NOT NULL AUTO_INCREMENT,
  `negotiated_price` int(11) NOT NULL,
  `request` int(11) NOT NULL,
  `contract_price` int(11) NOT NULL,
  `history_price` int(11) NOT NULL,
  PRIMARY KEY (`request_hist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(65) NOT NULL,
  `seller` int(11) NOT NULL,
  `products_details` TEXT NOT NULL,
  `sales_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `order` int(11) NOT NULL,
  PRIMARY KEY (`sales_id`),
  UNIQUE KEY (`invoice`),
  FOREIGN KEY (`seller`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(65) NOT NULL,
  `reg_code` varchar(65) DEFAULT NULL,
  `supplier_name` varchar(65) NOT NULL,
  `category` varchar(65) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(256) NOT NULL,
  `address` text NOT NULL,
  `status` int(2) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY (`supplier_code`),
  UNIQUE KEY (`reg_code`),
  UNIQUE KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(65) NOT NULL,
  `supplier` int(11) NOT NULL,
  `products_details` TEXT NOT NULL,
  `purchase_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `order` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`),
  UNIQUE KEY (`invoice`),
  FOREIGN KEY (`supplier`) REFERENCES `suppliers`(`supplier_id`) ON DELETE CASCADE,
  FOREIGN KEY (`order`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `staffs_contract` (
  `contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `staff` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `termination` date NOT NULL,
  PRIMARY KEY (`contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `staffs_documents` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` int(3) NOT NULL,
  `expiry` date NOT NULL,
  `doc_src` varchar(65) NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `staffs_rotation` (
  `rotation_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff` int(11) NOT NULL,
  `days_hours` text NOT NULL,
  PRIMARY KEY (`rotation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `rack` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(65) NOT NULL,
  `stocker` int(11) NOT NULL,
  `last_stocked` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  PRIMARY KEY (`stock_id`),
  FOREIGN KEY (`product`) REFERENCES `products`(`product_id`) ON DELETE CASCADE,
  FOREIGN KEY (`rack`) REFERENCES `racks`(`rack_id`) ON DELETE CASCADE,
  FOREIGN KEY (`stocker`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `transaction_table` varchar(65) NOT NULL,
  `table_id` int(11) NOT NULL,
  `transaction_user` int(11) NOT NULL,
  PRIMARY KEY (`transaction_id`),
  FOREIGN KEY (`transaction_user`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `transfers` (
  `transfer_id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `driver` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `transfer_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `transfer_docs` text NOT NULL,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `users_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `log_table` varchar(35) NOT NULL,
  `table_primary_key` varchar(35) NOT NULL,
  `primary_key_val` int(11) NOT NULL,
  `log_details` text NOT NULL,
  `activity_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`log_id`),
  FOREIGN KEY (`user`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `users_messages` (
  `user_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `reciever` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` varchar(65) NOT NULL,
  `duration` varchar(65) NOT NULL,
  `category` int(3) NOT NULL,
  `date_of_message` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`user_message_id`),
  FOREIGN KEY (`sender`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`reciever`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user_updates` (
  `user_updates_id` int(11) NOT NULL AUTO_INCREMENT,
  `updater` int(11) NOT NULL,
  `updated_user` int(11) NOT NULL,
  `updated_previleges` text NOT NULL,
  `update_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  PRIMARY KEY (`user_updates_id`),
  FOREIGN KEY (`updater`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
  FOREIGN KEY (`updated_user`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `warehouse_users` (
  `warehouse_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `warehouse` int(11) NOT NULL,
  `role` varchar(65) NOT NULL,
  PRIMARY KEY (`warehouse_user_id`),
  FOREIGN KEY (`warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE,
  FOREIGN KEY (`user`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `warehouse_zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(65) NOT NULL,
  `zone_warehouse` int(11) NOT NULL,
  PRIMARY KEY (`zone_id`),
  FOREIGN KEY (`zone_warehouse`) REFERENCES `warehouses`(`warehouse_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;