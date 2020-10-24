-- Email

-- Text Messages
-- Facebook/Whatsapp 



-- CREATE TABLE `cust_messages`(
--   `cust_message_id` int(11) NOT NULL AUTO_INCREMENT,
--   `sender` int(11) NOT NULL,
--   `reciever` int(11) NOT NULL,
--   `content` TEXT NOT NULL,
--   `status` varchar(65) NOT NULL,
--   `duration` varchar(65) NOT NULL,
--   `category` int(3) NOT NULL,
--   `date_of_message` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   PRIMARY KEY (`cust_message_id`),
--   FOREIGN KEY (`sender`) REFERENCES `staffs`(`staff_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- CREATE TABLE `users_messages`(
--   `user_message_id` int(11) NOT NULL AUTO_INCREMENT,
--   `sender` int(11) NOT NULL,
--   `reciever` int(11) NOT NULL,
--   `content` TEXT NOT NULL,
--   `status` varchar(65) NOT NULL,
--   `duration` varchar(65) NOT NULL,
--   `category` int(3) NOT NULL,
--   `date_of_message` TIMESTAMP(6) DEFAULT CURRENT_TIMESTAMP(6),
--   PRIMARY KEY (`user_message_id`),
--   FOREIGN KEY (`sender`) REFERENCES `users`(`user_id`) ON DELETE CASCADE,
--   FOREIGN KEY (`reciever`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=latin1;








