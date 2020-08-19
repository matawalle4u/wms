-- IDENTIFY ALL TABLES AND TABLES THEY AFFECT

-- Sales -> Stocks|Request


--WORKING

--When damage is inserted
CREATE TRIGGER `after_damages_insert` 
  AFTER INSERT ON `damages` 
    FOR EACH ROW
      UPDATE stocks SET quantity=quantity-new.quantity WHERE product=new.product AND quantity>0
--END OF WORKING TRIGGERS




