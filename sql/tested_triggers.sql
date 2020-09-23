-- IDENTIFY ALL TABLES AND TABLES THEY AFFECT

-- Sales -> Stocks|Request


--WORKING

--When damage is inserted
CREATE TRIGGER `after_damages_insert` 
  AFTER INSERT ON `damages` 
    FOR EACH ROW
      UPDATE stocks SET quantity=quantity-new.quantity WHERE product=new.product AND quantity>0 AND quantity-new.quantity>-1
      INSERT INTO users_log (user, log_table, table_primary_key, primary_key_val, log_details) VALUES (new.damages_recorder, 'damages', 'damage_id', new.damage_id, new.details)

CREATE TRIGGER `after_sales_insert` 
  AFTER INSERT ON `sales` 
    FOR EACH ROW
      UPDATE stocks SET quantity=quantity-new.sold_qty WHERE product=new.product AND quantity>0 AND quantity-new.sold_qty>-1

CREATE TRIGGER `after_sales_delete` 
  AFTER DELETE ON `sales` 
    FOR EACH ROW
      UPDATE stocks SET quantity=quantity+old.sold_qty WHERE product=old.product
--END OF WORKING TRIGGERS

--need to fix this user should be admin not the user added Delete this we dont need it

CREATE TRIGGER `after_sales_insert` 
  AFTER INSERT ON `sales` 
    FOR EACH ROW
      INSERT INTO users_log (user, log_table, table_primary_key, primary_key_val, log_details) VALUES (new.user, 'sales', 'sales_id', new.sales_id, 'Sold a Product')

-- 





CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `catgory` varchar(65) NOT NULL,
  `quantity` text NOT NULL,
  `price` text NOT NULL,
  `product` text NOT NULL,
  `delivery_items` text,
  `delivery_items_price` text,
  `order_date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY(`order_id`),
  FOREIGN KEY (`customer`) REFERENCES `customers`(`customer_id`) ON DELETE CASCADE 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


