
-- CREATE TABLE `staffs` (
--   `staff_id` int(11) NOT NULL AUTO_INCREMENT,
--   `staff_code` varchar(65) NOT NULL,
--   `first_name` varchar(65) NOT NULL,
--   `last_name` varchar(65) NOT NULL,
--   `identity_card` varchar(65) NOT NULL,
--   `role` varchar(65) NOT NULL,
--   `dept` varchar(65) NOT NULL,
--   `phone` varchar(30) NOT NULL,
--   `email` varchar(256) NOT NULL,
--   `address`TEXT NOT NULL,
--   `img_src` varchar(65) NOT NULL,
--   `status` int(2) NOT NULL,
--   `employment_date` DATE NOT NULL,
--   PRIMARY KEY (`staff_id`),
--   UNIQUE KEY (`staff_code`),
-- ) ENGINE=InnoDB DEFAULT CHARSuser_updatesET=latin1;

CREATE TABLE `users_log`(
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `log_table` varchar(35) NOT NULL,
  `table_primary_key` varchar(35) NOT NULL,
  `primary_key_val` int(11) NOT NULL,
  `log_details` TEXT NOT NULL,
  `activity_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
  PRIMARY KEY (`log_id`),
  FOREIGN KEY (`user`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- CREATE TABLE `staffs_rotation` (
--   `rotation_id` int(11) NOT NULL AUTO_INCREMENT,
--   `staff` int(11) NOT NULL,
--   `days_hours` TEXT NOT NULL,
--   PRIMARY KEY (`rotation_id`),
--   UNIQUE KEY (`staff`),
--   FOREIGN KEY (`staff`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--days = {Monday:"12-11", Tues:"12-3"}

-- CREATE TABLE `attendance` (
--   `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
--   `staff` int(11) NOT NULL,
--   `supervisor` int(11) NOT NULL,
--   `arrived_time` s(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
--   `closing_time` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
--   `tumb_print` TEXT NOT NULL,
--    PRIMARY KEY (`attendance_id`),
--   FOREIGN KEY (`staff`) REFERENCES `staffs`(`staff_id`),
--   FOREIGN KEY (`supervisor`) REFERENCES `staffs`(`staff_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- CREATE TABLE `staffs_contract` (
--   `contract_id` int(11) NOT NULL AUTO_INCREMENT,
--   `contract_date` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
--   `staff` int(11) NOT NULL,
--   `status` int(11) NOT NULL,
--   `termination` DATE NOT NULL,
--    PRIMARY KEY (`contract_id`),
--   UNIQUE KEY (`staff`),
--   FOREIGN KEY (`staff`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `staffs_documents` (
--   `document_id` int(11) NOT NULL AUTO_INCREMENT,
--   `staff` int(11) NOT NULL,
--   `description` TEXT NOT NULL,
--   `status` int(3) NOT NULL,
--   `expiry` DATE NOT NULL,
--   `doc_src` varchar(65)NOT NULL,
--   PRIMARY KEY (`document_id`),
--   UNIQUE KEY (`staff`),
--   FOREIGN KEY (`staff`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `equipments_records` (
--   `record_id` int(11) NOT NULL AUTO_INCREMENT,
--   `staff` int(11) NOT NULL,
--   `duration` TEXT NOT NULL,
--   `status` int(3) NOT NULL,
--   `description` TEXT NOT NULL,
--   `item_code` int(11) NOT NULL,
--   `doc_src` varchar(65),
--    PRIMARY KEY (`record_id`),
--   FOREIGN KEY `staff` REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- CREATE TABLE `users`(
--   `user_id` int(11) NOT NULL AUTO_INCREMENT,
--   `phone` varchar(35) NOT NULL,
--   `name` varchar(65) NOT NULL,
--   `email` varchar(256) NOT NULL,
--   `role` varchar(256) NOT NULL,
--   `password` varchar(65) NOT NULL,
--   `status` int(2) NOT NULL,
--   `last_coordinates` varchar(256) NOT NULL,
--   `date_added` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
--   `last_login` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
--   PRIMARY KEY (`user_id`),
--   UNIQUE KEY (`phone`),
--   UNIQUE KEY (`email`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- TODO CREATE TABLE FOR USER PREVILEGES

-- CREATE TABLE `privelages` (
--   `priv_id` int(11) NOT NULL AUTO_INCREMENT,
--   `user` int(11) NOT NULL,
--   `actions` TEXT NOT NULL,
--   `last_updated` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
--   `assigner` int(11) NOT NULL,
--   `user_menus` TEXT NOT NULL,
--   PRIMARY KEY (`priv_id`),
--   UNIQUE KEY (`user`),
--   FOREIGN KEY (`user`) REFERENCES `users` (`user_id`),
--   FOREIGN KEY (`assigner`) REFERENCES `users`(`user_id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- CREATE TABLE `supplier` (
--   `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
--   `supplier_code` varchar(65) NOT NULL,
--   `reg_code` varchar(65)
--   `name` varchar(65) NOT NULL,
--   `category` varchar(65) NOT NULL,
--   `phone` varchar(30) NOT NULL,
--   `email` varchar(256) NOT NULL,
--   `address`TEXT NOT NULL,
--   `status` int(2) NOT NULL,
--   `added_date` DATE NOT NULL,
--   PRIMARY KEY (`supplier_id`),
--   UNIQUE KEY (`supplier_code`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;