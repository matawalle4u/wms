


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
