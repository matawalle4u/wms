-- IDENTIFY ALL TABLES AND TABLES THEY AFFECT

-- Sales -> Stocks|Request


--WORKING

--When damage is inserted
CREATE TRIGGER `after_damages_insert` 
  AFTER INSERT ON `damages` 
    FOR EACH ROW
      UPDATE stocks SET quantity=quantity-new.quantity WHERE product=new.product AND quantity>0 AND quantity-new.quantity>-1

CREATE TRIGGER `after_sales_insert` 
  AFTER INSERT ON `sales` 
    FOR EACH ROW
      UPDATE stocks SET quantity=quantity-new.sold_qty WHERE product=new.product AND quantity>0 AND quantity-new.sold_qty>-1

CREATE TRIGGER `after_sales_delete` 
  AFTER DELETE ON `sales` 
    FOR EACH ROW
      UPDATE stocks SET quantity=quantity+old.sold_qty WHERE product=old.product
--END OF WORKING TRIGGERS




