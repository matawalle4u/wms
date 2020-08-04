-- IDENTIFY ALL TABLES AND TABLES THEY AFFECT

-- Sales -> Stocks|Request


CREATE TRIGGER `after_sales_insert` 
  AFTER INSERT ON `users` 
    FOR EACH ROW 
      insert into prices (product, unit_measure, amount) VALUES (1,'bubututu', 1200)

CREATE TRIGGER `after_user_update`
AFTER UPDATE ON `users`
  FOR EACH ROW
    INSERT INTO user_updates (updater, updated_user, updated_previleges, update_time) VALUES (NEW.user_id, NEW.user_id, 'PREVSSSS', now())

--- Trigggers
DROP TRIGGER IF EXISTS after_sales_insert
DELIMITER //

  CREATE TRIGGER after_sales_insert AFTER INSERT
    on sales
    for EACH ROW

    BEGIN
      insert into transactions (table_id) VALUES (old.sales_id)
    END //
DELIMETER ;


-- Users -> Users notification

DROP TRIGGER IF EXISTS after_users_insert
DELIMETER //

CREATE TRIGGER after_users_insert AFTER INSERT
    on users
    for EACH ROW

    BEGIN
      insert into users_messages () VALUES ()
    END //
DELIMETER ;


DROP TRIGGER IF EXISTS after_damages_insert
DELIMETER //

CREATE TRIGGER after_damages_insert AFTER INSERT
    on damages
    for EACH ROW

    BEGIN
      UPDATE stocks SET
    END //
DELIMETER ;

DROP TRIGGER IF EXISTS after_damages_insert
DELIMETER //

-- After a transfer is made
CREATE TRIGGER after_transfer_insert AFTER INSERT
    ON transfers
    for EACH ROW

    BEGIN
      UPDATE stocks SET quantity = quantity-new.quantity
    END //
DELIMETER ;




